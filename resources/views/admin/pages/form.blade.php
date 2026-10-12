@extends('layouts.admin')

@section('title', $page->exists ? 'Edit Page: ' . $page->title_text : 'Create New Page')
@section('header_title', $page->exists ? 'Edit Page' : 'Create New Page')
@section('header_subtitle', $page->exists ? 'Updating institutional content and metadata for /' . $page->slug : 'Configure slug, multilingual content, and executive layouts')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{
    currentLocaleTab: 'en',
    template: '{{ old('template', $page->template ?? 'default') }}',
    titleEn: '{{ old('title_en', $page->getLocalized('title', 'en') ?? '') }}',
    slug: '{{ old('slug', $page->slug ?? '') }}',
    generateSlug() {
        if (!'{{ $page->exists }}') {
            this.slug = this.titleEn.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        }
    }
}">

    <!-- Breadcrumb / Back Link -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-navy-950 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Pages Listing</span>
        </a>

        @if($page->exists)
            <a href="{{ $page->url() }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gold-700 bg-gold-50 border border-gold-200 px-3 py-1.5 rounded-lg hover:bg-gold-100 transition-colors">
                <span>View Live Page</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        @endif
    </div>

    <form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" class="space-y-6">
        @csrf
        @if($page->exists)
            @method('PUT')
        @endif

        <!-- Card 1: Core Identity & Routing -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-2xs space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900">Page Identity & Template Setup</h3>
                <p class="text-xs text-slate-500">Configure page slug, rendering layout template, and publication state.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Template Picker -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Page Template</label>
                    <select name="template" x-model="template" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none bg-white">
                        <option value="default">Standard Content Page</option>
                        <option value="about">About Us (Safir Hub + Founders CVs)</option>
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1" x-show="template === 'about'">Activates two-column executive CV layout for founders.</p>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Page URL Slug</label>
                    <div class="flex items-center rounded-xl border border-slate-200 bg-slate-50 focus-within:border-gold-500 focus-within:ring-1 focus-within:ring-gold-500">
                        <span class="pl-3 text-xs text-slate-400 select-none">/</span>
                        <input type="text" name="slug" x-model="slug" placeholder="about-us" required
                               class="w-full bg-transparent p-2.5 text-xs text-slate-900 outline-none font-mono">
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Unique identifier (e.g. <code>about</code> or <code>executive-mission</code>)</p>
                </div>

                <!-- Sort Order & Publish Switch -->
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}" min="0"
                               class="w-full text-xs rounded-xl border border-slate-200 p-2.5 focus:border-gold-500 outline-none">
                    </div>

                    <div class="pt-5">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-gold-600 focus:ring-gold-500 w-4 h-4">
                            <span class="text-xs font-bold text-slate-700">Published</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Multilingual Content (Tabs: EN / AR / TR) -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-2xs space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900">Multilingual Page Content</h3>
                    <p class="text-xs text-slate-500">Maintain institutional translations across English, Arabic, and Turkish.</p>
                </div>

                <!-- Language Tabs Switcher -->
                <div class="inline-flex items-center bg-slate-100 p-1 rounded-xl gap-1">
                    <button type="button" @click="currentLocaleTab = 'en'" :class="currentLocaleTab === 'en' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-1.5 rounded-lg text-xs transition-all">
                        🇬🇧 English (EN)
                    </button>
                    <button type="button" @click="currentLocaleTab = 'ar'" :class="currentLocaleTab === 'ar' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-1.5 rounded-lg text-xs transition-all">
                        🇸🇦 العربية (AR)
                    </button>
                    <button type="button" @click="currentLocaleTab = 'tr'" :class="currentLocaleTab === 'tr' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-1.5 rounded-lg text-xs transition-all">
                        🇹🇷 Türkçe (TR)
                    </button>
                </div>
            </div>

            <!-- English Fields Tab -->
            <div x-show="currentLocaleTab === 'en'" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Page Title (English) <span class="text-rose-500">*</span></label>
                    <input type="text" name="title_en" x-model="titleEn" @input="generateSlug" value="{{ old('title_en', $page->getLocalized('title', 'en')) }}" required
                           class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Summary / Excerpt (English)</label>
                    <textarea name="summary_en" rows="3" class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">{{ old('summary_en', $page->getLocalized('summary', 'en')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Main Rich Content / Body HTML (English)</label>
                    <textarea name="content_en" rows="8" class="w-full text-xs font-mono rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none leading-relaxed">{{ old('content_en', $page->getLocalized('content', 'en')) }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1">Accepts standard text or HTML paragraphs (<code>&lt;p&gt;</code>, <code>&lt;h3&gt;</code>, <code>&lt;ul&gt;</code>).</p>
                </div>
            </div>

            <!-- Arabic Fields Tab -->
            <div x-show="currentLocaleTab === 'ar'" class="space-y-4" dir="rtl">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">عنوان الصفحة (بالعربية)</label>
                    <input type="text" name="title_ar" value="{{ old('title_ar', $page->getLocalized('title', 'ar')) }}"
                           class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الملخص التنفيذي (بالعربية)</label>
                    <textarea name="summary_ar" rows="3" class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">{{ old('summary_ar', $page->getLocalized('summary', 'ar')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">المحتوى الرئيسي / نصوص الفقرات (بالعربية)</label>
                    <textarea name="content_ar" rows="8" class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none leading-relaxed">{{ old('content_ar', $page->getLocalized('content', 'ar')) }}</textarea>
                </div>
            </div>

            <!-- Turkish Fields Tab -->
            <div x-show="currentLocaleTab === 'tr'" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Sayfa Başlığı (Türkçe)</label>
                    <input type="text" name="title_tr" value="{{ old('title_tr', $page->getLocalized('title', 'tr')) }}"
                           class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Özet / Giriş (Türkçe)</label>
                    <textarea name="summary_tr" rows="3" class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">{{ old('summary_tr', $page->getLocalized('summary', 'tr')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ana İçerik / Gövde (Türkçe)</label>
                    <textarea name="content_tr" rows="8" class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none leading-relaxed">{{ old('content_tr', $page->getLocalized('content', 'tr')) }}</textarea>
                </div>
            </div>
        </div>

        @php
            $f1 = $page->blocks['founders'][0] ?? [];
            $f2 = $page->blocks['founders'][1] ?? [];
        @endphp

        <!-- Card 3: Founders CVs Two Columns (Appears when Template is 'about') -->
        <div x-show="template === 'about'" class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-2xs space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-gold-500"></span>
                        <span>Founders Leadership CVs (Two Columns)</span>
                    </h3>
                    <p class="text-xs text-slate-500">Configure biographical and credential profiles for the two founding leaders.</p>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded bg-gold-50 text-gold-800 border border-gold-200">
                    2 Column Layout
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Column 1: Founder 1 CV -->
                <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/80 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-200 font-bold text-xs uppercase tracking-wider text-slate-800">
                        <span class="w-6 h-6 rounded-full bg-navy-950 text-gold-400 flex items-center justify-center font-bold text-xs">1</span>
                        <span>Founder 1 Profile (Diplomatic / Governance)</span>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="founder1_name" value="{{ old('founder1_name', $f1['name'] ?? 'Dr. Shams Al-Din Al-Tamimi') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 bg-white">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Role (EN)</label>
                            <input type="text" name="founder1_role_en" value="{{ old('founder1_role_en', $f1['role']['en'] ?? 'Co-Founder & Executive Chairman') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Role (AR)</label>
                            <input type="text" name="founder1_role_ar" value="{{ old('founder1_role_ar', $f1['role']['ar'] ?? 'المؤسس ورئيس مجلس الإدارة') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Role (TR)</label>
                            <input type="text" name="founder1_role_tr" value="{{ old('founder1_role_tr', $f1['role']['tr'] ?? 'Kurucu Ortak ve Başkan') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Executive Badge (EN / AR / TR)</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                            <input type="text" name="founder1_badge_en" placeholder="Badge EN" value="{{ old('founder1_badge_en', $f1['badge']['en'] ?? 'Diplomatic Advisory') }}" class="text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            <input type="text" name="founder1_badge_ar" placeholder="Badge AR" value="{{ old('founder1_badge_ar', $f1['badge']['ar'] ?? 'الاستشارات الدبلوماسية') }}" class="text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            <input type="text" name="founder1_badge_tr" placeholder="Badge TR" value="{{ old('founder1_badge_tr', $f1['badge']['tr'] ?? 'Diplomatik Danışmanlık') }}" class="text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Executive Biography (English)</label>
                        <textarea name="founder1_bio_en" rows="3" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 bg-white">{{ old('founder1_bio_en', $f1['bio']['en'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Executive Biography (Arabic)</label>
                        <textarea name="founder1_bio_ar" rows="3" dir="rtl" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 bg-white">{{ old('founder1_bio_ar', $f1['bio']['ar'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Career Highlights (One item per line - EN)</label>
                        <textarea name="founder1_highlights_en" rows="3" class="w-full text-xs font-mono rounded-xl border border-slate-200 p-2 bg-white">{{ old('founder1_highlights_en', is_array($f1['highlights']['en'] ?? null) ? implode("\n", $f1['highlights']['en']) : '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Education & Degrees (One item per line - EN)</label>
                        <textarea name="founder1_education_en" rows="2" class="w-full text-xs font-mono rounded-xl border border-slate-200 p-2 bg-white">{{ old('founder1_education_en', is_array($f1['education']['en'] ?? null) ? implode("\n", $f1['education']['en']) : '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">LinkedIn URL</label>
                            <input type="text" name="founder1_linkedin" value="{{ old('founder1_linkedin', $f1['linkedin'] ?? '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Direct Contact Email</label>
                            <input type="email" name="founder1_email" value="{{ old('founder1_email', $f1['email'] ?? '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                    </div>
                </div>

                <!-- Column 2: Founder 2 CV -->
                <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/80 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-200 font-bold text-xs uppercase tracking-wider text-slate-800">
                        <span class="w-6 h-6 rounded-full bg-gold-600 text-navy-950 flex items-center justify-center font-bold text-xs">2</span>
                        <span>Founder 2 Profile (Corporate / Investment)</span>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="founder2_name" value="{{ old('founder2_name', $f2['name'] ?? 'Eng. Tariq Al-Hashimi') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 bg-white">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Role (EN)</label>
                            <input type="text" name="founder2_role_en" value="{{ old('founder2_role_en', $f2['role']['en'] ?? 'Co-Founder & Managing Director') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Role (AR)</label>
                            <input type="text" name="founder2_role_ar" value="{{ old('founder2_role_ar', $f2['role']['ar'] ?? 'المؤسس والمدير العام') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Role (TR)</label>
                            <input type="text" name="founder2_role_tr" value="{{ old('founder2_role_tr', $f2['role']['tr'] ?? 'Kurucu Ortak ve Genel Müdür') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Executive Badge (EN / AR / TR)</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                            <input type="text" name="founder2_badge_en" placeholder="Badge EN" value="{{ old('founder2_badge_en', $f2['badge']['en'] ?? 'Cross-Border Investment') }}" class="text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            <input type="text" name="founder2_badge_ar" placeholder="Badge AR" value="{{ old('founder2_badge_ar', $f2['badge']['ar'] ?? 'الاستثمار الدولي') }}" class="text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            <input type="text" name="founder2_badge_tr" placeholder="Badge TR" value="{{ old('founder2_badge_tr', $f2['badge']['tr'] ?? 'Sınır Ötesi Yatırımlar') }}" class="text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Executive Biography (English)</label>
                        <textarea name="founder2_bio_en" rows="3" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 bg-white">{{ old('founder2_bio_en', $f2['bio']['en'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Executive Biography (Arabic)</label>
                        <textarea name="founder2_bio_ar" rows="3" dir="rtl" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 bg-white">{{ old('founder2_bio_ar', $f2['bio']['ar'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Career Highlights (One item per line - EN)</label>
                        <textarea name="founder2_highlights_en" rows="3" class="w-full text-xs font-mono rounded-xl border border-slate-200 p-2 bg-white">{{ old('founder2_highlights_en', is_array($f2['highlights']['en'] ?? null) ? implode("\n", $f2['highlights']['en']) : '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Education & Degrees (One item per line - EN)</label>
                        <textarea name="founder2_education_en" rows="2" class="w-full text-xs font-mono rounded-xl border border-slate-200 p-2 bg-white">{{ old('founder2_education_en', is_array($f2['education']['en'] ?? null) ? implode("\n", $f2['education']['en']) : '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">LinkedIn URL</label>
                            <input type="text" name="founder2_linkedin" value="{{ old('founder2_linkedin', $f2['linkedin'] ?? '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Direct Contact Email</label>
                            <input type="email" name="founder2_email" value="{{ old('founder2_email', $f2['email'] ?? '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Card 4: SEO Metadata -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-2xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700">Search Engine Optimization (Meta Data)</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Meta Title (English)</label>
                    <input type="text" name="meta_title_en" value="{{ old('meta_title_en', $page->getLocalized('meta_title', 'en')) }}" class="w-full text-xs rounded-xl border border-slate-200 p-2.5">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Meta Title (Arabic)</label>
                    <input type="text" name="meta_title_ar" dir="rtl" value="{{ old('meta_title_ar', $page->getLocalized('meta_title', 'ar')) }}" class="w-full text-xs rounded-xl border border-slate-200 p-2.5">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Meta Description (English)</label>
                    <textarea name="meta_description_en" rows="2" class="w-full text-xs rounded-xl border border-slate-200 p-2.5">{{ old('meta_description_en', $page->getLocalized('meta_description', 'en')) }}</textarea>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Meta Description (Arabic)</label>
                    <textarea name="meta_description_ar" rows="2" dir="rtl" class="w-full text-xs rounded-xl border border-slate-200 p-2.5">{{ old('meta_description_ar', $page->getLocalized('meta_description', 'ar')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Action Submit Buttons -->
        <div class="flex items-center justify-end gap-3 pt-4">
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-600 hover:brightness-105 shadow-md shadow-gold-500/20 transition-all cursor-pointer">
                {{ $page->exists ? 'Save & Update Page' : 'Create & Publish Page' }}
            </button>
        </div>

    </form>
</div>
@endsection
