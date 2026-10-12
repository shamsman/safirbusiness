@extends('layouts.app')

@php
    $pageTitle = isset($page) && $page->title_text ? $page->title_text : __('safir.nav.about');
    $pageDesc = isset($page) && $page->meta_description_text ? $page->meta_description_text : __('safir.philosophy');
    $founders = isset($page) && !empty($page->blocks['founders']) ? $page->blocks['founders'] : [
        [
            'name' => 'Dr. Shams Al-Din Al-Tamimi',
            'role' => [
                'en' => 'Co-Founder & Executive Chairman',
                'ar' => 'المؤسس المشارك ورئيس مجلس الإدارة',
                'tr' => 'Kurucu Ortak ve Yönetim Kurulu Başkanı',
            ],
            'badge' => [
                'en' => 'Diplomatic Governance & Sovereign Relations',
                'ar' => 'الاستشارات الدبلوماسية والعلاقات السيادية',
                'tr' => 'Diplomatik Danışmanlık ve Hükümet İlişkileri',
            ],
            'bio' => [
                'en' => 'Senior diplomatic and geopolitical advisor with over 22 years of senior engagement alongside foreign embassies, inter-governmental bodies, and international economic chambers in Ankara. Pioneer in institutional matchmaking, inter-state dialogues, and high-level sovereign delegation protocol.',
                'ar' => 'مستشار دبلوماسي وجيوسياسي رفيع بخبرة تتجاوز 22 عاماً في العمل الاستشاري المباشر مع السفارات المعتمدة، والهيئات الحكومية، والاتحادات التجارية في أنقرة. يقود الاستراتيجيات السيادية وملفات التعاون الاقتصادي الثنائي وبروتوكولات الوفود الرسمية.',
                'tr' => 'Ankara’da büyükelçilikler, bakanlıklar ve uluslararası ticaret odalarıyla 22 yılı aşkın üst düzey çalışma tecrübesine sahip diplomatik ve jeopolitik danışman. Hükümetlerarası işbirliği ve protokol yönetiminde öncü.',
            ],
            'highlights' => [
                'en' => [
                    'Strategic advisor to 30+ diplomatic missions and trade offices across Türkiye',
                    'Key architect of bilateral commercial treaties, trade forums, and chamber alliances',
                    'Senior consultant for government relations, protocol, and cross-border delegations',
                    'Director of institutional bilateral dialogues linking GCC missions with Turkish authorities',
                ],
                'ar' => [
                    'تقديم استشارات لأكثر من 30 بعثة دبلوماسية وملحقية تجارية في تركيا',
                    'مهندس رئيسي لمذكرات التفاهم الاقتصادية واتفاقيات غرف التجارة الثنائية',
                    'خبير مرجعي في بروتوكولات الوفود الرسمية والخدمات القنصلية والمؤسسية',
                    'إدارة حوارات الشراكة الاستراتيجية بين البعثات الإقليمية والمؤسسات التركية',
                ],
                'tr' => [
                    '30’dan fazla büyükelçilik ve ticari ataşeliğe stratejik danışmanlık',
                    'İkili ticaret anlaşmaları, ekonomi forumları ve oda protokollerinin koordinasyonu',
                    'Resmi heyetler, kamu ilişkileri ve konsolosluk hizmetlerinde üst düzey deneyim',
                    'Körfez ve Türkiye arasındaki kurumsal temasların geliştirilmesinde stratejik liderlik',
                ],
            ],
            'education' => [
                'en' => [
                    'Ph.D. in International Relations & Geopolitics — Sorbonne University',
                    'M.Sc. in Diplomatic Studies & Sovereign Public Policy — LSE',
                ],
                'ar' => [
                    'دكتوراه في العلاقات الدولية والجيوسياسية — جامعة السوربون',
                    'ماجستير الدراسات الدبلوماسية والسياسات العامة — كلية لندن للاقتصاد (LSE)',
                ],
                'tr' => [
                    'Uluslararası İlişkiler ve Jeopolitik Doktora — Sorbonne Üniversitesi',
                    'Diplomatik Çalışmalar ve Kamu Politikası Yüksek Lisans — LSE',
                ],
            ],
            'linkedin' => 'https://linkedin.com',
            'email' => 'chairman@safirbusiness.com',
        ],
        [
            'name' => 'Eng. Tariq Al-Hashimi',
            'role' => [
                'en' => 'Co-Founder & Managing Director',
                'ar' => 'المؤسس المشارك والمدير العام التنفيذي',
                'tr' => 'Kurucu Ortak ve Genel Müdür',
            ],
            'badge' => [
                'en' => 'Cross-Border Investment & Corporate Market Entry',
                'ar' => 'الاستثمار الدولي والدخول الاستراتيجي للأسواق',
                'tr' => 'Sınır Ötesi Yatırımlar ve Pazar Girişi',
            ],
            'bio' => [
                'en' => 'Strategic enterprise advisor and investment specialist who has orchestrated multi-million-dollar cross-border ventures, FDI projects, and public-private consortia across Türkiye, the Gulf, and Europe in manufacturing, logistics, defense tech, and commercial infrastructure.',
                'ar' => 'خبير استثماري واستراتيجي بارز قاد مشاريع استثمار أجنبي مباشر وتحالفات استراتيجية كبرى بقيمة مئات الملايين من الدولارات عبر تركيا والخليج العربي في قطاعات الصناعة واللوجستيات والبنية التحتية والتكنولوجيا.',
                'tr' => 'Türkiye, Körfez ve Avrupa genelinde sanayi, lojistik, savunma ve teknoloji alanlarında yüz milyonlarca dolarlık doğrudan yabancı yatırım ve ortak girişimi yönetmiş kurumsal strateji lideri.',
            ],
            'highlights' => [
                'en' => [
                    'Facilitated $400M+ in cross-border foreign direct investment and joint ventures in Türkiye',
                    'Trusted advisor to sovereign wealth funds, family offices, and multinational enterprises',
                    'Expert in Turkish Free Zones, investment incentives, tax regimes, and regulatory approvals',
                    'Led over 45 market-entry feasibility studies and institutional B2B consortiums',
                ],
                'ar' => [
                    'تيسير استثمارات وتوسعات بقيمة تتجاوز 400 مليون دولار في السوق التركي',
                    'مستشار استراتيجي لمجموعات استثمارية كبرى وصناديق سيادية ومكاتب عائلية',
                    'خبير متخصص في حوافز الاستثمار الحكومية، والمناطق الحرة، واللوائح التنظيمية في تركيا',
                    'قيادة أكثر من 45 دراسة جدوى لدخول السوق وتحالفات B2B استراتيجية',
                ],
                'tr' => [
                    'Türkiye’de 400 milyon doları aşkın doğrudan yatırım ve ortak girişim koordinasyonu',
                    'Egemen fonlar, aile ofisleri ve küresel şirketlere yönetim danışmanlığı',
                    'Türkiye Yatırım Teşvikleri, Serbest Bölgeler ve mevzuat uyumu uzmanlığı',
                    '45’ten fazla pazar girişi fizibilite çalışması ve B2B işbirliğinin yönetimi',
                ],
            ],
            'education' => [
                'en' => [
                    'MBA in Strategic Management & Corporate Finance — INSEAD',
                    'B.Sc. in Industrial & Systems Engineering',
                ],
                'ar' => [
                    'ماجستير إدارة الأعمال والتمويل المؤسسي — إنسياد (INSEAD)',
                    'بكالوريوس الهندسة الصناعية وهندسة النظم',
                ],
                'tr' => [
                    'Stratejik Yönetim ve Kurumsal Finans MBA — INSEAD',
                    'Endüstri ve Sistem Mühendisliği Lisans',
                ],
            ],
            'linkedin' => 'https://linkedin.com',
            'email' => 'managing.director@safirbusiness.com',
        ],
    ];
@endphp

@section('title', $pageTitle . ' — ' . __('safir.brand_name'))
@section('meta_description', $pageDesc)

@section('content')

    <!-- 1. Hero / Header Banner -->
    <section class="py-20 md:py-28 bg-gradient-to-b from-[#0A192F] via-[#0E2242] to-[#0A192F] text-white relative overflow-hidden border-b border-gold-500/20">
        <!-- Background Ambient Accents -->
        <div class="absolute inset-0 bg-embassy-pattern opacity-10"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-gold-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-gold-400/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-8 text-center relative z-10 space-y-6">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gold-500/10 border border-gold-400/30 text-gold-400 text-xs font-bold uppercase tracking-widest">
                <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                <span>{{ __('safir.nav.about') }}</span>
            </span>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                {{ isset($page) && $page->title_text ? $page->title_text : __('safir.about_page.title') }}
            </h1>

            <p class="text-slate-300 text-base sm:text-xl leading-relaxed max-w-3xl mx-auto font-light">
                {{ isset($page) && $page->summary_text ? $page->summary_text : __('safir.short_bio') }}
            </p>

            <div class="pt-4 flex items-center justify-center gap-3">
                <span class="h-0.5 w-12 bg-gold-500/50"></span>
                <span class="text-xs uppercase tracking-widest text-gold-400 font-bold font-mono">{{ site_address() }}</span>
                <span class="h-0.5 w-12 bg-gold-500/50"></span>
            </div>
        </div>
    </section>

    <!-- 2. Institutional Summary about Safir Hub -->
    <section class="py-20 bg-white border-b border-[#E8E4DA] relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left: Philosophical & Identity Statement -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="inline-block text-xs uppercase tracking-widest text-gold-800 font-bold px-3 py-1 rounded bg-gold-50 border border-gold-200">
                        {{ __('safir.about_page.core_philosophy_badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A192F] tracking-tight leading-snug">
                        {{ __('safir.tagline') }}
                    </h2>
                    <blockquote class="text-slate-700 text-sm sm:text-base leading-relaxed border-s-4 border-gold-500 ps-4 italic">
                        « {{ __('safir.philosophy') }} »
                    </blockquote>
                    <div class="text-xs font-bold text-gold-800 uppercase tracking-wider font-mono">
                        {{ __('safir.brand_signature') }}
                    </div>
                </div>

                <!-- Right: Comprehensive Ecosystem Overview -->
                <div class="lg:col-span-7 bg-[#FAF9F5] p-8 sm:p-10 rounded-3xl border border-[#E2DDD3] shadow-xs space-y-5 text-slate-700 text-sm leading-relaxed">
                    <h3 class="text-lg font-bold text-[#0A192F] flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>{{ __('safir.sub_tagline') }}</span>
                    </h3>

                    @if(isset($page) && $page->content_html)
                        <div class="prose prose-sm max-w-none text-slate-700 space-y-3">
                            {!! $page->content_html !!}
                        </div>
                    @else
                        <p>
                            {{ __('safir.short_bio') }}
                        </p>
                        <p>
                            Safir Business Hub operates directly from the institutional capital of Türkiye, Ankara. We provide diplomatic missions, state entities, multinational enterprises, and sovereign investment authorities with end-to-end access to Turkish decision-makers, ministries, chambers of commerce, and industrial free zones.
                        </p>
                    @endif

                    <!-- Four Pillars Checklist Pill -->
                    <div class="grid grid-cols-2 gap-3 pt-3 border-t border-[#E8E4DA] text-xs">
                        <div class="flex items-center gap-2 font-semibold text-[#0A192F]">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-600"></span>
                            <span>{{ __('safir.pillars.economy.title') }}</span>
                        </div>
                        <div class="flex items-center gap-2 font-semibold text-[#0A192F]">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-600"></span>
                            <span>{{ __('safir.pillars.relations.title') }}</span>
                        </div>
                        <div class="flex items-center gap-2 font-semibold text-[#0A192F]">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-600"></span>
                            <span>{{ __('safir.pillars.events.title') }}</span>
                        </div>
                        <div class="flex items-center gap-2 font-semibold text-[#0A192F]">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-600"></span>
                            <span>{{ __('safir.pillars.community.title') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. TWO COLUMNS FOR FOUNDERS' CVs -->
    <section class="py-24 bg-[#F8F7F2] border-b border-[#E8E4DA] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-gold-800 text-xs font-bold uppercase tracking-widest">
                    <span>Executive Leadership</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0A192F] tracking-tight">
                    Meet the Founders
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Bridging diplomatic sovereignty, institutional strategy, and cross-border commercial execution.
                </p>
                <div class="mx-auto w-16 h-1 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-600 rounded-full mt-4"></div>
            </div>

            <!-- Two-Column Grid for Founders CVs -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                @foreach($founders as $index => $founder)
                    @php
                        $loc = app()->getLocale();
                        $fRole = is_array($founder['role'] ?? null) ? ($founder['role'][$loc] ?? ($founder['role']['en'] ?? 'Co-Founder')) : ($founder['role'] ?? 'Co-Founder');
                        $fBadge = is_array($founder['badge'] ?? null) ? ($founder['badge'][$loc] ?? ($founder['badge']['en'] ?? 'Executive')) : ($founder['badge'] ?? 'Executive');
                        $fBio = is_array($founder['bio'] ?? null) ? ($founder['bio'][$loc] ?? ($founder['bio']['en'] ?? '')) : ($founder['bio'] ?? '');
                        
                        $fHighlights = is_array($founder['highlights'] ?? null) 
                            ? (isset($founder['highlights'][$loc]) ? $founder['highlights'][$loc] : ($founder['highlights']['en'] ?? $founder['highlights'])) 
                            : [];
                        
                        $fEducation = is_array($founder['education'] ?? null) 
                            ? (isset($founder['education'][$loc]) ? $founder['education'][$loc] : ($founder['education']['en'] ?? $founder['education'])) 
                            : [];
                    @endphp

                    <article class="bg-white rounded-3xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                        
                        <!-- Top Accent Line -->
                        <div class="h-2 w-full bg-gradient-to-r {{ $index === 0 ? 'from-[#0A192F] via-gold-500 to-[#0A192F]' : 'from-gold-600 via-gold-400 to-[#0A192F]' }}"></div>

                        <div class="p-8 sm:p-10 space-y-6 flex-1">
                            
                            <!-- Header / Portrait & Name -->
                            <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                                <!-- Monogram / Photo Ring -->
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-br from-[#0A192F] via-[#122A4E] to-[#0A192F] text-gold-400 ring-4 ring-gold-500/20 shadow-md flex items-center justify-center font-serif text-3xl font-extrabold shrink-0 group-hover:scale-105 transition-transform">
                                    {{ Str::substr($founder['name'] ?? 'S', 0, 1) }}
                                </div>

                                <div class="space-y-1 min-w-0">
                                    <span class="inline-block text-[10.5px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-gold-50 text-gold-800 border border-gold-200">
                                        {{ $fBadge }}
                                    </span>
                                    <h3 class="text-xl sm:text-2xl font-bold text-[#0A192F] tracking-tight">
                                        {{ $founder['name'] }}
                                    </h3>
                                    <p class="text-xs sm:text-sm font-semibold text-gold-700 tracking-wide">
                                        {{ $fRole }}
                                    </p>
                                </div>
                            </div>

                            <!-- Executive Biography -->
                            <div class="text-slate-600 text-xs sm:text-sm leading-relaxed border-t border-slate-100 pt-5">
                                {{ $fBio }}
                            </div>

                            <!-- Key Track Record & Highlights -->
                            @if(!empty($fHighlights) && is_array($fHighlights))
                            <div class="space-y-3 pt-2">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-[#0A192F] flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Career Highlights & Strategic Mandates</span>
                                </h4>
                                <ul class="space-y-2 text-xs text-slate-600">
                                    @foreach($fHighlights as $highlight)
                                        @if(trim($highlight))
                                        <li class="flex items-start gap-2.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500 mt-1.5 shrink-0"></span>
                                            <span class="leading-relaxed">{{ $highlight }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Education & Academic Credentials -->
                            @if(!empty($fEducation) && is_array($fEducation))
                            <div class="space-y-3 pt-2">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-[#0A192F] flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                    <span>Education & Qualifications</span>
                                </h4>
                                <ul class="space-y-2 text-xs text-slate-600">
                                    @foreach($fEducation as $deg)
                                        @if(trim($deg))
                                        <li class="flex items-start gap-2.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-navy-950 mt-1.5 shrink-0"></span>
                                            <span class="leading-relaxed">{{ $deg }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </div>

                        <!-- Footer Touchpoint & Contact -->
                        <div class="px-8 py-5 bg-[#FAF9F5] border-t border-[#E8E4DA] flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-mono text-[11px]">
                                {{ site_address() }}
                            </span>

                            <div class="flex items-center gap-3">
                                @if(!empty($founder['email']))
                                    <a href="mailto:{{ $founder['email'] }}" class="text-slate-600 hover:text-gold-700 transition-colors" title="Institutional Email">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </a>
                                @endif
                                @if(!empty($founder['linkedin']))
                                    <a href="{{ $founder['linkedin'] }}" target="_blank" rel="noopener" class="text-slate-600 hover:text-gold-700 transition-colors" title="Executive LinkedIn">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </article>
                @endforeach

            </div>

        </div>
    </section>

    <!-- 4. Strategic Advantages (The 3 core tenets) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-2xs transition-all">
                    <div class="text-gold-700 text-3xl font-bold font-mono mb-3">01.</div>
                    <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.about_page.advantages.1.title') }}</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ __('safir.about_page.advantages.1.desc') }}
                    </p>
                </div>

                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-2xs transition-all">
                    <div class="text-gold-700 text-3xl font-bold font-mono mb-3">02.</div>
                    <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.about_page.advantages.2.title') }}</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ __('safir.about_page.advantages.2.desc') }}
                    </p>
                </div>

                <div class="bg-[#FAF9F5] p-8 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-2xs transition-all">
                    <div class="text-gold-700 text-3xl font-bold font-mono mb-3">03.</div>
                    <h3 class="text-lg font-bold text-[#0A192F] mb-2">{{ __('safir.about_page.advantages.3.title') }}</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ __('safir.about_page.advantages.3.desc') }}
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
