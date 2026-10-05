@extends('layouts.app')

@section('title', __('safir.reports.title') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.reports.subtitle'))

@section('content')

    <!-- Header Section -->
    <section class="py-16 bg-gradient-to-b from-navy-950 via-navy-900 to-navy-900 border-b border-gold-500/20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/10 border border-gold-500/30 text-gold-400 text-xs font-semibold uppercase tracking-wider">
                    {{ __('safir.reports.badge') }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-50 tracking-tight">
                    {{ __('safir.reports.title') }}
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ __('safir.reports.subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Filter & Search Controls -->
    <section class="py-8 bg-navy-900/80 border-b border-gold-500/15 sticky top-20 z-40 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <form action="{{ route_ml('reports.index') }}" method="GET" class="flex flex-col lg:flex-row items-center justify-between gap-4">
                
                <!-- Category Filter Pills -->
                <div class="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 scrollbar-none">
                    <a href="{{ route_ml('reports.index', ['q' => $search]) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold shrink-0 transition-colors {{ empty($category) || $category === 'all' ? 'bg-gold-500 text-navy-950 shadow-md shadow-gold-500/20' : 'bg-navy-800 text-slate-300 hover:text-gold-400 border border-white/5' }}">
                        {{ __('safir.reports.all_categories') }}
                    </a>
                    @foreach($categories as $catKey => $catLabels)
                        <a href="{{ route_ml('reports.index', ['category' => $catKey, 'q' => $search]) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold shrink-0 transition-colors {{ $category === $catKey ? 'bg-gold-500 text-navy-950 shadow-md shadow-gold-500/20' : 'bg-navy-800 text-slate-300 hover:text-gold-400 border border-white/5' }}">
                            {{ $catLabels[$currentLocale] ?? $catLabels['en'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Keyword Search Box -->
                <div class="relative w-full lg:w-72 shrink-0">
                    @if($category)
                        <input type="hidden" name="category" value="{{ $category }}">
                    @endif
                    <input type="text" name="q" value="{{ $search }}" placeholder="{{ __('safir.reports.search_placeholder') }}" 
                           class="w-full px-4 py-2.5 rounded-xl bg-navy-950/80 border border-gold-500/20 focus:border-gold-500 text-slate-100 text-xs placeholder:text-slate-500 focus:outline-none transition-colors">
                    <button type="submit" class="absolute {{ $isRtl ? 'left-3' : 'right-3' }} top-2.5 text-slate-400 hover:text-gold-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>

            </form>
        </div>
    </section>

    <!-- Reports Grid Section -->
    <section class="py-16 bg-navy-950 min-h-[500px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            @if($reports->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($reports as $report)
                        <div class="glass-panel p-6 rounded-2xl border-gold-500/20 hover:border-gold-500/50 transition-all flex flex-col justify-between group">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="text-[11px] font-semibold text-gold-400 bg-gold-500/10 border border-gold-500/20 px-2.5 py-0.5 rounded-full">
                                        {{ $report->category_name }}
                                    </span>
                                    <span class="text-[11px] text-slate-400 font-mono">
                                        {{ $report->read_time }}
                                    </span>
                                </div>

                                <h2 class="text-base font-bold text-slate-100 group-hover:text-gold-400 transition-colors line-clamp-2 mb-3">
                                    <a href="{{ route_ml('reports.show', $report->slug) }}">
                                        {{ $report->getLocalized('title') }}
                                    </a>
                                </h2>

                                <p class="text-slate-300 text-xs leading-relaxed line-clamp-3 mb-4">
                                    {{ $report->getLocalized('summary') }}
                                </p>

                                @if($report->tags)
                                    <div class="flex flex-wrap gap-1.5 mb-4">
                                        @foreach(array_slice($report->tags, 0, 3) as $tag)
                                            <span class="text-[10px] text-slate-400 bg-navy-800 px-2 py-0.5 rounded">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs">
                                <span class="text-slate-400 font-mono">{{ $report->published_date->format('d M Y') }}</span>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route_ml('reports.download', $report->slug) }}" class="text-slate-400 hover:text-gold-400 text-[11px] font-mono flex items-center gap-1" title="Download Briefing">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>{{ $report->downloads_count }}</span>
                                    </a>
                                    <a href="{{ route_ml('reports.show', $report->slug) }}" class="font-bold text-gold-400 hover:text-gold-300">
                                        {{ __('safir.reports.read_report') }} →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $reports->links() }}
                </div>
            @else
                <div class="text-center py-20 glass-panel p-10 rounded-2xl max-w-lg mx-auto">
                    <svg class="w-12 h-12 text-gold-500/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="text-lg font-bold text-slate-200 mb-2">No Reports Found</h3>
                    <p class="text-xs text-slate-400 mb-6">{{ __('safir.reports.no_results') }}</p>
                    <a href="{{ route_ml('reports.index') }}" class="px-5 py-2 rounded-lg bg-gold-500 text-navy-950 font-bold text-xs">
                        Reset Filters
                    </a>
                </div>
            @endif

        </div>
    </section>

@endsection
