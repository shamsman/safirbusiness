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

    <form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" enctype="multipart/form-data" class="space-y-6">
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
                        <option value="embassies">Embassies Portal</option>
                        <option value="corporates">Corporates Portal</option>
                        <option value="contact">Contact Us & Headquarters</option>
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1" x-show="template === 'about'">Activates two-column executive CV layout for founders.</p>
                    <p class="text-[11px] text-slate-400 mt-1" x-show="template === 'embassies'">Renders diplomatic desks, services, and macroeconomic intelligence.</p>
                    <p class="text-[11px] text-slate-400 mt-1" x-show="template === 'corporates'">Renders corporate entry roadmap, FDI incentives, and matchmaking.</p>
                    <p class="text-[11px] text-slate-400 mt-1" x-show="template === 'contact'">Renders Ankara HQ details, official contact channels, and inquiry form.</p>
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
                    <button type="button" @click="currentLocaleTab = 'en'; $nextTick(() => window.dispatchEvent(new Event('resize')))" :class="currentLocaleTab === 'en' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-1.5 rounded-lg text-xs transition-all">
                        🇬🇧 English (EN)
                    </button>
                    <button type="button" @click="currentLocaleTab = 'ar'; $nextTick(() => window.dispatchEvent(new Event('resize')))" :class="currentLocaleTab === 'ar' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-1.5 rounded-lg text-xs transition-all">
                        🇸🇦 العربية (AR)
                    </button>
                    <button type="button" @click="currentLocaleTab = 'tr'; $nextTick(() => window.dispatchEvent(new Event('resize')))" :class="currentLocaleTab === 'tr' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-1.5 rounded-lg text-xs transition-all">
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
                    <x-rich-editor name="content_en"
                                   label="Main Rich Content / Body HTML (English)"
                                   :value="old('content_en', $page->getLocalized('content', 'en'))"
                                   minHeight="220px"
                                   placeholder="Compose formatted English content..."
                                   help="Use the toolbar to format headers, lists, links, or switch to HTML Source for raw markup editing." />
                </div>
            </div>

            <!-- Arabic Fields Tab -->
            <div x-show="currentLocaleTab === 'ar'" class="space-y-4">
                <div dir="rtl">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">عنوان الصفحة (بالعربية)</label>
                    <input type="text" name="title_ar" value="{{ old('title_ar', $page->getLocalized('title', 'ar')) }}"
                           class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">
                </div>

                <div dir="rtl">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الملخص التنفيذي (بالعربية)</label>
                    <textarea name="summary_ar" rows="3" class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">{{ old('summary_ar', $page->getLocalized('summary', 'ar')) }}</textarea>
                </div>

                <div>
                    <x-rich-editor name="content_ar"
                                   label="المحتوى الرئيسي / نصوص الفقرات (بالعربية)"
                                   :value="old('content_ar', $page->getLocalized('content', 'ar'))"
                                   dir="rtl"
                                   minHeight="220px"
                                   placeholder="اكتب المحتوى المؤسسي المنسق باللغة العربية..."
                                   help="استخدم شريط الأدوات لتنسيق العناوين والقوائم، أو اضغط على HTML Source للتعديل المباشر على الأكواد." />
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
                    <x-rich-editor name="content_tr"
                                   label="Ana İçerik / Gövde (Türkçe)"
                                   :value="old('content_tr', $page->getLocalized('content', 'tr'))"
                                   minHeight="220px"
                                   placeholder="Türkçe zengin kurumsal içerik yazın..."
                                   help="Başlıklar, listeler ve bağlantılar için araç çubuğunu kullanın veya doğrudan HTML Source moduna geçin." />
                </div>
            </div>
        </div>

        @php
            $f1 = $page->blocks['founders'][0] ?? [];
            $f2 = $page->blocks['founders'][1] ?? [];
        @endphp

        <!-- Card 3: Founders CVs Two Columns (Appears when Template is 'about' or slug is about/about-us) -->
        <div x-show="template === 'about' || slug === 'about' || slug === 'about-us'" class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-2xs space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-gold-500"></span>
                        <span>Founders Leadership CVs & Focus Areas (Two Columns)</span>
                    </h3>
                    <p class="text-xs text-slate-500">Configure portraits, executive focus badges, and biographical credentials for the founding leaders.</p>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded bg-gold-50 text-gold-800 border border-gold-200">
                    2 Column Layout
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Column 1: Founder 1 Profile -->
                <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/80 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-200 font-bold text-xs uppercase tracking-wider text-slate-800">
                        <span class="w-6 h-6 rounded-full bg-navy-950 text-gold-400 flex items-center justify-center font-bold text-xs">1</span>
                        <span>Founder 1 Profile</span>
                    </div>

                    <!-- Founder 1 Photo Upload & Preview -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Executive Photo / Portrait</label>
                        @if(!empty($f1['photo']))
                            <div class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 mb-2">
                                <img src="{{ media_url($f1['photo']) }}" alt="{{ $f1['name'] ?? 'Founder 1' }}" class="w-14 h-14 rounded-xl object-cover ring-2 ring-gold-500/30">
                                <div class="space-y-1">
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-rose-600 hover:text-rose-700 cursor-pointer">
                                        <input type="checkbox" name="remove_founder1_photo" value="1" class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                        <span>Remove current photo</span>
                                    </label>
                                    <p class="text-[10px] text-slate-400">If removed, the letter monogram will display.</p>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="founder1_photo" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gold-500/15 file:text-gold-700 hover:file:bg-gold-500/25 cursor-pointer">
                        <p class="text-[10px] text-slate-400 mt-1">Recommended: Square portrait (JPG, PNG, WebP up to 5MB).</p>
                        @error('founder1_photo')
                            <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Focus Area Badge (e.g. Diplomatic Advisory) -->
                    <div class="p-3.5 bg-amber-50/60 rounded-xl border border-amber-200/70 space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-[11px] font-bold text-[#0A192F]">
                                Focus Area / Specialty Badge (e.g. Diplomatic Advisory)
                            </label>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-gold-100 text-gold-900 border border-gold-300">Pill Header</span>
                        </div>
                        <p class="text-[10px] text-slate-500 leading-tight">Displayed in the gold pill badge right above the founder's name on the website.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pt-1">
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-600 mb-0.5">English (EN)</label>
                                <input type="text" name="founder1_badge_en" placeholder="Diplomatic Advisory" value="{{ old('founder1_badge_en', is_array($f1['badge'] ?? null) ? ($f1['badge']['en'] ?? 'Diplomatic Advisory') : ($f1['badge'] ?? 'Diplomatic Advisory')) }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-600 mb-0.5">العربية (AR)</label>
                                <input type="text" name="founder1_badge_ar" placeholder="الاستشارات الدبلوماسية" dir="rtl" value="{{ old('founder1_badge_ar', is_array($f1['badge'] ?? null) ? ($f1['badge']['ar'] ?? 'الاستشارات الدبلوماسية') : '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-600 mb-0.5">Türkçe (TR)</label>
                                <input type="text" name="founder1_badge_tr" placeholder="Diplomatik Danışmanlık" value="{{ old('founder1_badge_tr', is_array($f1['badge'] ?? null) ? ($f1['badge']['tr'] ?? 'Diplomatik Danışmanlık') : '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            </div>
                        </div>
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
                        <x-rich-editor name="founder1_bio_en"
                                       label="Executive Biography (English)"
                                       :value="old('founder1_bio_en', $f1['bio']['en'] ?? '')"
                                       minHeight="140px"
                                       placeholder="Executive biography, credentials, and achievements in English..." />
                    </div>

                    <div>
                        <x-rich-editor name="founder1_bio_ar"
                                       label="Executive Biography (Arabic) / السيرة الذاتية التنفيذية"
                                       :value="old('founder1_bio_ar', $f1['bio']['ar'] ?? '')"
                                       dir="rtl"
                                       minHeight="140px"
                                       placeholder="اكتب السيرة الذاتية والخبرات والمناصب القيادية بالعربية..." />
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

                <!-- Column 2: Founder 2 Profile -->
                <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/80 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-200 font-bold text-xs uppercase tracking-wider text-slate-800">
                        <span class="w-6 h-6 rounded-full bg-gold-600 text-navy-950 flex items-center justify-center font-bold text-xs">2</span>
                        <span>Founder 2 Profile</span>
                    </div>

                    <!-- Founder 2 Photo Upload & Preview -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Executive Photo / Portrait</label>
                        @if(!empty($f2['photo']))
                            <div class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 mb-2">
                                <img src="{{ media_url($f2['photo']) }}" alt="{{ $f2['name'] ?? 'Founder 2' }}" class="w-14 h-14 rounded-xl object-cover ring-2 ring-gold-500/30">
                                <div class="space-y-1">
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-rose-600 hover:text-rose-700 cursor-pointer">
                                        <input type="checkbox" name="remove_founder2_photo" value="1" class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                        <span>Remove current photo</span>
                                    </label>
                                    <p class="text-[10px] text-slate-400">If removed, the letter monogram will display.</p>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="founder2_photo" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gold-500/15 file:text-gold-700 hover:file:bg-gold-500/25 cursor-pointer">
                        <p class="text-[10px] text-slate-400 mt-1">Recommended: Square portrait (JPG, PNG, WebP up to 5MB).</p>
                        @error('founder2_photo')
                            <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Focus Area Badge (e.g. Cross-Border Investment) -->
                    <div class="p-3.5 bg-amber-50/60 rounded-xl border border-amber-200/70 space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-[11px] font-bold text-[#0A192F]">
                                Focus Area / Specialty Badge (e.g. Cross-Border Investment)
                            </label>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-gold-100 text-gold-900 border border-gold-300">Pill Header</span>
                        </div>
                        <p class="text-[10px] text-slate-500 leading-tight">Displayed in the gold pill badge right above the founder's name on the website.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pt-1">
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-600 mb-0.5">English (EN)</label>
                                <input type="text" name="founder2_badge_en" placeholder="Cross-Border Investment" value="{{ old('founder2_badge_en', is_array($f2['badge'] ?? null) ? ($f2['badge']['en'] ?? 'Cross-Border Investment') : ($f2['badge'] ?? 'Cross-Border Investment')) }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-600 mb-0.5">العربية (AR)</label>
                                <input type="text" name="founder2_badge_ar" placeholder="الاستثمار الدولي" dir="rtl" value="{{ old('founder2_badge_ar', is_array($f2['badge'] ?? null) ? ($f2['badge']['ar'] ?? 'الاستثمار الدولي') : '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-600 mb-0.5">Türkçe (TR)</label>
                                <input type="text" name="founder2_badge_tr" placeholder="Sınır Ötesi Yatırımlar" value="{{ old('founder2_badge_tr', is_array($f2['badge'] ?? null) ? ($f2['badge']['tr'] ?? 'Sınır Ötesi Yatırımlar') : '') }}" class="w-full text-xs rounded-xl border border-slate-200 p-2 bg-white">
                            </div>
                        </div>
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
                        <x-rich-editor name="founder2_bio_en"
                                       label="Executive Biography (English)"
                                       :value="old('founder2_bio_en', $f2['bio']['en'] ?? '')"
                                       minHeight="140px"
                                       placeholder="Executive biography, credentials, and achievements in English..." />
                    </div>

                    <div>
                        <x-rich-editor name="founder2_bio_ar"
                                       label="Executive Biography (Arabic) / السيرة الذاتية التنفيذية"
                                       :value="old('founder2_bio_ar', $f2['bio']['ar'] ?? '')"
                                       dir="rtl"
                                       minHeight="140px"
                                       placeholder="اكتب السيرة الذاتية والخبرات والمناصب القيادية بالعربية..." />
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
