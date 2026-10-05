@extends('layouts.admin')

@section('title', 'User Management')
@section('header_title', 'User Directory & Role Access')
@section('header_subtitle', 'Manage Superadmins, Admins, Editors, and Guests with strict privilege controls')

@section('content')
<div class="space-y-6">

    <!-- Actions & Filter Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#0A192F] p-5 rounded-2xl border border-slate-800 shadow-xl">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex-1 flex flex-wrap items-center gap-3">
            <!-- Search -->
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, or phone..."
                       class="w-full pl-9 pr-4 py-2 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-xs focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
            </div>

            <!-- Role Filter -->
            <div class="w-36">
                <select name="role" onchange="this.form.submit()"
                        class="w-full px-3 py-2 bg-[#060D1A] border border-slate-700 rounded-xl text-white text-xs focus:outline-none focus:border-gold-500">
                    <option value="">All Roles</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->value }}" {{ $roleFilter === $r->value ? 'selected' : '' }}>
                            {{ $r->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div class="w-32">
                <select name="status" onchange="this.form.submit()"
                        class="w-full px-3 py-2 bg-[#060D1A] border border-slate-700 rounded-xl text-white text-xs focus:outline-none focus:border-gold-500">
                    <option value="">All Statuses</option>
                    <option value="1" {{ $statusFilter === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $statusFilter === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            @if($search || $roleFilter || $statusFilter !== null)
                <a href="{{ route('admin.users.index') }}" class="px-3 py-2 rounded-xl bg-slate-800 text-slate-300 hover:text-white text-xs font-medium">
                    Clear
                </a>
            @endif
        </form>

        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-xs shadow-lg shadow-gold-500/20 transition-all cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Add New User</span>
        </a>
    </div>

    <!-- Users Table Card -->
    <div class="bg-[#0A192F] border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/80 text-[11px] uppercase tracking-wider text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="py-3.5 px-6">User / Identity</th>
                        <th class="py-3.5 px-6">Role Tier</th>
                        <th class="py-3.5 px-6">Phone Number</th>
                        <th class="py-3.5 px-6">Account Status</th>
                        <th class="py-3.5 px-6">Registered</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <!-- Name / Email -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img class="w-9 h-9 rounded-full object-cover ring-2 ring-slate-800" src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                                    <div>
                                        <div class="font-bold text-white text-sm flex items-center gap-2">
                                            <span>{{ $user->name }}</span>
                                            @if(auth()->user()->is($user))
                                                <span class="px-1.5 py-0.5 rounded bg-gold-500/20 text-gold-300 text-[10px] font-mono">You</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-slate-400 font-mono">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Role -->
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold {{ $user->role->badgeClasses() }}">
                                    {{ $user->role->label() }}
                                </span>
                            </td>

                            <!-- Phone -->
                            <td class="py-4 px-6 text-xs text-slate-300 font-mono">
                                {{ $user->phone ?: '—' }}
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-6">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span> Deactivated
                                    </span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-6 text-xs text-slate-400">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if(auth()->user()->is($user) || auth()->user()->canManage($user))
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="px-2.5 py-1 rounded-lg text-xs font-semibold text-gold-400 hover:text-navy-950 bg-gold-500/10 hover:bg-gold-400 border border-gold-500/30 transition-all">
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->user()->canManage($user))
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete user {{ $user->name }}? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold text-rose-400 hover:text-white bg-rose-500/10 hover:bg-rose-600 border border-rose-500/20 transition-all cursor-pointer">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                    @if(!auth()->user()->is($user) && !auth()->user()->canManage($user))
                                        <span class="text-xs text-slate-600 italic">Protected</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="text-sm font-semibold text-white">No users found</p>
                                <p class="text-xs mt-1">Try modifying your filter parameters or query term.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-slate-800 bg-slate-900/40">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
