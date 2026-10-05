@extends('layouts.app')

@section('title', __('safir.contact.title') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.contact.subtitle'))
@section('hide_cta', true)

@section('content')

    <!-- Header Section -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-navy-950 via-navy-900 to-navy-900 border-b border-gold-500/20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/10 border border-gold-500/30 text-gold-400 text-xs font-semibold uppercase tracking-wider">
                    {{ __('safir.contact.badge') }}
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-50 tracking-tight leading-tight">
                    {{ __('safir.contact.title') }}
                </h1>
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                    {{ __('safir.contact.subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Contact & Form Section -->
    <section class="py-20 bg-navy-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left: Comprehensive Inquiry Form (7 Cols) -->
                <div class="lg:col-span-7">
                    <div class="glass-panel p-8 sm:p-10 rounded-3xl border-gold-500/30 shadow-2xl">
                        <h2 class="text-xl font-bold text-slate-50 mb-2">
                            {{ __('safir.contact.form.title') }}
                        </h2>
                        <p class="text-slate-400 text-xs mb-8">
                            All requests are handled under strict diplomatic non-disclosure standards.
                        </p>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mb-6 p-4 rounded-xl bg-red-500/15 border border-red-500/40 text-red-300 text-xs">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-5">
                            @csrf
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                        {{ __('safir.contact.form.name') }} *
                                    </label>
                                    <input type="text" name="name" required value="{{ old('name') }}"
                                           class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                        {{ __('safir.contact.form.org') }} *
                                    </label>
                                    <input type="text" name="organization" required value="{{ old('organization') }}"
                                           class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                        {{ __('safir.contact.form.country') }} *
                                    </label>
                                    <input type="text" name="country" required value="{{ old('country') }}" placeholder="e.g. United Arab Emirates, Saudi Arabia, Qatar, UK..."
                                           class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                        {{ __('safir.contact.form.email') }} *
                                    </label>
                                    <input type="email" name="email" required value="{{ old('email') }}"
                                           class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                        {{ __('safir.contact.form.phone') }}
                                    </label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+90 5XX XXX XX XX"
                                           class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                        {{ __('safir.contact.form.service_type') }} *
                                    </label>
                                    <select name="service_type" required 
                                            class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">
                                        <option value="embassy">Embassies & Consular Support</option>
                                        <option value="corporate">Corporate Market Entry & Roadmap</option>
                                        <option value="b2b">B2B Matchmaking & Delegations</option>
                                        <option value="reports">Economic Reports & Market Studies</option>
                                        <option value="events">Conferences, Media & Protocol</option>
                                        <option value="general">General Advisory Scoping</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                                    {{ __('safir.contact.form.details') }} *
                                </label>
                                <textarea name="details" rows="5" required placeholder="{{ __('safir.contact.form.details_placeholder') }}"
                                          class="w-full px-4 py-3 rounded-xl bg-navy-950 border border-gold-500/25 focus:border-gold-500 text-slate-100 text-xs focus:outline-none transition-colors">{{ old('details') }}</textarea>
                            </div>

                            <button type="submit" class="w-full py-4 rounded-xl font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-400 hover:from-gold-300 hover:to-gold-400 shadow-xl shadow-gold-500/20 text-sm transition-all hover:scale-101">
                                {{ __('safir.contact.form.submit') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right: Ankara Headquarters & Desks Directory (5 Cols) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- HQ Address Card -->
                    <div class="glass-panel p-6 rounded-2xl border-gold-500/25 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gold-500/15 text-gold-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-100">{{ __('safir.contact.hq_title') }}</h3>
                                <span class="text-xs text-gold-400">Çankaya / Söğütözü Diplomatic Zone</span>
                            </div>
                        </div>

                        <p class="text-xs text-slate-300 leading-relaxed">
                            {{ __('safir.contact.address') }}
                        </p>
                        <p class="text-[11px] text-slate-400">
                            {{ __('safir.contact.address_note') }}
                        </p>

                        <div class="p-3.5 rounded-xl bg-navy-950/80 border border-gold-500/20 text-xs text-slate-300 space-y-1">
                            <div class="font-bold text-gold-400">Hours of Operation:</div>
                            <div>{{ __('safir.contact.hours') }}</div>
                        </div>
                    </div>

                    <!-- Desks Directory -->
                    <div class="glass-panel p-6 rounded-2xl border-gold-500/25 space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gold-400 border-b border-white/10 pb-2">
                            Dedicated Executive Desks
                        </h4>

                        <div class="space-y-3 text-xs">
                            <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                <span class="text-slate-300">{{ __('safir.contact.desks.main') }}</span>
                                <span class="font-mono text-slate-100">+90 312 000 00 00</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                <span class="text-slate-300">{{ __('safir.contact.desks.embassies') }}</span>
                                <span class="font-mono text-gold-400">+90 312 000 00 01</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                <span class="text-slate-300">{{ __('safir.contact.desks.investors') }}</span>
                                <span class="font-mono text-gold-400">+90 312 000 00 02</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-300">{{ __('safir.contact.desks.media') }}</span>
                                <span class="font-mono text-slate-300">press@safirbusinesshub.com</span>
                            </div>
                        </div>
                    </div>

                    <!-- Building Access Notice -->
                    <div class="p-4 rounded-xl bg-navy-900 border border-white/10 text-xs text-slate-400 leading-relaxed">
                        <span class="text-gold-400 font-bold">Protocol Notice:</span> {{ __('safir.contact.notice') }}
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
