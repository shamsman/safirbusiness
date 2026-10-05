<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'is_active',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'role'              => UserRole::class,
            'is_active'         => 'boolean',
        ];
    }

    public function isSuperadmin(): bool
    {
        return $this->role === UserRole::Superadmin;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isEditor(): bool
    {
        return $this->role === UserRole::Editor;
    }

    public function isGuest(): bool
    {
        return $this->role === UserRole::Guest;
    }

    /**
     * Check if the user has any of the given roles.
     */
    public function hasRole(string|array|UserRole ...$roles): bool
    {
        $flattened = [];
        foreach ($roles as $role) {
            if (is_array($role)) {
                foreach ($role as $r) {
                    $flattened[] = $r instanceof UserRole ? $r->value : (string) $r;
                }
            } else {
                $flattened[] = $role instanceof UserRole ? $role->value : (string) $role;
            }
        }

        return in_array($this->role->value, $flattened, true);
    }

    /**
     * Determine if current user can manage target user.
     */
    public function canManage(User $target): bool
    {
        if ($this->is($target)) {
            return false;
        }

        return $this->role->canManage($target->role);
    }

    /**
     * Avatar URL or fallback UI avatar.
     */
    public function avatarUrl(): string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }

        $encodedName = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$encodedName}&background=0A192F&color=DFBD69&bold=true";
    }
}
