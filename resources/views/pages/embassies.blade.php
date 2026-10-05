@extends('layouts.app')

@section('title', __('safir.embassies_page.title') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.embassies_page.subtitle'))

@section('content')

    <!-- Hero Header -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-white via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E8E4DA] relative">
        <div class="absolute inset-0 bg-embassy-pattern opacity-40"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-gold-700 text-xs font-semibold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                    {{ __('safir.embassies_page.badge') }}
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0A192F] tracking-tight leading-tight">
                    {{ __('safir.embassies_page.title') }}
                </h1>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    {{ __('safir.embassies_page.subtitle') }}
                </p>
                <div class="pt-2 text-sm text-slate-500 leading-relaxed border-t border-gold-200">
                    {{ __('safir.embassies_page.lead') }}
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Diplomatic Desks & Workflows -->
    <section class="py-20 bg-white border-b border-[#E8E4DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                
                <!-- 1. Institutional Liaison -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.embassies_page.services.liaison.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.embassies_page.services.liaison.desc') }}
                    </p>
                </div>

                <!-- 2. Official Delegations -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.embassies_page.services.delegations.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.embassies_page.services.delegations.desc') }}
                    </p>
                </div>

                <!-- 3. Consular & Legalizations -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.embassies_page.services.consular.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.embassies_page.services.consular.desc') }}
                    </p>
                </div>

                <!-- 4. Bilateral Protocols -->
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-3">{{ __('safir.embassies_page.services.protocols.title') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ __('safir.embassies_page.services.protocols.desc') }}
                    </p>
                </div>

            </div>

            <!-- Protocol Workflow Timeline -->
            <div class="bg-[#FAF9F5] p-8 sm:p-12 rounded-3xl border border-[#E2DDD3] shadow-sm">
                <div class="text-center max-w-xl mx-auto mb-12">
                    <h3 class="text-2xl font-bold text-[#0A192F] mb-2">{{ __('safir.embassies_page.workflow_title') }}</h3>
                    <p class="text-slate-500 text-xs">{{ __('safir.embassies_page.workflow_subtitle') }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach(__('safir.embassies_page.workflow_steps') as $stepKey => $step)
                        <div class="p-5 rounded-xl bg-white border border-[#E8E4DA] shadow-sm space-y-2">
                            <div class="text-gold-700 font-bold text-sm">{{ $step['title'] }}</div>
                            <p class="text-slate-600 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Embassy Priority Action Box -->
            <div class="mt-16 bg-gradient-to-r from-[#FAF9F5] to-[#F5F2EB] p-8 rounded-2xl border border-gold-300 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-bold text-[#0A192F] mb-1">{{ __('safir.embassies_page.cta_box_title') }}</h3>
                    <p class="text-slate-600 text-xs sm:text-sm">{{ __('safir.embassies_page.cta_box_desc') }}</p>
                </div>
                <a href="{{ route_ml('contact') }}" class="px-7 py-3.5 rounded-xl font-bold text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 hover:from-gold-300 hover:to-gold-400 shrink-0 text-sm shadow-md">
                    {{ __('safir.embassies_page.cta_box_btn') }}
                </a>
            </div>

        </div>
    </section>

@endsection
