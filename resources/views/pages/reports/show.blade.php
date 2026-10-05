@extends('layouts.app')

@section('title', $report->getLocalized('title') . ' — ' . __('safir.brand_name'))
@section('meta_description', Str::limit(strip_tags($report->getLocalized('summary')), 160))

@section('content')

    <!-- Report Header -->
    <article class="py-16 md:py-20 bg-gradient-to-b from-white via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E8E4DA] relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-8">
            
            <div class="space-y-4">
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="text-xs font-semibold text-gold-700 bg-gold-50 border border-gold-200 px-3 py-1 rounded-full">
                        {{ $report->category_name }}
                    </span>
                    <span class="text-xs text-slate-500 font-mono">
                        {{ $report->published_date->format('d F Y') }}
                    </span>
                    <span class="text-slate-300">·</span>
                    <span class="text-xs text-slate-500 font-mono">
                        {{ $report->read_time }}
                    </span>
                    <span class="text-slate-300">·</span>
                    <span class="text-xs text-slate-500 font-mono flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>{{ $report->downloads_count }} Downloads</span>
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0A192F] tracking-tight leading-tight">
                    {{ $report->getLocalized('title') }}
                </h1>

                <!-- Executive Summary Quote Box -->
                <div class="bg-white p-6 rounded-xl border-l-4 border-l-gold-500 border border-[#E8E4DA] shadow-sm my-6">
                    <div class="text-xs font-bold text-gold-700 uppercase tracking-wider mb-2">Executive Summary</div>
                    <p class="text-slate-700 text-sm sm:text-base leading-relaxed">
                        {{ $report->getLocalized('summary') }}
                    </p>
                </div>

                <!-- Action Bar -->
                <div class="flex items-center gap-4 pt-2">
                    <a href="{{ route_ml('reports.download', $report->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-bold text-xs sm:text-sm text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 hover:from-gold-300 hover:to-gold-400 shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>{{ __('safir.reports.download_pdf') }}</span>
                    </a>
                    <a href="{{ route_ml('contact') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-xs sm:text-sm text-slate-800 bg-white border border-slate-300 hover:border-gold-500 shadow-sm">
                        <span>Request Specific Scoping</span>
                    </a>
                </div>
            </div>

        </div>
    </article>

    <!-- Report Content & Analysis Body -->
    <section class="py-16 bg-white min-h-[400px]">
        <div class="max-w-4xl mx-auto px-4 sm:px-8">
            
            <div class="prose max-w-none space-y-6 text-slate-700 leading-relaxed text-sm sm:text-base">
                {!! $report->getLocalized('content') !!}
            </div>

            <!-- Tags -->
            @if($report->tags)
                <div class="mt-12 pt-6 border-t border-[#E8E4DA]">
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Intelligence Keywords:</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($report->tags as $tag)
                            <a href="{{ route_ml('reports.index', ['q' => $tag]) }}" class="text-xs text-gold-700 bg-gold-50 border border-gold-200 px-3 py-1 rounded-full hover:bg-gold-100 transition-colors">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Related Intelligence Briefings -->
    @if($relatedReports->count() > 0)
        <section class="py-16 bg-[#FAF9F5] border-t border-[#E8E4DA]">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <h3 class="text-xl font-bold text-[#0A192F] mb-8">{{ __('safir.reports.related_reports') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedReports as $rel)
                        <div class="bg-white p-5 rounded-xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm transition-all flex flex-col justify-between">
                            <div>
                                <div class="text-[11px] text-gold-700 font-semibold mb-2">{{ $rel->category_name }}</div>
                                <h4 class="text-sm font-bold text-[#0A192F] line-clamp-2 mb-2">
                                    <a href="{{ route_ml('reports.show', $rel->slug) }}" class="hover:text-gold-700">
                                        {{ $rel->getLocalized('title') }}
                                    </a>
                                </h4>
                            </div>
                            <div class="pt-3 border-t border-[#F0ECE1] flex items-center justify-between text-[11px] text-slate-500 font-mono mt-4">
                                <span>{{ $rel->published_date->format('d M Y') }}</span>
                                <a href="{{ route_ml('reports.show', $rel->slug) }}" class="text-gold-700 font-bold hover:underline">
                                    Read →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
