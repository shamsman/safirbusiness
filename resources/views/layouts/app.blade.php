<!DOCTYPE html>
<html lang="{{ $currentLocale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('safir.brand_name') . ' — ' . __('safir.tagline'))</title>
    <meta name="description" content="@yield('meta_description', __('safir.short_bio'))">
    <meta name="keywords" content="Ankara advisory, Türkiye corporate entry, embassies Turkey, B2B matchmaking Ankara, economic reports Turkey, diplomatic advisory, Safir Business Hub">

    <!-- OpenGraph / Social -->
    <meta property="og:title" content="@yield('title', __('safir.brand_name') . ' — ' . __('safir.tagline'))">
    <meta property="og:description" content="@yield('meta_description', __('safir.short_bio'))">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ $currentLocale }}">

    <!-- Google Fonts: Tajawal & Cairo for Arabic, Plus Jakarta Sans for Latin -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Compiled Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(setting('google_analytics_id'))
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('google_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ setting('google_analytics_id') }}');
        </script>
    @endif

    {!! setting('custom_header_scripts', '') !!}

    @stack('styles')
</head>
<body class="bg-[#FAF9F6] text-[#0A192F] min-h-screen flex flex-col font-sans selection:bg-gold-500/25 selection:text-[#0A192F]">

    <!-- Top Diplomatic & Executive Bar -->
    <div class="bg-[#F4F3EE] border-b border-[#E2DDD3] text-xs text-slate-600 py-2.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <!-- Left Info: Ankara HQ & Desks -->
            <div class="flex items-center gap-4 flex-wrap justify-center sm:justify-start">
                <span class="inline-flex items-center gap-1.5 text-gold-800 font-semibold">
                    <svg class="w-3.5 h-3.5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ __('safir.location_badge') }} · Söğütözü, Çankaya
                </span>
                <span class="hidden md:inline text-slate-300">|</span>
                @php
                    $sitePhone = setting('contact_phone', setting('footer_phone_main', '+90 501 241 43 84'));
                @endphp
                @if($sitePhone)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $sitePhone) }}" class="hover:text-gold-700 transition-colors hidden md:inline-flex items-center gap-1.5 text-slate-600">
                    <svg class="w-3.5 h-3.5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span class="font-mono text-slate-800 font-medium">{{ $sitePhone }}</span>
                </a>
                @endif
                <span class="hidden lg:inline text-slate-300">|</span>
                <a href="mailto:{{ setting('contact_email', 'hello@safirbusinesshub.com') }}" class="hover:text-gold-700 transition-colors hidden lg:inline-flex items-center gap-1 font-mono text-slate-600">
                    {{ setting('contact_email', 'hello@safirbusinesshub.com') }}
                </a>
            </div>

            <!-- Right Actions: Language Switcher & Quick Portal -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1 bg-white border border-[#E2DDD3] rounded-full px-1.5 py-0.5 shadow-2xs">
                    @foreach($supportedLocales as $loc)
                        <a href="{{ route('locale.switch', $loc) }}" 
                           class="px-2.5 py-0.5 rounded-full text-xs font-semibold transition-all {{ $currentLocale === $loc ? 'bg-gold-500 text-navy-950 shadow-xs' : 'text-slate-600 hover:text-gold-700' }}">
                            {{ $localeLabels[$loc]['native'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Executive Portal / Login Link -->
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-navy-900 text-gold-300 hover:bg-navy-800 transition-all shadow-xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ __('safir.nav.dashboard') }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium text-slate-700 hover:text-gold-800 hover:bg-white/80 transition-all">
                        <span>{{ __('safir.nav.executive_login') }}</span>
                        <span class="text-slate-400">→</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-[#E8E4DA] shadow-2xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Emblem -->
                <a href="{{ route_ml('home') }}" class="flex items-center gap-3.5 group shrink-0">
                    @if(setting('site_logo') && media_url(setting('site_logo')))
                        <img src="{{ media_url(setting('site_logo')) }}" alt="{{ setting('site_name', 'Safir') }}" class="h-11 w-auto max-w-[160px] object-contain">
                    @else
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-gold-400 via-gold-500 to-gold-600 flex items-center justify-center shadow-md shadow-gold-500/10 border border-gold-300/40 group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6 text-navy-950" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                <polyline points="2 17 12 22 22 17"/>
                                <polyline points="2 12 12 17 22 12"/>
                            </svg>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <div class="font-extrabold text-lg tracking-wider text-[#0A192F] uppercase flex items-center gap-2">
                            <span>{{ setting('site_name') ? explode(' ', setting('site_name'))[0] : 'SAFIR' }}</span>
                            <span class="text-[11px] px-2 py-0.5 rounded bg-gold-50 text-gold-700 border border-gold-300 font-semibold tracking-normal normal-case">
                                {{ setting('site_name') && count(explode(' ', setting('site_name'))) > 1 ? implode(' ', array_slice(explode(' ', setting('site_name')), 1)) : 'Business Hub' }}
                            </span>
                        </div>
                        <span class="text-[11px] text-slate-500 tracking-tight font-medium">
                            {{ __('safir.header_tagline') }}
                        </span>
                    </div>
                </a>

                <!-- Desktop Mega Navigation: refined text-xs font-semibold, single line, no large text wrapping -->
                <nav class="hidden xl:flex items-center gap-0.5">
                    
                    <!-- 1. Economy & Knowledge Dropdown -->
                    <div class="relative group" id="dropdown-economy">
                        <button type="button" class="flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold text-slate-700 hover:text-gold-700 group-hover:text-gold-700 whitespace-nowrap transition-colors">
                            <span>{{ __('safir.nav.economy') }}</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute {{ $isRtl ? 'right-0' : 'left-0' }} top-full w-80 pt-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-white border border-[#E2DDD3] rounded-xl p-3 shadow-xl shadow-slate-900/10">
                                <div class="px-3 py-2 border-b border-[#EFECE6] mb-2">
                                    <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider">{{ __('safir.pillars.economy.title') }}</div>
                                    <div class="text-[11px] text-slate-500">{{ __('safir.nav.economy_sub') }}</div>
                                </div>
                                <div class="space-y-1">
                                    <a href="{{ route_ml('reports.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                        <span>{{ __('safir.pillars.economy.items.general_reports') }}</span>
                                    </a>
                                    <a href="{{ route_ml('reports.index', ['category' => 'macro_markets']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                        <span>{{ __('safir.pillars.economy.items.market_studies') }}</span>
                                    </a>
                                    <a href="{{ route_ml('reports.index', ['category' => 'diplomacy']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        <span>{{ __('safir.pillars.economy.items.political_reports') }}</span>
                                    </a>
                                    <a href="{{ route_ml('bulletin') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-gold-700 font-semibold bg-gold-50 hover:bg-gold-100 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                        <span>{{ __('safir.pillars.economy.items.weekly_bulletin') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Relations & Business Dropdown -->
                    <div class="relative group" id="dropdown-relations">
                        <button type="button" class="flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold text-slate-700 hover:text-gold-700 group-hover:text-gold-700 whitespace-nowrap transition-colors">
                            <span>{{ __('safir.nav.relations') }}</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute {{ $isRtl ? 'right-0' : 'left-0' }} top-full w-84 pt-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-white border border-[#E2DDD3] rounded-xl p-3 shadow-xl shadow-slate-900/10">
                                <div class="px-3 py-2 border-b border-[#EFECE6] mb-2">
                                    <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider">{{ __('safir.pillars.relations.title') }}</div>
                                    <div class="text-[11px] text-slate-500">{{ __('safir.nav.relations_sub') }}</div>
                                </div>
                                <div class="space-y-1">
                                    <a href="{{ route_ml('services.pillar', 'relations') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        <span>{{ __('safir.pillars.relations.items.b2b_matchmaking') }}</span>
                                    </a>
                                    <a href="{{ route_ml('services.pillar', 'relations') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        <span>{{ __('safir.pillars.relations.items.chambers') }}</span>
                                    </a>
                                    <a href="{{ route_ml('services.pillar', 'relations') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                                        <span>{{ __('safir.pillars.relations.items.government_relations') }}</span>
                                    </a>
                                    <a href="{{ route_ml('embassies') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-gold-700 font-semibold bg-gold-50 hover:bg-gold-100 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                                        <span>{{ __('safir.pillars.relations.items.embassies_support') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Conferences & Events Dropdown -->
                    <div class="relative group" id="dropdown-events">
                        <button type="button" class="flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold text-slate-700 hover:text-gold-700 group-hover:text-gold-700 whitespace-nowrap transition-colors">
                            <span>{{ __('safir.nav.events') }}</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute {{ $isRtl ? 'right-0' : 'left-0' }} top-full w-84 pt-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-white border border-[#E2DDD3] rounded-xl p-3 shadow-xl shadow-slate-900/10">
                                <div class="px-3 py-2 border-b border-[#EFECE6] mb-2">
                                    <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider">{{ __('safir.pillars.events.title') }}</div>
                                    <div class="text-[11px] text-slate-500">{{ __('safir.nav.events_sub') }}</div>
                                </div>
                                <div class="space-y-1">
                                    <a href="{{ route_ml('services.pillar', 'events') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"/></svg>
                                        <span>{{ __('safir.pillars.events.items.conferences') }}</span>
                                    </a>
                                    <a href="{{ route_ml('services.pillar', 'events') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        <span>{{ __('safir.pillars.events.items.press_conferences') }}</span>
                                    </a>
                                    <a href="{{ route_ml('services.pillar', 'events') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <span>{{ __('safir.pillars.events.items.consular_services') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Media & Community Dropdown -->
                    <div class="relative group" id="dropdown-community">
                        <button type="button" class="flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold text-slate-700 hover:text-gold-700 group-hover:text-gold-700 whitespace-nowrap transition-colors">
                            <span>{{ __('safir.nav.community') }}</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute {{ $isRtl ? 'right-0' : 'left-0' }} top-full w-84 pt-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-white border border-[#E2DDD3] rounded-xl p-3 shadow-xl shadow-slate-900/10">
                                <div class="px-3 py-2 border-b border-[#EFECE6] mb-2">
                                    <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider">{{ __('safir.pillars.community.title') }}</div>
                                    <div class="text-[11px] text-slate-500">{{ __('safir.nav.community_sub') }}</div>
                                </div>
                                <div class="space-y-1">
                                    <a href="{{ route_ml('services.pillar', 'community') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                        <span>{{ __('safir.pillars.community.items.media_relations') }}</span>
                                    </a>
                                    <a href="{{ route_ml('services.pillar', 'community') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        <span>{{ __('safir.pillars.community.items.civil_society') }}</span>
                                    </a>
                                    <a href="{{ route_ml('services.pillar', 'community') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-700 hover:bg-gold-50 hover:text-gold-800 transition-colors">
                                        <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        <span>{{ __('safir.pillars.community.items.charitable_initiatives') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Portals with Clean, Compact Typography -->
                    <a href="{{ route_ml('embassies') }}" class="px-2.5 py-1.5 text-xs font-semibold whitespace-nowrap {{ request()->routeIs('embassies') ? 'text-gold-700 font-bold' : 'text-slate-700 hover:text-gold-700' }} transition-colors">
                        {{ __('safir.nav.embassies') }}
                    </a>
                    <a href="{{ route_ml('corporates') }}" class="px-2.5 py-1.5 text-xs font-semibold whitespace-nowrap {{ request()->routeIs('corporates') ? 'text-gold-700 font-bold' : 'text-slate-700 hover:text-gold-700' }} transition-colors">
                        {{ __('safir.nav.corporates') }}
                    </a>
                    <a href="{{ route_ml('reports.index') }}" class="px-2.5 py-1.5 text-xs font-semibold whitespace-nowrap {{ request()->routeIs('reports.*') ? 'text-gold-700 font-bold' : 'text-slate-700 hover:text-gold-700' }} transition-colors">
                        {{ __('safir.nav.reports') }}
                    </a>
                    <a href="{{ route_ml('contact') }}" class="px-2.5 py-1.5 text-xs font-semibold whitespace-nowrap {{ request()->routeIs('contact') ? 'text-gold-700 font-bold' : 'text-slate-700 hover:text-gold-700' }} transition-colors">
                        {{ __('safir.nav.contact') }}
                    </a>
                </nav>

                <!-- Primary Action CTA -->
                <div class="hidden md:flex items-center gap-3 shrink-0">
                    <a href="{{ route_ml('contact') }}" class="relative group inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-400 hover:from-gold-300 hover:to-gold-400 shadow-sm shadow-gold-500/20 transition-all hover:scale-102 whitespace-nowrap">
                        <span>{{ __('safir.nav.request_briefing') }}</span>
                        <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1 {{ $isRtl ? 'rotate-180 group-hover:-translate-x-1' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <button type="button" id="mobile-menu-btn" class="xl:hidden p-2 rounded-lg text-slate-700 hover:text-gold-700 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden xl:hidden bg-white border-b border-[#E2DDD3] px-6 py-6 shadow-xl transition-all">
            <div class="space-y-4">
                <div class="border-b border-slate-200 pb-4">
                    <div class="text-xs font-bold text-gold-700 uppercase tracking-wider mb-2">{{ __('safir.pillars.economy.title') }}</div>
                    <div class="grid grid-cols-1 gap-2 text-xs text-slate-700">
                        <a href="{{ route_ml('reports.index') }}" class="hover:text-gold-700">· {{ __('safir.pillars.economy.items.general_reports') }}</a>
                        <a href="{{ route_ml('bulletin') }}" class="text-gold-700 font-medium">· {{ __('safir.pillars.economy.items.weekly_bulletin') }}</a>
                    </div>
                </div>

                <div class="border-b border-slate-200 pb-4">
                    <div class="text-xs font-bold text-gold-700 uppercase tracking-wider mb-2">{{ __('safir.pillars.relations.title') }}</div>
                    <div class="grid grid-cols-1 gap-2 text-xs text-slate-700">
                        <a href="{{ route_ml('services.pillar', 'relations') }}" class="hover:text-gold-700">· {{ __('safir.pillars.relations.items.b2b_matchmaking') }}</a>
                        <a href="{{ route_ml('embassies') }}" class="hover:text-gold-700">· {{ __('safir.pillars.relations.items.embassies_support') }}</a>
                    </div>
                </div>

                <div class="border-b border-slate-200 pb-4">
                    <div class="text-xs font-bold text-gold-700 uppercase tracking-wider mb-2">{{ __('safir.pillars.events.title') }}</div>
                    <div class="grid grid-cols-1 gap-2 text-xs text-slate-700">
                        <a href="{{ route_ml('services.pillar', 'events') }}" class="hover:text-gold-700">· {{ __('safir.pillars.events.items.conferences') }}</a>
                        <a href="{{ route_ml('services.pillar', 'events') }}" class="hover:text-gold-700">· {{ __('safir.pillars.events.items.consular_services') }}</a>
                    </div>
                </div>

                <div class="border-b border-slate-200 pb-4">
                    <div class="text-xs font-bold text-gold-700 uppercase tracking-wider mb-2">{{ __('safir.pillars.community.title') }}</div>
                    <div class="grid grid-cols-1 gap-2 text-xs text-slate-700">
                        <a href="{{ route_ml('services.pillar', 'community') }}" class="hover:text-gold-700">· {{ __('safir.pillars.community.items.media_relations') }}</a>
                        <a href="{{ route_ml('services.pillar', 'community') }}" class="hover:text-gold-700">· {{ __('safir.pillars.community.items.civil_society') }}</a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-2 text-xs font-semibold text-slate-800">
                    <a href="{{ route_ml('embassies') }}" class="p-2 rounded-lg bg-slate-50 border border-slate-200 hover:border-gold-400 text-center">{{ __('safir.nav.embassies') }}</a>
                    <a href="{{ route_ml('corporates') }}" class="p-2 rounded-lg bg-slate-50 border border-slate-200 hover:border-gold-400 text-center">{{ __('safir.nav.corporates') }}</a>
                    <a href="{{ route_ml('reports.index') }}" class="p-2 rounded-lg bg-slate-50 border border-slate-200 hover:border-gold-400 text-center">{{ __('safir.nav.reports') }}</a>
                    <a href="{{ route_ml('contact') }}" class="p-2 rounded-lg bg-slate-50 border border-slate-200 hover:border-gold-400 text-center">{{ __('safir.nav.contact') }}</a>
                </div>

                <div class="pt-2">
                    <a href="{{ route_ml('contact') }}" class="block text-center w-full py-3 rounded-lg font-bold text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500">
                        {{ __('safir.nav.request_briefing') }}
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Global Notification Flash Messages -->
    @if(session('success_inquiry') || session('success_subscription'))
        <div class="bg-gradient-to-r from-gold-600 via-gold-500 to-gold-600 text-navy-950 py-3.5 px-4 shadow-lg border-b border-gold-400 text-center text-sm font-bold flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ session('success_inquiry') ?? session('success_subscription') }}</span>
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Global Corporate Call To Action Banner (Unless suppressed) -->
    @unless(View::hasSection('hide_cta'))
    <section class="relative py-16 bg-gradient-to-b from-[#FAF9F5] to-[#F1ECE1] border-t border-[#E8E4DA] overflow-hidden">
        <div class="absolute inset-0 bg-embassy-pattern opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="glass-panel p-8 sm:p-12 rounded-2xl border-gold-400/40 flex flex-col lg:flex-row items-center justify-between gap-8 shadow-lg">
                <div class="max-w-2xl text-center lg:text-start">
                    <span class="inline-block text-xs uppercase tracking-widest text-gold-800 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200 mb-3">
                        {{ __('safir.global_cta.badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight mb-3">
                        {{ __('safir.global_cta.title') }}
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        {{ __('safir.global_cta.subtitle') }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-4 shrink-0 w-full sm:w-auto">
                    <a href="{{ route_ml('contact') }}" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-lg text-sm font-bold text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 hover:from-gold-300 hover:to-gold-400 shadow-md shadow-gold-500/20 transition-all">
                        {{ __('safir.global_cta.btn_contact') }}
                    </a>
                    <a href="{{ route_ml('embassies') }}" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-lg text-sm font-semibold text-slate-800 bg-white border border-slate-300 hover:border-gold-500 transition-all">
                        {{ __('safir.global_cta.btn_embassies') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endunless

    <!-- Luxury Diplomatic Footer -->
    <footer class="bg-navy-950 border-t border-gold-500/20 text-slate-400 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                
                <!-- Col 1: Brand & Philosophy (2 cols wide on desktop) -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-navy-950 font-bold overflow-hidden shrink-0">
                            @if(setting('site_logo') && media_url(setting('site_logo')))
                                <img src="{{ media_url(setting('site_logo')) }}" alt="Logo" class="max-h-full max-w-full object-contain">
                            @else
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                    <polyline points="2 17 12 22 22 17"/>
                                    <polyline points="2 12 12 17 22 12"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <div class="text-base font-extrabold text-slate-100 tracking-wider uppercase">{{ setting('footer_brand_title', setting('site_name', 'SAFIR BUSINESS HUB')) }}</div>
                            <div class="text-[10px] text-gold-400 tracking-wider uppercase font-semibold">{{ setting('footer_badge_text', __('safir.location_badge')) }}</div>
                        </div>
                    </div>
                    
                    <p class="text-slate-300 text-sm leading-relaxed">
                        {{ setting('footer_about', __('safir.footer.about_text')) }}
                    </p>

                    <!-- Memorable Brand Signature -->
                    @if(setting('footer_signature', __('safir.brand_signature')))
                    <div class="pt-2 border-t border-white/5">
                        <div class="text-gold-400 font-bold italic text-sm">
                            « {{ setting('footer_signature', __('safir.brand_signature')) }} »
                        </div>
                    </div>
                    @endif

                    <!-- Social Channels -->
                    @if(setting('footer_show_social', '1') == '1' && (setting('social_linkedin') || setting('social_twitter') || setting('social_instagram') || setting('social_youtube')))
                        <div class="flex items-center gap-2.5 pt-2">
                            @if(setting('social_linkedin'))
                                <a href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 hover:border-gold-500/50 hover:bg-gold-500/10 hover:text-gold-400 flex items-center justify-center text-slate-400 transition-colors" title="LinkedIn">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                </a>
                            @endif
                            @if(setting('social_twitter'))
                                <a href="{{ setting('social_twitter') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 hover:border-gold-500/50 hover:bg-gold-500/10 hover:text-gold-400 flex items-center justify-center text-slate-400 transition-colors" title="X / Twitter">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if(setting('social_instagram'))
                                <a href="{{ setting('social_instagram') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 hover:border-gold-500/50 hover:bg-gold-500/10 hover:text-gold-400 flex items-center justify-center text-slate-400 transition-colors" title="Instagram">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                </a>
                            @endif
                            @if(setting('social_youtube'))
                                <a href="{{ setting('social_youtube') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 hover:border-gold-500/50 hover:bg-gold-500/10 hover:text-gold-400 flex items-center justify-center text-slate-400 transition-colors" title="YouTube">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Col 2: The 4 Pillars -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-4">{{ setting('footer_pillars_title', __('safir.footer.services_title')) }}</h3>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route_ml('services.pillar', 'economy') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.pillars.economy.title') }}</a></li>
                        <li><a href="{{ route_ml('services.pillar', 'relations') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.pillars.relations.title') }}</a></li>
                        <li><a href="{{ route_ml('services.pillar', 'events') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.pillars.events.title') }}</a></li>
                        <li><a href="{{ route_ml('services.pillar', 'community') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.pillars.community.title') }}</a></li>
                        <li><a href="{{ route_ml('services.index') }}" class="text-gold-400 font-semibold hover:underline">→ {{ __('safir.nav.services') }}</a></li>
                    </ul>
                </div>

                <!-- Col 3: Key Portals -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-4">{{ setting('footer_quick_links_title', __('safir.footer.quick_links')) }}</h3>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route_ml('embassies') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.nav.embassies') }}</a></li>
                        <li><a href="{{ route_ml('corporates') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.nav.corporates') }}</a></li>
                        <li><a href="{{ route_ml('reports.index') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.nav.reports') }}</a></li>
                        <li><a href="{{ route_ml('bulletin') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.nav.bulletin') }}</a></li>
                        <li><a href="{{ route_ml('about') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.nav.about') }}</a></li>
                        <li><a href="{{ route_ml('contact') }}" class="hover:text-gold-400 transition-colors">{{ __('safir.nav.contact') }}</a></li>
                    </ul>
                </div>

                <!-- Col 4: Ankara Headquarters -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-4">{{ setting('footer_hq_title', __('safir.footer.contact_title')) }}</h3>
                    <div class="space-y-2.5 text-slate-300 text-xs">
                        <p class="leading-relaxed">
                            {{ setting('footer_address', setting('office_address_ankara', __('safir.contact.address'))) }}
                        </p>
                        @if(setting('footer_address_note', __('safir.contact.address_note')))
                        <p class="text-[11px] text-slate-400">
                            {{ setting('footer_address_note', __('safir.contact.address_note')) }}
                        </p>
                        @endif
                        @php
                            $footerPhone = setting('footer_phone_main', setting('contact_phone', '+90 501 241 43 84'));
                        @endphp
                        @if($footerPhone)
                        <div class="pt-2">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="inline-flex items-center gap-2 font-mono text-xs text-gold-400 hover:text-gold-300 transition-colors">
                                <svg class="w-3.5 h-3.5 text-gold-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>{{ $footerPhone }}</span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Bottom Legal & Copyright -->
            <div class="mt-12 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-slate-400 text-xs">
                <div>
                    {{ setting('footer_copyright', '© ' . date('Y') . ' ' . setting('site_name', __('safir.brand_name')) . '. ' . __('safir.footer.rights')) }}
                </div>
                <div class="flex items-center gap-6">
                    <span class="hover:text-slate-300">{{ setting('footer_privacy_text', __('safir.footer.privacy')) }}</span>
                    <span class="hover:text-slate-300">{{ setting('footer_terms_text', __('safir.footer.terms')) }}</span>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gold-400 transition-colors">Executive Portal</a>
                    <a href="/migrate.php" class="text-slate-600 hover:text-gold-500 font-mono text-[10px]" title="Live Migration Console">System Status</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Vanilla JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Inline Newsletter AJAX Handling
            const newsletterForms = document.querySelectorAll('.newsletter-ajax-form');
            newsletterForms.forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.innerHTML;
                    const feedbackEl = form.querySelector('.form-feedback') || document.createElement('div');
                    feedbackEl.className = 'form-feedback text-xs mt-2 font-medium';
                    form.appendChild(feedbackEl);

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '...';

                    const formData = new FormData(form);
                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: formData
                        });

                        const result = await response.json();
                        if (response.ok && result.success) {
                            feedbackEl.className = 'form-feedback text-xs mt-2 font-bold text-green-400';
                            feedbackEl.textContent = result.message;
                            form.reset();
                        } else {
                            feedbackEl.className = 'form-feedback text-xs mt-2 font-medium text-red-400';
                            feedbackEl.textContent = result.message || 'Please check your email address and try again.';
                        }
                    } catch (err) {
                        feedbackEl.className = 'form-feedback text-xs mt-2 font-medium text-red-400';
                        feedbackEl.textContent = 'Connection error. Please try again.';
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                });
            });
        });
    </script>
    @stack('scripts')
    {!! setting('custom_footer_scripts', '') !!}
</body>
</html>
