<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            [
                'key'   => 'site_name',
                'value' => 'Safir Business Hub',
                'group' => 'general',
                'type'  => 'string',
            ],
            [
                'key'   => 'site_tagline',
                'value' => 'Diplomatic Economic Gateway & Strategic Market Entry',
                'group' => 'general',
                'type'  => 'string',
            ],
            [
                'key'   => 'site_description',
                'value' => 'Empowering embassies, sovereign delegations, and multinational enterprises navigating Turkish and global cross-border ventures.',
                'group' => 'general',
                'type'  => 'text',
            ],
            [
                'key'   => 'default_currency',
                'value' => 'USD ($)',
                'group' => 'general',
                'type'  => 'string',
            ],

            // Branding
            [
                'key'   => 'site_logo',
                'value' => '', // Empty uses default SVG luxury emblem
                'group' => 'branding',
                'type'  => 'file',
            ],
            [
                'key'   => 'site_favicon',
                'value' => '',
                'group' => 'branding',
                'type'  => 'file',
            ],

            // Contact & Offices
            [
                'key'   => 'contact_email',
                'value' => 'contact@safirbusiness.com',
                'group' => 'contact',
                'type'  => 'string',
            ],
            [
                'key'   => 'support_email',
                'value' => 'intelligence@safirbusiness.com',
                'group' => 'contact',
                'type'  => 'string',
            ],
            [
                'key'   => 'contact_phone',
                'value' => '+90 (312) 439 88 00',
                'group' => 'contact',
                'type'  => 'string',
            ],
            [
                'key'   => 'contact_whatsapp',
                'value' => '+90 532 000 00 00',
                'group' => 'contact',
                'type'  => 'string',
            ],
            [
                'key'   => 'office_address_ankara',
                'value' => 'Safir Diplomatic Tower, Level 14, Çankaya Diplomatic Quarter, Ankara, Republic of Türkiye',
                'group' => 'contact',
                'type'  => 'text',
            ],
            [
                'key'   => 'office_address_global',
                'value' => 'DIFC Gate Precinct 4, Dubai, UAE & Geneva Liaison Office, Switzerland',
                'group' => 'contact',
                'type'  => 'text',
            ],
            [
                'key'   => 'business_hours',
                'value' => 'Monday – Friday: 08:30 – 18:00 (GMT+3)',
                'group' => 'contact',
                'type'  => 'string',
            ],

            // Social Media
            [
                'key'   => 'social_linkedin',
                'value' => 'https://www.linkedin.com/company/safir-business',
                'group' => 'social',
                'type'  => 'string',
            ],
            [
                'key'   => 'social_twitter',
                'value' => 'https://twitter.com/safirbusiness',
                'group' => 'social',
                'type'  => 'string',
            ],
            [
                'key'   => 'social_instagram',
                'value' => 'https://instagram.com/safirbusiness',
                'group' => 'social',
                'type'  => 'string',
            ],
            [
                'key'   => 'social_youtube',
                'value' => 'https://youtube.com/@safirbusiness',
                'group' => 'social',
                'type'  => 'string',
            ],

            // Scripts & Integrations
            [
                'key'   => 'custom_header_scripts',
                'value' => '',
                'group' => 'scripts',
                'type'  => 'text',
            ],
            [
                'key'   => 'custom_footer_scripts',
                'value' => '',
                'group' => 'scripts',
                'type'  => 'text',
            ],
            [
                'key'   => 'google_analytics_id',
                'value' => 'G-SAFIRBIZ2026',
                'group' => 'scripts',
                'type'  => 'string',
            ],

            // Footer Configuration & Legal
            [
                'key'   => 'footer_brand_title',
                'value' => 'Safir Business Hub',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_badge_text',
                'value' => 'Diplomatic & Sovereign Advisory • Ankara HQ',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_about',
                'value' => 'Safir Business Hub is Ankara’s specialized corporate and diplomatic advisory platform, bridging economic intelligence, institutional relations, and ground execution across Türkiye.',
                'group' => 'footer',
                'type'  => 'text',
            ],
            [
                'key'   => 'footer_signature',
                'value' => 'Empowering Cross-Border Sovereignty & Economic Convergence',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_pillars_title',
                'value' => 'Core Pillars',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_quick_links_title',
                'value' => 'Quick Links',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_hq_title',
                'value' => 'Ankara Headquarters',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_address',
                'value' => 'Safir Diplomatic Tower, Level 14, Çankaya Diplomatic Quarter, Ankara, Republic of Türkiye',
                'group' => 'footer',
                'type'  => 'text',
            ],
            [
                'key'   => 'footer_address_note',
                'value' => 'Diplomatic appointments strictly by prior protocol clearance.',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_phone_main',
                'value' => '+90 (312) 439 88 00',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_phone_embassies',
                'value' => '+90 (312) 439 88 01',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_phone_investors',
                'value' => '+90 (312) 439 88 02',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_copyright',
                'value' => '© 2026 Safir Business Hub. All rights reserved.',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_privacy_text',
                'value' => 'Privacy Policy & Data Protection',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_terms_text',
                'value' => 'Terms of Advisory Service',
                'group' => 'footer',
                'type'  => 'string',
            ],
            [
                'key'   => 'footer_show_social',
                'value' => '1',
                'group' => 'footer',
                'type'  => 'string',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'group' => $setting['group'],
                    'type'  => $setting['type'],
                ]
            );
        }

        Setting::clearCache();
    }
}
