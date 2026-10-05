@extends('layouts.app')

@section('title', __('safir.brand_name') . ' — ' . __('safir.hero.title'))
@section('meta_description', __('safir.hero.subtitle'))

@section('content')

    <!-- HERO SECTION -->
    <section class="relative pt-12 pb-24 md:pt-20 md:pb-32 overflow-hidden bg-gradient-to-b from-[#FFFFFF] via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E5E0D5]">
        <!-- Subtle Background Glows & Pattern -->
        <div class="absolute inset-0 bg-embassy-pattern opacity-60"></div>
        <div class="absolute top-1/4 {{ $isRtl ? 'left-1/4' : 'right-1/4' }} w-96 h-96 bg-gold-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 {{ $isRtl ? 'right-10' : 'left-10' }} w-80 h-80 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left / Main Hero Content (7 Cols) -->
                <div class="lg:col-span-7 space-y-6 text-center lg:{{ $isRtl ? 'text-right' : 'text-left' }}">
                    
                    <!-- Diplomatic Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gold-50 border border-gold-300 text-gold-800 text-xs font-semibold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-gold-600 animate-pulse"></span>
                        {{ __('safir.hero.badge') }}
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0A192F] tracking-tight leading-tight">
                        <span class="block text-[#0A192F]">{{ __('safir.hero.title') }}</span>
                    </h1>

                    <!-- Subtitle / Bio -->
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                        {{ __('safir.hero.subtitle') }}
                    </p>

                    <!-- CTA Actions -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route_ml('contact') }}" class="w-full sm:w-auto px-7 py-3.5 rounded-xl font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-400 hover:from-gold-300 hover:to-gold-400 shadow-lg shadow-gold-500/20 text-center transition-all hover:scale-102 flex items-center justify-center gap-2 text-sm">
                            <span>{{ __('safir.hero.cta_contact') }}</span>
                            <svg class="w-4 h-4 {{ $isRtl ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route_ml('services.index') }}" class="w-full sm:w-auto px-7 py-3.5 rounded-xl font-semibold text-slate-800 bg-white hover:bg-slate-50 border border-slate-300 shadow-2xs text-center transition-all text-sm">
                            {{ __('safir.hero.cta_services') }}
                        </a>
                        <a href="{{ route_ml('reports.index') }}" class="w-full sm:w-auto px-5 py-3.5 text-gold-700 hover:text-gold-800 font-semibold text-center text-sm inline-flex items-center justify-center gap-1.5 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>{{ __('safir.hero.cta_reports') }}</span>
                        </a>
                    </div>

                    <!-- Trust Bar / Core Quote -->
                    <div class="pt-6 border-t border-[#E5E0D5]">
                        <blockquote class="text-xs sm:text-sm text-slate-500 italic">
                            « {{ __('safir.philosophy') }} »
                        </blockquote>
                    </div>
                </div>

                <!-- Right / Stats & Diplomatic Card Grid (5 Cols) -->
                <div class="lg:col-span-5">
                    <div class="glass-panel p-6 sm:p-8 rounded-2xl border-gold-400/40 relative shadow-xl shadow-slate-900/5">
                        <div class="text-xs font-bold uppercase tracking-wider text-gold-800 mb-6 flex items-center justify-between border-b border-slate-200/80 pb-3">
                            <span>{{ __('safir.location_badge') }} · {{ __('safir.hero.advisory_matrix') }}</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Stat 1 -->
                            <div class="bg-[#F8F9FA] p-4 rounded-xl border border-slate-200/80 hover:border-gold-400/50 hover:bg-gold-50/20 transition-all">
                                <div class="text-3xl font-extrabold text-[#0A192F] tracking-tight">{{ __('safir.hero.stats.engagements') }}</div>
                                <div class="text-xs text-slate-600 mt-1 font-medium">{{ __('safir.hero.stats.engagements_label') }}</div>
                            </div>
                            
                            <!-- Stat 2 -->
                            <div class="bg-[#F8F9FA] p-4 rounded-xl border border-slate-200/80 hover:border-gold-400/50 hover:bg-gold-50/20 transition-all">
                                <div class="text-3xl font-extrabold text-[#0A192F] tracking-tight">{{ __('safir.hero.stats.reports') }}</div>
                                <div class="text-xs text-slate-600 mt-1 font-medium">{{ __('safir.hero.stats.reports_label') }}</div>
                            </div>

                            <!-- Stat 3 -->
                            <div class="bg-[#F8F9FA] p-4 rounded-xl border border-slate-200/80 hover:border-gold-400/50 hover:bg-gold-50/20 transition-all">
                                <div class="text-3xl font-extrabold text-[#0A192F] tracking-tight">{{ __('safir.hero.stats.delegations') }}</div>
                                <div class="text-xs text-slate-600 mt-1 font-medium">{{ __('safir.hero.stats.delegations_label') }}</div>
                            </div>

                            <!-- Stat 4 -->
                            <div class="bg-[#F8F9FA] p-4 rounded-xl border border-slate-200/80 hover:border-gold-400/50 hover:bg-gold-50/20 transition-all">
                                <div class="text-2xl font-extrabold text-gold-700 tracking-tight">{{ __('safir.hero.stats.hq') }}</div>
                                <div class="text-xs text-slate-600 mt-1 font-medium">{{ __('safir.hero.stats.hq_label') }}</div>
                            </div>
                        </div>

                        <!-- Mini Bulletin Banner inside Hero Card -->
                        <div class="mt-6 pt-5 border-t border-slate-200">
                            <div class="text-xs font-semibold text-slate-800 mb-1 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span>{{ $latestBulletin ? $latestBulletin->issue_number : __('safir.bulletin.weekly_intelligence') }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 line-clamp-2">
                                {{ $latestBulletin ? $latestBulletin->getLocalized('title') : __('safir.bulletin.default_desc') }}
                            </p>
                            <a href="{{ route_ml('bulletin') }}" class="inline-block mt-2 text-xs font-bold text-gold-700 hover:text-gold-800 underline">
                                {{ __('safir.nav.bulletin') }} →
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- OVERVIEW & TARGET AUDIENCES BREAKDOWN -->
    <!-- OVERVIEW & TARGET AUDIENCES BREAKDOWN -->
    <section class="py-20 bg-white border-b border-[#E8E4DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="inline-block text-xs uppercase tracking-widest text-gold-800 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                    {{ __('safir.overview.badge') }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight">
                    {{ __('safir.overview.title') }}
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ __('safir.overview.description') }}
                </p>
            </div>

            <!-- 4 Audience Pillars Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- 1. Embassies -->
                <div class="bg-white p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-500/50 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div class="w-12 h-12 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center mb-4 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-[#0A192F] mb-2">{{ __('safir.overview.audiences.embassies.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">
                        {{ __('safir.overview.audiences.embassies.desc') }}
                    </p>
                    <a href="{{ route_ml('embassies') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800 inline-flex items-center gap-1">
                        <span>{{ __('safir.nav.embassies') }}</span>
                        <span class="text-sm">→</span>
                    </a>
                </div>

                <!-- 2. Government Bodies -->
                <div class="bg-white p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-500/50 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div class="w-12 h-12 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center mb-4 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-[#0A192F] mb-2">{{ __('safir.overview.audiences.government.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">
                        {{ __('safir.overview.audiences.government.desc') }}
                    </p>
                    <a href="{{ route_ml('services.pillar', 'relations') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800 inline-flex items-center gap-1">
                        <span>{{ __('safir.pillars.relations.title') }}</span>
                        <span class="text-sm">→</span>
                    </a>
                </div>

                <!-- 3. Multinational Corporates -->
                <div class="bg-white p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-500/50 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div class="w-12 h-12 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center mb-4 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-[#0A192F] mb-2">{{ __('safir.overview.audiences.corporates.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">
                        {{ __('safir.overview.audiences.corporates.desc') }}
                    </p>
                    <a href="{{ route_ml('corporates') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800 inline-flex items-center gap-1">
                        <span>{{ __('safir.nav.corporates') }}</span>
                        <span class="text-sm">→</span>
                    </a>
                </div>

                <!-- 4. Strategic Investors -->
                <div class="bg-white p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-500/50 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div class="w-12 h-12 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center mb-4 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-[#0A192F] mb-2">{{ __('safir.overview.audiences.investors.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">
                        {{ __('safir.overview.audiences.investors.desc') }}
                    </p>
                    <a href="{{ route_ml('reports.index', ['category' => 'incentives']) }}" class="text-xs font-bold text-gold-700 hover:text-gold-800 inline-flex items-center gap-1">
                        <span>{{ __('safir.pillars.economy.items.incentive_mapping') }}</span>
                        <span class="text-sm">→</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- THE 4 MAIN PILLARS OF EXCELLENCE (Interactive Cards Grid) -->
    <section class="py-24 bg-[#F8F7F2] border-b border-[#E8E4DA] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                <div>
                    <span class="text-xs uppercase tracking-widest text-gold-700 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                        {{ __('safir.footer.services_title') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight mt-3">
                        {{ __('safir.home.advisory_architecture.title') }}
                    </h2>
                </div>
                <a href="{{ route_ml('services.index') }}" class="text-sm font-bold text-gold-700 hover:text-gold-800 inline-flex items-center gap-1.5 group">
                    <span>{{ __('safir.nav.services') }}</span>
                    <span class="group-hover:translate-x-1 {{ $isRtl ? 'group-hover:-translate-x-1' : '' }} transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Pillar 1: Economy & Knowledge -->
                <div class="bg-white p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-mono font-bold text-gold-700 px-2.5 py-1 rounded bg-gold-50 border border-gold-200">
                                {{ __('safir.home.advisory_architecture.pillar_badge', ['number' => '01']) }}
                            </span>
                            <div class="w-10 h-10 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-[#0A192F] mb-3 group-hover:text-gold-700 transition-colors">
                            {{ __('safir.pillars.economy.title') }}
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            {{ __('safir.pillars.economy.desc') }}
                        </p>
                        
                        <div class="space-y-2 border-t border-[#F0ECE1] pt-4">
                            @foreach(__('safir.pillars.economy.items') as $key => $label)
                                <div class="flex items-start gap-2 text-xs text-slate-600">
                                    <span class="text-gold-600 font-bold">✓</span>
                                    <span>{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-[#F0ECE1] flex items-center justify-between">
                        <a href="{{ route_ml('services.pillar', 'economy') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800">
                            {{ __('safir.nav.explore_services') }} →
                        </a>
                        <a href="{{ route_ml('reports.index') }}" class="text-xs text-slate-500 hover:text-slate-800">
                            {{ __('safir.nav.reports') }}
                        </a>
                    </div>
                </div>

                <!-- Pillar 2: Relations & Business -->
                <div class="bg-white p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-mono font-bold text-gold-700 px-2.5 py-1 rounded bg-gold-50 border border-gold-200">
                                {{ __('safir.home.advisory_architecture.pillar_badge', ['number' => '02']) }}
                            </span>
                            <div class="w-10 h-10 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-[#0A192F] mb-3 group-hover:text-gold-700 transition-colors">
                            {{ __('safir.pillars.relations.title') }}
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            {{ __('safir.pillars.relations.desc') }}
                        </p>
                        
                        <div class="space-y-2 border-t border-[#F0ECE1] pt-4">
                            @foreach(__('safir.pillars.relations.items') as $key => $label)
                                <div class="flex items-start gap-2 text-xs text-slate-600">
                                    <span class="text-gold-600 font-bold">✓</span>
                                    <span>{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-[#F0ECE1] flex items-center justify-between">
                        <a href="{{ route_ml('services.pillar', 'relations') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800">
                            {{ __('safir.nav.explore_services') }} →
                        </a>
                        <a href="{{ route_ml('embassies') }}" class="text-xs text-slate-500 hover:text-slate-800">
                            {{ __('safir.nav.embassies') }}
                        </a>
                    </div>
                </div>

                <!-- Pillar 3: Events & Support Services -->
                <div class="bg-white p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-mono font-bold text-gold-700 px-2.5 py-1 rounded bg-gold-50 border border-gold-200">
                                {{ __('safir.home.advisory_architecture.pillar_badge', ['number' => '03']) }}
                            </span>
                            <div class="w-10 h-10 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"/></svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-[#0A192F] mb-3 group-hover:text-gold-700 transition-colors">
                            {{ __('safir.pillars.events.title') }}
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            {{ __('safir.pillars.events.desc') }}
                        </p>
                        
                        <div class="space-y-2 border-t border-[#F0ECE1] pt-4">
                            @foreach(__('safir.pillars.events.items') as $key => $label)
                                <div class="flex items-start gap-2 text-xs text-slate-600">
                                    <span class="text-gold-600 font-bold">✓</span>
                                    <span>{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-[#F0ECE1] flex items-center justify-between">
                        <a href="{{ route_ml('services.pillar', 'events') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800">
                            {{ __('safir.nav.explore_services') }} →
                        </a>
                        <a href="{{ route_ml('contact') }}" class="text-xs text-slate-500 hover:text-slate-800">
                            {{ __('safir.home.pillars.consular_desk_link') }}
                        </a>
                    </div>
                </div>

                <!-- Pillar 4: Community & Media -->
                <div class="bg-white p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-mono font-bold text-gold-700 px-2.5 py-1 rounded bg-gold-50 border border-gold-200">
                                {{ __('safir.home.advisory_architecture.pillar_badge', ['number' => '04']) }}
                            </span>
                            <div class="w-10 h-10 rounded-lg bg-gold-50 text-gold-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-[#0A192F] mb-3 group-hover:text-gold-700 transition-colors">
                            {{ __('safir.pillars.community.title') }}
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            {{ __('safir.pillars.community.desc') }}
                        </p>
                        
                        <div class="space-y-2 border-t border-[#F0ECE1] pt-4">
                            @foreach(__('safir.pillars.community.items') as $key => $label)
                                <div class="flex items-start gap-2 text-xs text-slate-600">
                                    <span class="text-gold-600 font-bold">✓</span>
                                    <span>{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-[#F0ECE1] flex items-center justify-between">
                        <a href="{{ route_ml('services.pillar', 'community') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800">
                            {{ __('safir.nav.explore_services') }} →
                        </a>
                        <a href="{{ route_ml('contact') }}" class="text-xs text-slate-500 hover:text-slate-800">
                            {{ __('safir.home.pillars.press_desk_link') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- WHY TURKEY? SECTION (Strategic Crossroads, G20, Institutions, Ground Execution) -->
    <section class="py-24 bg-white border-b border-[#E8E4DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="inline-block text-xs uppercase tracking-widest text-gold-700 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                    {{ __('safir.why_turkey.badge') }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight">
                    {{ __('safir.why_turkey.title') }}
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ __('safir.why_turkey.subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- 1. Strategic Crossroads -->
                <div class="bg-[#FAF9F5] p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-4 font-mono font-bold text-gold-700">01.</div>
                        <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.why_turkey.pillars.crossroads.title') }}</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            {{ __('safir.why_turkey.pillars.crossroads.desc') }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#E8E4DA] text-[11px] text-gold-700 font-mono">
                        {{ __('safir.why_turkey.pillars.crossroads.tag') }}
                    </div>
                </div>

                <!-- 2. Dynamic G20 Economy -->
                <div class="bg-[#FAF9F5] p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-4 font-mono font-bold text-gold-700">02.</div>
                        <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.why_turkey.pillars.economy.title') }}</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            {{ __('safir.why_turkey.pillars.economy.desc') }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#E8E4DA] text-[11px] text-gold-700 font-mono">
                        {{ __('safir.why_turkey.pillars.economy.tag') }}
                    </div>
                </div>

                <!-- 3. Institutional Depth -->
                <div class="bg-[#FAF9F5] p-6 rounded-xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-4 font-mono font-bold text-gold-700">03.</div>
                        <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.why_turkey.pillars.institutions.title') }}</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            {{ __('safir.why_turkey.pillars.institutions.desc') }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#E8E4DA] text-[11px] text-gold-700 font-mono">
                        {{ __('safir.why_turkey.pillars.institutions.tag') }}
                    </div>
                </div>

                <!-- 4. Ground Execution Imperative -->
                <div class="bg-gradient-to-b from-[#F5F2EB] to-[#EAE5D9] p-6 rounded-xl border border-gold-300 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-4 font-mono font-bold text-gold-800">04.</div>
                        <h3 class="text-lg font-bold text-navy-950 mb-2">{{ __('safir.why_turkey.pillars.execution.title') }}</h3>
                        <p class="text-slate-700 text-xs leading-relaxed">
                            {{ __('safir.why_turkey.pillars.execution.desc') }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gold-300/60 text-[11px] text-gold-800 font-bold">
                        {{ __('safir.why_turkey.pillars.execution.tag') }}
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FEATURED RESEARCH & REPORTS SHOWCASE -->
    <section class="py-24 bg-[#F8F7F2] border-b border-[#E8E4DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                <div>
                    <span class="text-xs uppercase tracking-widest text-gold-700 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                        {{ __('safir.reports.badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight mt-3">
                        {{ __('safir.reports.title') }}
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1">
                        {{ __('safir.reports.subtitle') }}
                    </p>
                </div>
                <a href="{{ route_ml('reports.index') }}" class="text-sm font-bold text-gold-700 hover:text-gold-800 inline-flex items-center gap-1.5 group">
                    <span>{{ __('safir.reports.view_all') }}</span>
                    <span class="group-hover:translate-x-1 {{ $isRtl ? 'group-hover:-translate-x-1' : '' }} transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredReports as $report)
                    <div class="bg-white p-6 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="text-[11px] font-semibold text-gold-700 bg-gold-50 border border-gold-200 px-2.5 py-0.5 rounded-full">
                                    {{ $report->category_name }}
                                </span>
                                <span class="text-[11px] text-slate-500 font-mono">
                                    {{ $report->read_time }}
                                </span>
                            </div>

                            <h3 class="text-base font-bold text-[#0A192F] group-hover:text-gold-700 transition-colors line-clamp-2 mb-3">
                                <a href="{{ route_ml('reports.show', $report->slug) }}">
                                    {{ $report->getLocalized('title') }}
                                </a>
                            </h3>

                            <p class="text-slate-600 text-xs leading-relaxed line-clamp-3 mb-4">
                                {{ $report->getLocalized('summary') }}
                            </p>

                            @if($report->tags)
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    @foreach(array_slice($report->tags, 0, 3) as $tag)
                                        <span class="text-[10px] text-slate-600 bg-slate-100 px-2 py-0.5 rounded">#{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-[#F0ECE1] flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-mono">{{ $report->published_date->format('d M Y') }}</span>
                            <a href="{{ route_ml('reports.show', $report->slug) }}" class="font-bold text-gold-700 hover:text-gold-800">
                                {{ __('safir.reports.read_report') }} →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- WEEKLY NEWSLETTER / BULLETIN SIGNUP BANNER -->
    <section class="py-20 bg-[#FAF9F5] border-b border-[#E8E4DA]">
        <div class="max-w-5xl mx-auto px-4 sm:px-8">
            <div class="bg-white p-8 sm:p-12 rounded-3xl border border-[#E2DDD3] relative shadow-lg">
                <div class="text-center max-w-2xl mx-auto space-y-3 mb-8">
                    <span class="inline-block text-xs uppercase tracking-widest text-gold-700 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                        {{ __('safir.bulletin.badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight">
                        {{ __('safir.bulletin.title') }}
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ __('safir.bulletin.subtitle') }}
                    </p>
                </div>

                <!-- Clean Inline Subscription Form with AJAX -->
                <form action="{{ route('subscribers.store') }}" method="POST" class="newsletter-ajax-form max-w-2xl mx-auto space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <input type="text" name="full_name" placeholder="{{ __('safir.bulletin.name_placeholder') }}" 
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF9F6] border border-[#D5CFBE] focus:border-gold-600 text-slate-900 text-xs placeholder:text-slate-400 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <input type="text" name="organization" placeholder="{{ __('safir.bulletin.org_placeholder') }}" 
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF9F6] border border-[#D5CFBE] focus:border-gold-600 text-slate-900 text-xs placeholder:text-slate-400 focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="email" name="email" required placeholder="{{ __('safir.bulletin.input_placeholder') }}" 
                               class="flex-grow px-4 py-3.5 rounded-xl bg-[#FAF9F6] border border-[#D5CFBE] focus:border-gold-600 text-slate-900 text-xs sm:text-sm placeholder:text-slate-400 focus:outline-none transition-colors">
                        
                        <button type="submit" class="px-6 py-3.5 rounded-xl font-bold text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 hover:from-gold-300 hover:to-gold-400 shrink-0 shadow-md text-xs sm:text-sm transition-all hover:scale-102">
                            {{ __('safir.bulletin.submit_btn') }}
                        </button>
                    </div>

                    <p class="text-[11px] text-slate-500 text-center">
                        🔒 {{ __('safir.bulletin.disclaimer') }}
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- ANKARA DIPLOMATIC CORRIDOR LOCATION HIGHLIGHT -->
    <section class="py-20 bg-white border-b border-[#E8E4DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-6 space-y-4">
                    <span class="inline-block text-xs uppercase tracking-widest text-gold-700 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                        {{ __('safir.contact.badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight">
                        {{ __('safir.home.location.title') }}
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.contact.subtitle') }}
                    </p>
                    
                    <div class="space-y-3 pt-3">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded bg-gold-50 text-gold-700 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-[#0A192F]">{{ __('safir.contact.hq_title') }}</div>
                                <div class="text-xs text-slate-600">{{ __('safir.contact.address') }}</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded bg-gold-50 text-gold-700 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-[#0A192F]">{{ __('safir.home.location.consultation_hours_title') }}</div>
                                <div class="text-xs text-slate-600">{{ __('safir.contact.hours') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route_ml('contact') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gold-700 hover:text-gold-800 underline">
                            <span>{{ __('safir.home.location.contact_desks_link') }}</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

                <!-- Visual Interactive Location Map / Card -->
                <div class="lg:col-span-6">
                    <div class="bg-[#FAF9F5] p-6 rounded-2xl border border-[#E8E4DA] space-y-4">
                        <div class="text-xs font-bold text-[#0A192F] uppercase tracking-wider border-b border-[#E8E4DA] pb-2 flex items-center justify-between">
                            <span>{{ __('safir.home.location.card.header') }}</span>
                            <span class="text-gold-700 font-mono text-[11px]">{{ __('safir.home.location.card.district') }}</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div class="bg-white p-3 rounded-lg border border-[#E8E4DA] shadow-sm">
                                <div class="text-gold-700 font-bold">{{ __('safir.home.location.card.distances.sovereign_ministries.time') }}</div>
                                <div class="text-slate-600 text-[11px]">{{ __('safir.home.location.card.distances.sovereign_ministries.label') }}</div>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-[#E8E4DA] shadow-sm">
                                <div class="text-gold-700 font-bold">{{ __('safir.home.location.card.distances.tobb.time') }}</div>
                                <div class="text-slate-600 text-[11px]">{{ __('safir.home.location.card.distances.tobb.label') }}</div>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-[#E8E4DA] shadow-sm">
                                <div class="text-gold-700 font-bold">{{ __('safir.home.location.card.distances.chamber_of_commerce.time') }}</div>
                                <div class="text-slate-600 text-[11px]">{{ __('safir.home.location.card.distances.chamber_of_commerce.label') }}</div>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-[#E8E4DA] shadow-sm">
                                <div class="text-gold-700 font-bold">{{ __('safir.home.location.card.distances.airport.time') }}</div>
                                <div class="text-slate-600 text-[11px]">{{ __('safir.home.location.card.distances.airport.label') }}</div>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-white border border-gold-200 text-xs text-slate-600 leading-relaxed shadow-sm">
                            <span class="text-gold-700 font-bold">{{ __('safir.home.location.card.notice_label') }}</span> {{ __('safir.contact.notice') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
