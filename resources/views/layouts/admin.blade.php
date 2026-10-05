<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9F6]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Executive Hub') | {{ setting('site_name', 'Safir Business Hub') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    {!! setting('custom_header_scripts', '') !!}
</head>
<body class="h-full bg-[#FAF9F6] text-slate-800 antialiased font-sans selection:bg-gold-500/25 selection:text-navy-950 flex" x-data="{ mobileSidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="mobileSidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileSidebarOpen = false"
         class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden" style="display: none;"></div>

    <!-- Sidebar Component -->
    <aside :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200/90 flex flex-col transition-transform duration-300 ease-in-out lg:static lg:inset-auto lg:translate-x-0 shadow-sm">
        
        <!-- Logo & Hub Branding -->
        <div class="h-20 flex items-center justify-between px-6 border-b border-slate-100 bg-[#FAF9F6]/80">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gold-400 via-gold-500 to-gold-600 flex items-center justify-center shadow-md shadow-gold-500/20 text-navy-950 font-bold text-xl tracking-wider">
                    S
                </div>
                <div>
                    <span class="block text-base font-bold tracking-tight text-[#0A192F] group-hover:text-gold-600 transition-colors">
                        SAFIR <span class="text-gold-600">HUB</span>
                    </span>
                    <span class="block text-[10px] tracking-widest uppercase text-slate-500 font-medium">Executive Panel</span>
                </div>
            </a>
            <button @click="mobileSidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-slate-500 hover:text-slate-800 hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- User Role Profile Brief -->
        <div class="p-4 mx-4 my-4 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
            <img class="w-10 h-10 rounded-full object-cover ring-2 ring-gold-500/30" src="{{ auth()->user()->avatarUrl() }}" alt="{{ auth()->user()->name }}">
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                <div class="flex items-center gap-2 mt-0.5">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium {{ auth()->user()->role->badgeClasses() }}">
                        {{ auth()->user()->role->label() }}
                    </span>
                    @if(auth()->user()->is_active)
                        <span class="w-2 h-2 rounded-full bg-emerald-500" title="Active"></span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
            <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Navigation</div>

            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-gold-500/10 text-gold-700 border border-gold-500/30 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-gold-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            @if(auth()->user()->hasRole('superadmin', 'admin'))
                <div class="pt-4 px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Management Modules</div>

                <!-- Users Module -->
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.users.*') ? 'bg-gold-500/10 text-gold-700 border border-gold-500/30 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-gold-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>User Management</span>
                </a>

                <!-- Website Settings Module -->
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-gold-500/10 text-gold-700 border border-gold-500/30 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.settings.*') ? 'text-gold-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Website Settings</span>
                </a>
            @endif

            <div class="pt-4 px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Quick Portal</div>

            <!-- View Public Site -->
            <a href="{{ url('/') }}" target="_blank" 
               class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-gold-700 transition-all">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span>View Public Website</span>
                </div>
                <span class="text-xs text-slate-400">↗</span>
            </a>
        </nav>

        <!-- Footer / Logout -->
        <div class="p-4 border-t border-slate-100 bg-[#FAF9F6]/80">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Topbar -->
        <header class="h-20 bg-white/90 backdrop-blur-md border-b border-slate-200/90 px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-4">
                <button @click="mobileSidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                        @yield('header_title', 'Executive Management')
                    </h1>
                    <p class="text-xs text-slate-500 hidden sm:block">
                        @yield('header_subtitle', 'Safir Business Operations & Strategic Governance')
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- Live Website Quick Badge -->
                <a href="{{ url('/') }}" target="_blank" class="hidden md:inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold text-gold-700 bg-gold-500/10 border border-gold-500/25 hover:bg-gold-500/20 transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Live Portal</span>
                    <svg class="w-3 h-3 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>

                <!-- Profile Dropdown or Direct Info -->
                <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                    <div class="text-right hidden sm:block">
                        <span class="block text-xs font-semibold text-slate-900">{{ auth()->user()->name }}</span>
                        <span class="block text-[10px] text-slate-500">{{ auth()->user()->email }}</span>
                    </div>
                    <img class="w-9 h-9 rounded-full object-cover ring-2 ring-gold-500/30" src="{{ auth()->user()->avatarUrl() }}" alt="{{ auth()->user()->name }}">
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-10">
            <!-- Flash Status Alerts -->
            @if (session('status'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 flex items-center gap-3 shadow-xs">
                    <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800 shadow-xs">
                    <div class="flex items-center gap-2 mb-2 font-semibold text-sm text-rose-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>Please address the following requirements:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {!! setting('custom_footer_scripts', '') !!}
</body>
</html>
