<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $roleFilter = $request->input('role');
        $statusFilter = $request->input('status');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($roleFilter, function ($query, $roleFilter) {
                $query->where('role', $roleFilter);
            })
            ->when($statusFilter !== null && $statusFilter !== '', function ($query) use ($statusFilter) {
                $query->where('is_active', (bool) $statusFilter);
            })
            ->orderByRaw("
                CASE role
                    WHEN 'superadmin' THEN 1
                    WHEN 'admin' THEN 2
                    WHEN 'editor' THEN 3
                    WHEN 'guest' THEN 4
                    ELSE 5
                END ASC
            ")
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $roles = UserRole::cases();

        return view('admin.users.index', compact('users', 'roles', 'search', 'roleFilter', 'statusFilter'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(Request $request): View
    {
        $currentUser = $request->user();
        $assignableRoles = $currentUser->role->assignable();

        return view('admin.users.create', compact('assignableRoles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $currentUser = $request->user();
        $assignableValues = array_map(fn (UserRole $r) => $r->value, $currentUser->role->assignable());

        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone'     => ['nullable', 'string', 'max:30'],
            'password'  => ['required', 'confirmed', Password::defaults()],
            'role'      => ['required', Rule::in($assignableValues)],
            'is_active' => ['nullable', 'boolean'],
        ]);

        User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'phone'             => $validated['phone'] ?? null,
            'password'          => Hash::make($validated['password']),
            'role'              => UserRole::from($validated['role']),
            'is_active'         => $request->boolean('is_active', true),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('status', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(Request $request, User $user): View|RedirectResponse
    {
        $currentUser = $request->user();

        // Check if user can edit this user (either managing them or editing own profile)
        if (!$currentUser->is($user) && !$currentUser->canManage($user)) {
            abort(403, 'You do not have permission to edit this user.');
        }

        $assignableRoles = $currentUser->role->assignable();

        return view('admin.users.edit', compact('user', 'assignableRoles', 'currentUser'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        if (!$currentUser->is($user) && !$currentUser->canManage($user)) {
            abort(403, 'You do not have permission to modify this user.');
        }

        $assignableValues = array_map(fn (UserRole $r) => $r->value, $currentUser->role->assignable());

        $rules = [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'     => ['nullable', 'string', 'max:30'],
            'avatar'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'password'  => ['nullable', 'confirmed', Password::defaults()],
        ];

        // Only allow changing role and active status if the current user can manage target user
        if ($currentUser->canManage($user)) {
            $rules['role'] = ['required', Rule::in($assignableValues)];
            $rules['is_active'] = ['nullable', 'boolean'];
        }

        $validated = $request->validate($rules);

        $updateData = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ];

        $disk = config('filesystems.default', 'gcs');

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                if (Storage::disk($disk)->exists($user->avatar)) {
                    Storage::disk($disk)->delete($user->avatar);
                }
                if ($disk !== 'public' && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }
            $updateData['avatar'] = $request->file('avatar')->store('avatars', $disk);
        } elseif ($request->boolean('remove_avatar')) {
            if ($user->avatar) {
                if (Storage::disk($disk)->exists($user->avatar)) {
                    Storage::disk($disk)->delete($user->avatar);
                }
                if ($disk !== 'public' && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }
            $updateData['avatar'] = null;
        }

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        if ($currentUser->canManage($user)) {
            $updateData['role'] = UserRole::from($validated['role']);
            $updateData['is_active'] = $request->boolean('is_active');
        }

        // Safeguard: Ensure at least one active Superadmin remains
        if ($user->isSuperadmin()) {
            if (isset($updateData['role']) && $updateData['role'] !== UserRole::Superadmin) {
                $superadminCount = User::where('role', UserRole::Superadmin->value)->count();
                if ($superadminCount <= 1) {
                    return back()->withErrors(['role' => 'System requires at least one Superadmin.']);
                }
            }
            if (isset($updateData['is_active']) && !$updateData['is_active']) {
                $activeSuperadmins = User::where('role', UserRole::Superadmin->value)->where('is_active', true)->count();
                if ($activeSuperadmins <= 1) {
                    return back()->withErrors(['is_active' => 'Cannot deactivate the only active Superadmin.']);
                }
            }
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('status', "User '{$user->name}' updated successfully.");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        if ($currentUser->is($user)) {
            return back()->withErrors(['error' => 'You cannot delete your own account from the users module.']);
        }

        if (!$currentUser->canManage($user)) {
            abort(403, 'You do not have permission to delete this user.');
        }

        // Prevent deleting the last superadmin
        if ($user->isSuperadmin()) {
            $superadminCount = User::where('role', UserRole::Superadmin->value)->count();
            if ($superadminCount <= 1) {
                return back()->withErrors(['error' => 'Cannot delete the only Superadmin in the system.']);
            }
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('status', "User '{$name}' deleted successfully.");
    }
}
