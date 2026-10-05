@extends('layouts.admin')

@section('title', 'Add New User')
@section('header_title', 'Create User Account')
@section('header_subtitle', 'Provision account credentials and set authorization tier')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-slate-200/90 rounded-2xl p-8 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Account Details</h2>
                <p class="text-xs text-slate-500">Fill in institutional credentials for the new platform operator</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-500 hover:text-slate-900 font-medium flex items-center gap-1">
                <span>←</span> Back to Directory
            </a>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                    Full Name & Title <span class="text-gold-600">*</span>
                </label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                       placeholder="e.g. Dr. Alexander Vance"
                       class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
            </div>

            <!-- Email & Phone Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Official Email <span class="text-gold-600">*</span>
                    </label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                           placeholder="alexander@safirbusiness.com"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Direct Phone / Hotline
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           placeholder="+90 (___) ___ __ __"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>
            </div>

            <!-- Role & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="role" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Authorization Role Tier <span class="text-gold-600">*</span>
                    </label>
                    <select id="role" name="role" required
                            class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-800 text-sm focus:outline-none focus:bg-white focus:border-gold-500">
                        @foreach($assignableRoles as $r)
                            <option value="{{ $r->value }}" {{ old('role', 'editor') === $r->value ? 'selected' : '' }}>
                                {{ $r->label() }} — {{ match($r->value) {
                                    'superadmin' => 'Full unconstrained system authority',
                                    'admin'      => 'Operational user & settings governance',
                                    'editor'     => 'Intelligence and research content management',
                                    'guest'      => 'Restricted read-only portal view',
                                } }}
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-slate-300 text-gold-600 focus:ring-gold-500 focus:ring-offset-0">
                            <span class="text-sm font-medium text-slate-700">Active and allowed to sign in</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Passwords -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Initial Password <span class="text-gold-600">*</span>
                    </label>
                    <input type="password" id="password" name="password" required
                           placeholder="Minimum 8 characters"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Confirm Password <span class="text-gold-600">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           placeholder="Repeat password"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-xs shadow-md shadow-gold-500/20 transition-all cursor-pointer">
                    Provision Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
