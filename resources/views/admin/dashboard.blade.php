@extends('layouts.admin')

@section('title', 'Executive Dashboard')
@section('header_title', 'Strategic Operations Overview')
@section('header_subtitle', 'Institutional intelligence, user privileges, and portal telemetry')

@section('content')
<div class="space-y-8">

    <!-- Welcome Executive Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-white via-[#FAF8F5] to-white border border-slate-200/90 border-t-4 border-t-gold-500 p-8 shadow-sm">
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-gold-500/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $currentUser->role->badgeClasses() }}">
                        {{ $currentUser->role->label() }} Privilege
                    </span>
                    <span class="text-xs text-slate-500">Session Secure ({{ now()->format('d M Y, H:i') }})</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Welcome, <span class="gold-gradient-text">{{ $currentUser->name }}</span>
                </h2>
                <p class="mt-2 text-sm text-slate-600 max-w-2xl leading-relaxed">
                    @if($currentUser->isGuest())
                        Your credentials provide restricted guest visibility. Contact a Superadmin to request elevated operational clearance.
                    @else
                        Safir Business Hub centralized command telemetry. Monitor real-time diplomatic briefing requests, research publications, user authorization tiers, and branding configurations.
                    @endif
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @if($currentUser->hasRole('superadmin', 'admin'))
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-xs shadow-md shadow-gold-500/20 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>New User</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs border border-slate-200 transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        <span>Site Settings</span>
                    </a>
                @endif
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 hover:text-slate-900 font-medium text-xs border border-slate-200 transition-all cursor-pointer">
                    <span>Public Portal</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Core Metrics Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Users Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 relative overflow-hidden group hover:border-gold-500/40 hover:shadow-md transition-all shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">User Directory</span>
                <span class="p-2 rounded-xl bg-gold-500/10 text-gold-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['total_users'] }}</div>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="text-emerald-600 font-semibold">{{ $stats['active_users'] }} active</span>
                    <span>·</span>
                    <span>{{ $stats['superadmins_count'] }} Superadmin</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                @if($currentUser->hasRole('superadmin', 'admin'))
                    <a href="{{ route('admin.users.index') }}" class="text-gold-600 hover:text-gold-700 font-semibold flex items-center gap-1">
                        <span>Manage users</span>
                        <span>→</span>
                    </a>
                @else
                    <span class="text-slate-400">Restricted</span>
                @endif
            </div>
        </div>

        <!-- Inquiries Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 relative overflow-hidden group hover:border-gold-500/40 hover:shadow-md transition-all shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Advisory Inquiries</span>
                <span class="p-2 rounded-xl bg-blue-50 text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['total_inquiries'] }}</div>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="text-amber-600 font-semibold">{{ $stats['new_inquiries'] }} new pending</span>
                    <span>review</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Diplomatic & Corporate</span>
            </div>
        </div>

        <!-- Intelligence Publications Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 relative overflow-hidden group hover:border-gold-500/40 hover:shadow-md transition-all shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Intelligence Reports</span>
                <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['total_reports'] }}</div>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                    <span>{{ $stats['total_bulletins'] }} weekly bulletins archived</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route_ml('reports.index') }}" target="_blank" class="text-gold-600 hover:text-gold-700 font-semibold flex items-center gap-1">
                    <span>Browse reports</span>
                    <span>↗</span>
                </a>
            </div>
        </div>

        <!-- Institutional Subscribers Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 relative overflow-hidden group hover:border-gold-500/40 hover:shadow-md transition-all shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Subscribers</span>
                <span class="p-2 rounded-xl bg-purple-50 text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['total_subscribers'] }}</div>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                    <span>Embassy & Corporate Network</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Active Newsletter Feed</span>
            </div>
        </div>
    </div>

    <!-- Role Distribution & Breakdown -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Privilege Hierarchy Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-sm">
            <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <span>Privilege Distribution</span>
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span class="text-sm font-semibold text-slate-800">Superadmin</span>
                    </div>
                    <span class="text-sm font-bold text-amber-700 font-mono">{{ $stats['superadmins_count'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-sm font-semibold text-slate-800">Admin</span>
                    </div>
                    <span class="text-sm font-bold text-blue-700 font-mono">{{ $stats['admins_count'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-sm font-semibold text-slate-800">Editor</span>
                    </div>
                    <span class="text-sm font-bold text-emerald-700 font-mono">{{ $stats['editors_count'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                        <span class="text-sm font-semibold text-slate-800">Guest</span>
                    </div>
                    <span class="text-sm font-bold text-slate-600 font-mono">{{ $stats['guests_count'] }}</span>
                </div>
            </div>
        </div>

        <!-- Quick System Settings Status Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Website Configuration Profile</span>
                </h3>
                @if($currentUser->hasRole('superadmin', 'admin'))
                    <a href="{{ route('admin.settings.index') }}" class="text-xs text-gold-600 hover:text-gold-700 font-semibold">
                        Edit Settings →
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-slate-500">Portal Brand Name</span>
                    <span class="block text-sm font-semibold text-slate-900 mt-1">{{ setting('site_name', 'Safir Business Hub') }}</span>
                </div>
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-slate-500">Official Contact Email</span>
                    <span class="block text-sm font-semibold text-slate-900 mt-1">{{ setting('contact_email', 'contact@safirbusiness.com') }}</span>
                </div>
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-slate-500">Executive Headquarters</span>
                    <span class="block text-sm font-semibold text-slate-900 mt-1 truncate" title="{{ setting('office_address_ankara') }}">
                        {{ setting('office_address_ankara', 'Çankaya Diplomatic Quarter, Ankara') }}
                    </span>
                </div>
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-slate-500">Direct Phone / Hotline</span>
                    <span class="block text-sm font-semibold text-slate-900 mt-1">{{ setting('contact_phone', '+90 312 439 88 00') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    @if($currentUser->hasRole('superadmin', 'admin'))
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Recent User Registrations</h3>
                    <p class="text-xs text-slate-500">Latest accounts registered on the executive platform</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-gold-600 hover:text-gold-700 font-semibold flex items-center gap-1">
                    <span>View all users</span>
                    <span>→</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-4">User</th>
                            <th class="py-3 px-4">Role Tier</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Created</th>
                            <th class="py-3 px-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recentUsers as $user)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-8 h-8 rounded-full object-cover" src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                                        <div>
                                            <span class="block font-semibold text-slate-900 text-xs sm:text-sm">{{ $user->name }}</span>
                                            <span class="block text-[11px] text-slate-500">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-semibold {{ $user->role->badgeClasses() }}">
                                        {{ $user->role->label() }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    @if($user->is_active)
                                        <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs text-rose-600 font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-xs text-slate-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-3 px-4 text-right">
                                    @if($currentUser->is($user) || $currentUser->canManage($user))
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-xs text-gold-700 hover:text-gold-800 font-semibold px-2.5 py-1 rounded bg-gold-50 hover:bg-gold-100 border border-gold-200">
                                            Edit
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400">Locked</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Recent Inquiries Table -->
    <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Recent Strategic & Embassy Inquiries</h3>
                <p class="text-xs text-slate-500">Delegation briefing and bilateral advisory intake</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                {{ $stats['total_inquiries'] }} Total Records
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4">Contact & Organization</th>
                        <th class="py-3 px-4">Country</th>
                        <th class="py-3 px-4">Service Track</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentInquiries as $inquiry)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-3 px-4">
                                <span class="block font-semibold text-slate-900 text-xs sm:text-sm">{{ $inquiry->name }}</span>
                                <span class="block text-[11px] text-slate-500">{{ $inquiry->organization }} · {{ $inquiry->email }}</span>
                            </td>
                            <td class="py-3 px-4 text-xs font-medium text-slate-700">
                                {{ $inquiry->country }}
                            </td>
                            <td class="py-3 px-4 text-xs">
                                <span class="inline-flex px-2 py-0.5 rounded bg-slate-100 border border-slate-200 text-slate-700 text-[11px] font-mono">
                                    {{ ucfirst($inquiry->service_type) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold {{ $inquiry->status === 'new' ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-xs text-slate-500">
                                {{ $inquiry->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-xs text-slate-400">
                                No advisory inquiries received yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

