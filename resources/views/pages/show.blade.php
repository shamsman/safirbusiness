@extends('layouts.app')

@section('title', $page->meta_title_text ?: ($page->title_text . ' — ' . __('safir.brand_name')))
@section('meta_description', $page->meta_description_text ?: $page->summary_text)

@section('content')

    <!-- Header Section -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-[#0A192F] via-[#0E2242] to-[#0A192F] text-white border-b border-gold-500/20 relative overflow-hidden">
        <div class="absolute inset-0 bg-embassy-pattern opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center relative z-10 space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/10 border border-gold-400/30 text-gold-400 text-xs font-bold uppercase tracking-wider">
                {{ __('safir.brand_name') }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                {{ $page->title_text }}
            </h1>
            @if($page->summary_text)
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto font-light">
                    {{ $page->summary_text }}
                </p>
            @endif
        </div>
    </section>

    <!-- Main Content Body -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-8">
            <article class="prose prose-slate prose-lg max-w-none prose-headings:text-[#0A192F] prose-headings:font-bold prose-a:text-gold-700 hover:prose-a:text-gold-600 prose-img:rounded-2xl leading-relaxed">
                {!! $page->content_html !!}
            </article>
        </div>
    </section>

@endsection
