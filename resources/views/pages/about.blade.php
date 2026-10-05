@extends('layouts.app')

@section('title', __('safir.nav.about') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.philosophy'))

@section('content')

    <!-- Header -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-white via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E8E4DA] relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-gold-700 text-xs font-semibold uppercase tracking-wider">
                {{ __('safir.nav.about') }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0A192F] tracking-tight">
                {{ __('safir.about_page.title') }}
            </h1>
            <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
                {{ __('safir.short_bio') }}
            </p>
        </div>
    </section>

    <!-- Core Philosophy Statement -->
    <section class="py-20 bg-white border-b border-[#E8E4DA]">
        <div class="max-w-5xl mx-auto px-4 sm:px-8">
            <div class="bg-[#FAF9F5] p-8 sm:p-12 rounded-3xl border border-[#E2DDD3] shadow-sm text-center space-y-6">
                <span class="text-xs uppercase tracking-widest text-gold-700 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                    {{ __('safir.about_page.core_philosophy_badge') }}
                </span>
                <blockquote class="text-xl sm:text-2xl font-bold text-[#0A192F] leading-snug max-w-3xl mx-auto">
                    « {{ __('safir.philosophy') }} »
                </blockquote>
                <div class="text-sm font-bold text-gold-700 italic">
                    « {{ __('safir.brand_signature') }} »
                </div>
            </div>
        </div>
    </section>

    <!-- Strategic Advantage Points -->
    <section class="py-20 bg-[#F8F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white p-6 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all">
                    <div class="text-gold-700 text-2xl font-bold font-mono mb-3">01.</div>
                    <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.about_page.advantages.1.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('safir.about_page.advantages.1.desc') }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all">
                    <div class="text-gold-700 text-2xl font-bold font-mono mb-3">02.</div>
                    <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.about_page.advantages.2.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('safir.about_page.advantages.2.desc') }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all">
                    <div class="text-gold-700 text-2xl font-bold font-mono mb-3">03.</div>
                    <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.about_page.advantages.3.title') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('safir.about_page.advantages.3.desc') }}
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
