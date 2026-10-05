@extends('layouts.admin')

@section('title', 'Website Settings')
@section('header_title', 'Website Configuration & Governance')
@section('header_subtitle', 'Configure brand identity, contact touchpoints, logos, and institutional metadata')

@section('content')
<div class="max-w-5xl mx-auto space-y-6" x-data="{ activeTab: '{{ $activeTab }}' }">

    <!-- Tabs Navigation Bar -->
    <div class="flex items-center gap-2 border-b border-slate-200 pb-3 overflow-x-auto">
        <button type="button" @click="activeTab = 'general'"
                :class="activeTab === 'general' ? 'bg-gold-500/10 text-gold-700 border-gold-500/30 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent'"
                class="px-4 py-2 rounded-xl text-xs font-semibold border transition-all flex items-center gap-2 cursor-pointer whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <span>General Identity</span>
        </button>

        <button type="button" @click="activeTab = 'branding'"
                :class="activeTab === 'branding' ? 'bg-gold-500/10 text-gold-700 border-gold-500/30 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent'"
                class="px-4 py-2 rounded-xl text-xs font-semibold border transition-all flex items-center gap-2 cursor-pointer whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Logo & Branding</span>
        </button>

        <button type="button" @click="activeTab = 'contact'"
                :class="activeTab === 'contact' ? 'bg-gold-500/10 text-gold-700 border-gold-500/30 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent'"
                class="px-4 py-2 rounded-xl text-xs font-semibold border transition-all flex items-center gap-2 cursor-pointer whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            <span>Contact & Offices</span>
        </button>

        <button type="button" @click="activeTab = 'social'"
                :class="activeTab === 'social' ? 'bg-gold-500/10 text-gold-700 border-gold-500/30 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent'"
                class="px-4 py-2 rounded-xl text-xs font-semibold border transition-all flex items-center gap-2 cursor-pointer whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            <span>Social Channels</span>
        </button>

        <button type="button" @click="activeTab = 'footer'"
                :class="activeTab === 'footer' ? 'bg-gold-500/10 text-gold-700 border-gold-500/30 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent'"
                class="px-4 py-2 rounded-xl text-xs font-semibold border transition-all flex items-center gap-2 cursor-pointer whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
            <span>Footer Configuration</span>
        </button>

        <button type="button" @click="activeTab = 'scripts'"
                :class="activeTab === 'scripts' ? 'bg-gold-500/10 text-gold-700 border-gold-500/30 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent'"
                class="px-4 py-2 rounded-xl text-xs font-semibold border transition-all flex items-center gap-2 cursor-pointer whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            <span>Scripts & Analytics</span>
        </button>
    </div>

    <!-- Settings Main Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="active_tab" :value="activeTab">

        <!-- Tab 1: General -->
        <div x-show="activeTab === 'general'" class="space-y-6">
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Platform Identity</h3>
                    <p class="text-xs text-slate-500">Institutional nomenclature and high-level platform descriptor</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Platform Name
                    </label>
                    <input type="text" name="site_name" value="{{ old('site_name', setting('site_name')) }}"
                           placeholder="Safir Business Hub"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Official Tagline
                    </label>
                    <input type="text" name="site_tagline" value="{{ old('site_tagline', setting('site_tagline')) }}"
                           placeholder="Diplomatic Economic Gateway & Strategic Market Entry"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Site Description (Meta / SEO)
                    </label>
                    <textarea name="site_description" rows="3"
                              class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">{{ old('site_description', setting('site_description')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Default Currency Display
                    </label>
                    <input type="text" name="default_currency" value="{{ old('default_currency', setting('default_currency', 'USD ($)')) }}"
                           placeholder="USD ($)"
                           class="w-full max-w-xs px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>
            </div>
        </div>

        <!-- Tab 2: Branding -->
        <div x-show="activeTab === 'branding'" class="space-y-6" style="display: none;">
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-6">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Visual Emblem & Branding</h3>
                    <p class="text-xs text-slate-500">Upload primary logo, insignia, and browser favicon</p>
                </div>

                <!-- Logo Section -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Primary Portal Logo
                    </label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="h-16 w-48 rounded-xl bg-white border border-slate-200 flex items-center justify-center p-3 overflow-hidden shadow-xs">
                            @if(setting('site_logo') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('site_logo')))
                                <img src="{{ \Illuminate\Support\Facades\Storage::url(setting('site_logo')) }}" alt="Logo" class="max-h-full max-w-full object-contain">
                            @else
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-navy-950 font-bold text-base">S</div>
                                    <span class="text-xs font-bold text-slate-900 tracking-wide">SAFIR <span class="text-gold-600">BUSINESS</span></span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <input type="file" name="site_logo" accept="image/*" class="text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gold-500/15 file:text-gold-700 hover:file:bg-gold-500/25 cursor-pointer">
                            <p class="text-[11px] text-slate-500">Supports PNG, SVG, JPG, WebP. Recommended height: 48px to 64px.</p>

                            @if(setting('site_logo'))
                                <label class="inline-flex items-center gap-2 text-xs text-rose-600 cursor-pointer pt-1 font-medium">
                                    <input type="checkbox" name="remove_logo" value="1" class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                    <span>Revert to default emblem</span>
                                </label>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Favicon Section -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Browser Tab Favicon
                    </label>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center overflow-hidden shadow-xs">
                            @if(setting('site_favicon') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('site_favicon')))
                                <img src="{{ \Illuminate\Support\Facades\Storage::url(setting('site_favicon')) }}" alt="Favicon" class="w-6 h-6 object-contain">
                            @else
                                <span class="text-xs font-bold text-gold-600">S</span>
                            @endif
                        </div>
                        <input type="file" name="site_favicon" accept="image/x-icon,image/png,image/svg+xml" class="text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-800 hover:file:bg-slate-300 cursor-pointer">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3: Contact -->
        <div x-show="activeTab === 'contact'" class="space-y-6" style="display: none;">
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Contact & Diplomatic Liaison Touchpoints</h3>
                    <p class="text-xs text-slate-500">Communication lines, emails, and global office addresses</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            General Inquiry Email
                        </label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', setting('contact_email')) }}"
                               placeholder="contact@safirbusiness.com"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Advisory & Intelligence Email
                        </label>
                        <input type="email" name="support_email" value="{{ old('support_email', setting('support_email')) }}"
                               placeholder="intelligence@safirbusiness.com"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Primary Phone Number
                        </label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', setting('contact_phone')) }}"
                               placeholder="+90 (312) 439 88 00"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Direct WhatsApp Hotline
                        </label>
                        <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', setting('contact_whatsapp')) }}"
                               placeholder="+90 532 000 00 00"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Ankara Diplomatic Headquarters Address
                    </label>
                    <textarea name="office_address_ankara" rows="2"
                              class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">{{ old('office_address_ankara', setting('office_address_ankara')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Global Liaison Offices (Dubai, Geneva, etc.)
                    </label>
                    <textarea name="office_address_global" rows="2"
                              class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">{{ old('office_address_global', setting('office_address_global')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Executive Operational Hours
                    </label>
                    <input type="text" name="business_hours" value="{{ old('business_hours', setting('business_hours')) }}"
                           placeholder="Monday – Friday: 08:30 – 18:00 (GMT+3)"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>
            </div>
        </div>

        <!-- Tab 4: Social Channels -->
        <div x-show="activeTab === 'social'" class="space-y-6" style="display: none;">
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Social Media & Public Relations</h3>
                    <p class="text-xs text-slate-500">Institutional profiles and publication channels</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            LinkedIn Company URL
                        </label>
                        <input type="url" name="social_linkedin" value="{{ old('social_linkedin', setting('social_linkedin')) }}"
                               placeholder="https://www.linkedin.com/company/safir-business"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            X (formerly Twitter) URL
                        </label>
                        <input type="url" name="social_twitter" value="{{ old('social_twitter', setting('social_twitter')) }}"
                               placeholder="https://twitter.com/safirbusiness"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Instagram URL
                        </label>
                        <input type="url" name="social_instagram" value="{{ old('social_instagram', setting('social_instagram')) }}"
                               placeholder="https://instagram.com/safirbusiness"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            YouTube Channel URL
                        </label>
                        <input type="url" name="social_youtube" value="{{ old('social_youtube', setting('social_youtube')) }}"
                               placeholder="https://youtube.com/@safirbusiness"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 5: Footer Configuration -->
        <div x-show="activeTab === 'footer'" class="space-y-6" style="display: none;">
            
            <!-- Section 1: Brand & Philosophy Column -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Brand Identity & Signature (Column 1)</h3>
                    <p class="text-xs text-slate-500">Configure brand naming, diplomatic protocol badge, overview narrative, and brand motto</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Footer Brand Name
                        </label>
                        <input type="text" name="footer_brand_title" value="{{ old('footer_brand_title', setting('footer_brand_title', setting('site_name', 'Safir Business Hub'))) }}"
                               placeholder="Safir Business Hub"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Protocol / Location Badge
                        </label>
                        <input type="text" name="footer_badge_text" value="{{ old('footer_badge_text', setting('footer_badge_text', __('safir.location_badge'))) }}"
                               placeholder="Diplomatic & Sovereign Advisory • Ankara HQ"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Footer Overview / Bio Narrative
                    </label>
                    <textarea name="footer_about" rows="3"
                              placeholder="Concise diplomatic and corporate advisory platform overview displayed in footer..."
                              class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">{{ old('footer_about', setting('footer_about', __('safir.footer.about_text'))) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Official Brand Signature / Slogan
                    </label>
                    <input type="text" name="footer_signature" value="{{ old('footer_signature', setting('footer_signature', __('safir.brand_signature'))) }}"
                           placeholder="Empowering Cross-Border Sovereignty & Economic Convergence"
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    <p class="text-[11px] text-slate-500 mt-1">Rendered in elegant italic gold styling in the footer branding column.</p>
                </div>

                <div class="pt-2">
                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                        <input type="hidden" name="footer_show_social" value="0">
                        <input type="checkbox" name="footer_show_social" value="1" {{ old('footer_show_social', setting('footer_show_social', '1')) == '1' ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-slate-300 text-gold-600 focus:ring-gold-500">
                        <span>Display Social Media Channels in Footer (LinkedIn, X, Instagram, YouTube)</span>
                    </label>
                </div>
            </div>

            <!-- Section 2: Navigation Columns Headings -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Navigation Titles (Columns 2 & 3)</h3>
                    <p class="text-xs text-slate-500">Header titles for the core pillars and quick navigation columns</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Column 2 Title (Pillars)
                        </label>
                        <input type="text" name="footer_pillars_title" value="{{ old('footer_pillars_title', setting('footer_pillars_title', __('safir.footer.services_title'))) }}"
                               placeholder="Core Pillars"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Column 3 Title (Quick Links)
                        </label>
                        <input type="text" name="footer_quick_links_title" value="{{ old('footer_quick_links_title', setting('footer_quick_links_title', __('safir.footer.quick_links'))) }}"
                               placeholder="Quick Links"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>
            </div>

            <!-- Section 3: Headquarters & Contact Lines -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Diplomatic Headquarters & Direct Touchpoints (Column 4)</h3>
                    <p class="text-xs text-slate-500">Location address and specialized contact lines displayed in the footer</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Contact Column Title
                        </label>
                        <input type="text" name="footer_hq_title" value="{{ old('footer_hq_title', setting('footer_hq_title', __('safir.footer.contact_title'))) }}"
                               placeholder="Ankara Headquarters"
                               class="w-full max-w-md px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Headquarters Physical Address
                        </label>
                        <textarea name="footer_address" rows="2"
                                  placeholder="Safir Diplomatic Tower, Level 14, Çankaya Diplomatic Quarter, Ankara..."
                                  class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">{{ old('footer_address', setting('footer_address', setting('office_address_ankara', __('safir.contact.address')))) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Protocol Access / Security Clearance Note
                        </label>
                        <input type="text" name="footer_address_note" value="{{ old('footer_address_note', setting('footer_address_note', __('safir.contact.address_note'))) }}"
                               placeholder="Diplomatic appointments strictly by prior protocol clearance."
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Main Phone Line
                        </label>
                        <input type="text" name="footer_phone_main" value="{{ old('footer_phone_main', setting('footer_phone_main', setting('contact_phone', '+90 (312) 439 88 00'))) }}"
                               placeholder="+90 (312) 439 88 00"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Embassies Desk Line
                        </label>
                        <input type="text" name="footer_phone_embassies" value="{{ old('footer_phone_embassies', setting('footer_phone_embassies', '+90 312 000 00 01')) }}"
                               placeholder="+90 (312) 439 88 01"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Investors Desk Line
                        </label>
                        <input type="text" name="footer_phone_investors" value="{{ old('footer_phone_investors', setting('footer_phone_investors', '+90 312 000 00 02')) }}"
                               placeholder="+90 (312) 439 88 02"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>
            </div>

            <!-- Section 4: Bottom Legal & Copyright Notice -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Legal, Copyright & Compliance (Bottom Bar)</h3>
                    <p class="text-xs text-slate-500">Manage copyright ownership statement and regulatory policy links</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Copyright Notice
                    </label>
                    <input type="text" name="footer_copyright" value="{{ old('footer_copyright', setting('footer_copyright', '© ' . date('Y') . ' ' . setting('site_name', 'Safir Business Hub') . '. ' . __('safir.footer.rights'))) }}"
                           placeholder="© 2026 Safir Business Hub. All rights reserved."
                           class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Privacy Policy Label
                        </label>
                        <input type="text" name="footer_privacy_text" value="{{ old('footer_privacy_text', setting('footer_privacy_text', __('safir.footer.privacy'))) }}"
                               placeholder="Privacy Policy & Data Protection"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Terms of Service Label
                        </label>
                        <input type="text" name="footer_terms_text" value="{{ old('footer_terms_text', setting('footer_terms_text', __('safir.footer.terms'))) }}"
                               placeholder="Terms of Advisory Service"
                               class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                    </div>
                </div>
            </div>

        </div>

        <!-- Tab 6: Scripts & Analytics -->
        <div x-show="activeTab === 'scripts'" class="space-y-6" style="display: none;">
            <div class="bg-white border border-slate-200/90 rounded-2xl p-7 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900">Telemetry & External Embeds</h3>
                    <p class="text-xs text-slate-500">Custom header scripts, tracking tags, and analytics IDs</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Google Analytics Measurement ID
                    </label>
                    <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', setting('google_analytics_id')) }}"
                           placeholder="G-XXXXXXXXXX"
                           class="w-full max-w-xs px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-gold-500 focus:ring-1 focus:ring-gold-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Custom &lt;head&gt; Scripts
                    </label>
                    <textarea name="custom_header_scripts" rows="4" placeholder="<!-- Header tracking tags, Google Tag Manager, custom font links -->"
                              class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-800 placeholder-slate-400 text-xs font-mono focus:outline-none focus:bg-white focus:border-gold-500">{{ old('custom_header_scripts', setting('custom_header_scripts')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Custom &lt;footer&gt; Scripts
                    </label>
                    <textarea name="custom_footer_scripts" rows="4" placeholder="<!-- External chat widgets, body analytics tags -->"
                              class="w-full px-4 py-2.5 bg-slate-50/60 border border-slate-300 rounded-xl text-slate-800 placeholder-slate-400 text-xs font-mono focus:outline-none focus:bg-white focus:border-gold-500">{{ old('custom_footer_scripts', setting('custom_footer_scripts')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Sticky Save Button Bar -->
        <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
            <span class="text-xs text-slate-500">
                Changes apply instantly across public and administrative portals.
            </span>
            <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-gold-500 via-gold-400 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-xs shadow-md shadow-gold-500/20 transition-all transform active:scale-95 cursor-pointer">
                Save Website Settings
            </button>
        </div>
    </form>

</div>
@endsection
