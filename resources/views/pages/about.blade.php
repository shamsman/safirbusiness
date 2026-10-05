@extends('layouts.app')

@section('title', __('safir.nav.about') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.philosophy'))

@section('content')

    <!-- Header -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-navy-950 via-navy-900 to-navy-900 border-b border-gold-500/20 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/10 border border-gold-500/30 text-gold-400 text-xs font-semibold uppercase tracking-wider">
                {{ __('safir.nav.about') }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-50 tracking-tight">
                An Integrated Advisory Ecosystem in Ankara
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
                {{ __('safir.short_bio') }}
            </p>
        </div>
    </section>

    <!-- Core Philosophy Statement -->
    <section class="py-20 bg-navy-900 border-b border-gold-500/15">
        <div class="max-w-5xl mx-auto px-4 sm:px-8">
            <div class="glass-panel p-8 sm:p-12 rounded-3xl border-gold-500/30 text-center space-y-6">
                <span class="text-xs uppercase tracking-widest text-gold-400 font-bold px-3 py-1 rounded bg-gold-500/10 border border-gold-500/20">
                    OUR CORE PHILOSOPHY
                </span>
                <blockquote class="text-xl sm:text-2xl font-bold text-slate-100 leading-snug max-w-3xl mx-auto">
                    « {{ __('safir.philosophy') }} »
                </blockquote>
                <div class="text-sm font-bold text-gold-400 italic">
                    « {{ __('safir.brand_signature') }} »
                </div>
            </div>
        </div>
    </section>

    <!-- Strategic Advantage Points -->
    <section class="py-20 bg-navy-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="glass-panel p-6 rounded-2xl border-gold-500/20">
                    <div class="text-gold-400 text-2xl font-bold font-mono mb-3">01.</div>
                    <h3 class="text-lg font-bold text-slate-100 mb-2">The Ankara Proximity</h3>
                    <p class="text-slate-300 text-xs leading-relaxed">
                        While Istanbul is the commercial trade capital, Ankara is where policy, sovereign incentives, regulatory laws, and diplomatic agreements are decided. We provide permanent ground access.
                    </p>
                </div>

                <div class="glass-panel p-6 rounded-2xl border-gold-500/20">
                    <div class="text-gold-400 text-2xl font-bold font-mono mb-3">02.</div>
                    <h3 class="text-lg font-bold text-slate-100 mb-2">Protocol Precision</h3>
                    <p class="text-slate-300 text-xs leading-relaxed">
                        Our team understands the delicate diplomatic protocols and institutional sequencing necessary to engage sovereign bodies, apex associations, and ministries without friction.
                    </p>
                </div>

                <div class="glass-panel p-6 rounded-2xl border-gold-500/20">
                    <div class="text-gold-400 text-2xl font-bold font-mono mb-3">03.</div>
                    <h3 class="text-lg font-bold text-slate-100 mb-2">Trilingual Execution</h3>
                    <p class="text-slate-300 text-xs leading-relaxed">
                        Operating fluently in Arabic, English, and Turkish across all legal, economic, and institutional documents, bridging international partners and Turkish stakeholders natively.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
