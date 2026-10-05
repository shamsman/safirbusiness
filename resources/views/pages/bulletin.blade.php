@extends('layouts.app')

@section('title', __('safir.bulletin.title') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.bulletin.subtitle'))

@section('content')

    <!-- Header & Inline Subscription -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-white via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E8E4DA] relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-gold-700 text-xs font-semibold uppercase tracking-wider">
                {{ __('safir.bulletin.badge') }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0A192F] tracking-tight leading-tight">
                {{ __('safir.bulletin.title') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                {{ __('safir.bulletin.subtitle') }}
            </p>

            <!-- Inline Form -->
            <div class="pt-6">
                <form action="{{ route('subscribers.store') }}" method="POST" class="newsletter-ajax-form max-w-xl mx-auto space-y-3">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="email" name="email" required placeholder="{{ __('safir.bulletin.input_placeholder') }}" 
                               class="flex-grow px-4 py-3.5 rounded-xl bg-[#FAF9F6] border border-[#D5CFBE] focus:border-gold-600 text-slate-900 text-xs sm:text-sm placeholder:text-slate-400 focus:outline-none transition-colors">
                        <button type="submit" class="px-6 py-3.5 rounded-xl font-bold text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 hover:from-gold-300 hover:to-gold-400 shrink-0 text-xs sm:text-sm shadow-md">
                            {{ __('safir.bulletin.submit_btn') }}
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">
                        🔒 {{ __('safir.bulletin.disclaimer') }}
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- Bulletin Archive List -->
    <section class="py-20 bg-[#F8F7F2]">
        <div class="max-w-4xl mx-auto px-4 sm:px-8">
            <h2 class="text-xl font-bold text-[#0A192F] mb-8 border-b border-[#E8E4DA] pb-4">
                Recent Intelligence Bulletins
            </h2>

            <div class="space-y-6">
                @foreach($bulletins as $bulletin)
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all">
                        <div class="flex items-center justify-between gap-4 mb-3">
                            <span class="text-xs font-mono font-bold text-gold-700 px-2.5 py-1 rounded bg-gold-50 border border-gold-200">
                                {{ $bulletin->issue_number }}
                            </span>
                            <span class="text-xs text-slate-500 font-mono">
                                {{ $bulletin->published_date->format('d F Y') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-[#0A192F] mb-2">
                            {{ $bulletin->getLocalized('title') }}
                        </h3>

                        <p class="text-slate-600 text-xs leading-relaxed mb-4">
                            {{ $bulletin->getLocalized('summary') }}
                        </p>

                        @if($bulletin->highlights)
                            @php
                                $localeHighlights = $bulletin->highlights[$currentLocale] ?? ($bulletin->highlights['en'] ?? []);
                            @endphp
                            @if(!empty($localeHighlights))
                                <div class="bg-[#FAF9F5] p-4 rounded-xl border border-[#E8E4DA] space-y-2 mb-4">
                                    <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider">Executive Highlights:</div>
                                    @foreach($localeHighlights as $hl)
                                        <div class="flex items-start gap-2 text-xs text-slate-700">
                                            <span class="text-gold-600 font-bold">•</span>
                                            <span>{{ $hl }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $bulletins->links() }}
            </div>
        </div>
    </section>

@endsection
