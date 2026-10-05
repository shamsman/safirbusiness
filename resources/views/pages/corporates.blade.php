@extends('layouts.app')

@section('title', __('safir.corporates_page.title') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.corporates_page.subtitle'))

@section('content')

    <!-- Hero Header -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-white via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E8E4DA] relative">
        <div class="absolute inset-0 bg-embassy-pattern opacity-40"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-gold-700 text-xs font-semibold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                    {{ __('safir.corporates_page.badge') }}
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0A192F] tracking-tight leading-tight">
                    {{ __('safir.corporates_page.title') }}
                </h1>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    {{ __('safir.corporates_page.subtitle') }}
                </p>
                <div class="pt-2 text-sm text-slate-500 leading-relaxed border-t border-gold-200">
                    {{ __('safir.corporates_page.lead') }}
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Corporate Entry Pillars -->
    <section class="py-20 bg-white border-b border-[#E8E4DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                
                <!-- 1. Market Entry Roadmap -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.corporates_page.pillars.roadmap.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.corporates_page.pillars.roadmap.desc') }}
                    </p>
                </div>

                <!-- 2. B2B Matchmaking -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.corporates_page.pillars.matchmaking.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.corporates_page.pillars.matchmaking.desc') }}
                    </p>
                </div>

                <!-- 3. Regulatory Navigation -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.corporates_page.pillars.regulatory.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.corporates_page.pillars.regulatory.desc') }}
                    </p>
                </div>

                <!-- 4. Escorted Site Tours -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.corporates_page.pillars.site_tours.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.corporates_page.pillars.site_tours.desc') }}
                    </p>
                </div>

            </div>

            <!-- Scoping Call Action Box -->
            <div class="bg-gradient-to-r from-[#FAF9F5] to-[#F5F2EB] p-8 rounded-2xl border border-gold-300 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-1">{{ __('safir.corporates_page.cta_box_title') }}</h3>
                    <p class="text-slate-600 text-xs sm:text-sm">{{ __('safir.corporates_page.cta_box_desc') }}</p>
                </div>
                <a href="{{ route_ml('contact') }}" class="px-7 py-3.5 rounded-xl font-bold text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 hover:from-gold-300 hover:to-gold-400 shrink-0 text-sm shadow-md">
                    {{ __('safir.corporates_page.cta_box_btn') }}
                </a>
            </div>

        </div>
    </section>

@endsection
