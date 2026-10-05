@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->name)
@section('header_title', 'Modify User Privileges')
@section('header_subtitle', 'Edit account credentials and adjust operational role hierarchy')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-slate-200/90 rounded-2xl p-8 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img class="w-12 h-12 rounded-full object-cover ring-2 ring-gold-500/30" src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">{{ $user->name }}</h2>
                    <p class="text-xs text-slate-500">{{ $user->email }} · Member since {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-500 hover:text-slate-900 font-medium flex items-center gap-1">
                <span>←</span> Back to Directory
            </a>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar Upload Section -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                    Profile Avatar
                </label>
                <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <img class="w-14 h-14 rounded-full object-cover ring-2 ring-gold-500/30 shrink-0" src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                    <div class="space-y-2">
                        <input type="file" name="avatar" accept="image/*" class="text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gold-500/15 file:text-gold-700 hover:file:bg-gold-500/25 cursor-pointer">
                        <p class="text-[11px] text-slate-500">Supports PNG, JPG, WebP (Max 2MB). Uploaded directly to platform media storage.</p>
                        @if($user->avatar)
                            <label class="inline-flex items-center gap-2 text-xs text-rose-600 cursor-pointer pt-1 font-medium">
                                <input type="checkbox" name="remove_avatar" value="1" class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                <span>Remove current avatar</span>
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                    Full Name & Title <span class="text-gold-600">*</span>
                </label>
                <input type="text" id="name" name="name" required value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
            </div>

            <!-- Email & Phone Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Official Email <span class="text-gold-600">*</span>
                    </label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Direct Phone / Hotline
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                           placeholder="+90 (___) ___ __ __"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>
            </div>

            <!-- Role & Status (Editable if actor can manage target user) -->
            @if($currentUser->canManage($user))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="role" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Authorization Role Tier <span class="text-gold-600">*</span>
                        </label>
                        <select id="role" name="role" required
                                class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-800 text-sm focus:outline-none focus:bg-white focus:border-gold-500">
                            @foreach($assignableRoles as $r)
                                <option value="{{ $r->value }}" {{ old('role', $user->role->value) === $r->value ? 'selected' : '' }}>
                                    {{ $r->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Account Activation
                        </label>
                        <div class="mt-2 flex items-center gap-3">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-slate-300 text-gold-600 focus:ring-gold-500 focus:ring-offset-0">
                                <span class="text-sm font-medium text-slate-700">Active and allowed to sign in</span>
                            </label>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-semibold text-slate-800">Role Privilege Tier</span>
                        <span class="text-xs text-slate-500">Current Role cannot be altered without elevated administrative governance</span>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded text-xs font-semibold {{ $user->role->badgeClasses() }}">
                        {{ $user->role->label() }}
                    </span>
                </div>
            @endif

            <!-- Password Reset Section (Optional) -->
            <div class="pt-4 border-t border-slate-100">
                <div class="mb-3">
                    <h3 class="text-sm font-semibold text-slate-900">Change Password</h3>
                    <p class="text-xs text-slate-500">Leave blank to retain current security credentials</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            New Password
                        </label>
                        <input type="password" id="password" name="password"
                               placeholder="Leave blank to keep existing"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Repeat new password"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-xs shadow-md shadow-gold-500/20 transition-all cursor-pointer">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
