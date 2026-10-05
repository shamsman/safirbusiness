<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display settings page with groups.
     */
    public function index(Request $request): View
    {
        $settings = Setting::all()->groupBy('group');
        $activeTab = $request->query('tab', 'general');

        return view('admin.settings.index', compact('settings', 'activeTab'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $activeTab = $request->input('active_tab', 'general');

        $request->validate([
            'site_name'             => ['nullable', 'string', 'max:150'],
            'site_tagline'          => ['nullable', 'string', 'max:255'],
            'site_description'      => ['nullable', 'string'],
            'default_currency'      => ['nullable', 'string', 'max:20'],
            'contact_email'         => ['nullable', 'email', 'max:150'],
            'support_email'         => ['nullable', 'email', 'max:150'],
            'contact_phone'         => ['nullable', 'string', 'max:50'],
            'contact_whatsapp'      => ['nullable', 'string', 'max:50'],
            'office_address_ankara' => ['nullable', 'string'],
            'office_address_global' => ['nullable', 'string'],
            'business_hours'        => ['nullable', 'string', 'max:150'],
            'social_linkedin'       => ['nullable', 'url', 'max:255'],
            'social_twitter'        => ['nullable', 'url', 'max:255'],
            'social_instagram'      => ['nullable', 'url', 'max:255'],
            'social_youtube'        => ['nullable', 'url', 'max:255'],
            'google_analytics_id'   => ['nullable', 'string', 'max:50'],
            'custom_header_scripts' => ['nullable', 'string'],
            'custom_footer_scripts' => ['nullable', 'string'],
            'site_logo'             => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:3072'],
            'site_favicon'          => ['nullable', 'image', 'mimes:png,ico,svg', 'max:1024'],

            // Footer
            'footer_brand_title'       => ['nullable', 'string', 'max:150'],
            'footer_badge_text'        => ['nullable', 'string', 'max:150'],
            'footer_about'             => ['nullable', 'string'],
            'footer_signature'         => ['nullable', 'string', 'max:255'],
            'footer_pillars_title'     => ['nullable', 'string', 'max:100'],
            'footer_quick_links_title' => ['nullable', 'string', 'max:100'],
            'footer_hq_title'          => ['nullable', 'string', 'max:100'],
            'footer_address'           => ['nullable', 'string'],
            'footer_address_note'      => ['nullable', 'string', 'max:255'],
            'footer_phone_main'        => ['nullable', 'string', 'max:50'],
            'footer_phone_embassies'   => ['nullable', 'string', 'max:50'],
            'footer_phone_investors'   => ['nullable', 'string', 'max:50'],
            'footer_copyright'         => ['nullable', 'string', 'max:255'],
            'footer_privacy_text'      => ['nullable', 'string', 'max:150'],
            'footer_terms_text'        => ['nullable', 'string', 'max:150'],
            'footer_show_social'       => ['nullable', 'in:0,1'],
        ]);

        // Key-to-group mapping
        $groups = [
            'site_name'             => 'general',
            'site_tagline'          => 'general',
            'site_description'      => 'general',
            'default_currency'      => 'general',
            'contact_email'         => 'contact',
            'support_email'         => 'contact',
            'contact_phone'         => 'contact',
            'contact_whatsapp'      => 'contact',
            'office_address_ankara' => 'contact',
            'office_address_global' => 'contact',
            'business_hours'        => 'contact',
            'social_linkedin'       => 'social',
            'social_twitter'        => 'social',
            'social_instagram'      => 'social',
            'social_youtube'        => 'social',
            'google_analytics_id'   => 'scripts',
            'custom_header_scripts' => 'scripts',
            'custom_footer_scripts' => 'scripts',

            // Footer settings
            'footer_brand_title'       => 'footer',
            'footer_badge_text'        => 'footer',
            'footer_about'             => 'footer',
            'footer_signature'         => 'footer',
            'footer_pillars_title'     => 'footer',
            'footer_quick_links_title' => 'footer',
            'footer_hq_title'          => 'footer',
            'footer_address'           => 'footer',
            'footer_address_note'      => 'footer',
            'footer_phone_main'        => 'footer',
            'footer_phone_embassies'   => 'footer',
            'footer_phone_investors'   => 'footer',
            'footer_copyright'         => 'footer',
            'footer_privacy_text'      => 'footer',
            'footer_terms_text'        => 'footer',
            'footer_show_social'       => 'footer',
        ];

        // Handle text fields
        foreach ($groups as $key => $group) {
            if ($request->has($key)) {
                $val = $request->input($key, '');
                Setting::set($key, $val, $group, is_string($val) && strlen($val) > 200 ? 'text' : 'string');
            }
        }

        // Keep single phone number unified across contact and footer settings
        if ($request->filled('footer_phone_main')) {
            Setting::set('contact_phone', $request->input('footer_phone_main'), 'contact');
        } elseif ($request->filled('contact_phone')) {
            Setting::set('footer_phone_main', $request->input('contact_phone'), 'footer');
        }

        // Handle Logo Upload
        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('site_logo')->store('branding', 'public');
            Setting::set('site_logo', $path, 'branding', 'file');
        } elseif ($request->boolean('remove_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            Setting::set('site_logo', '', 'branding', 'file');
        }

        // Handle Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            $path = $request->file('site_favicon')->store('branding', 'public');
            Setting::set('site_favicon', $path, 'branding', 'file');
        } elseif ($request->boolean('remove_favicon')) {
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            Setting::set('site_favicon', '', 'branding', 'file');
        }

        Setting::clearCache();

        return redirect()->route('admin.settings.index', ['tab' => $activeTab])
            ->with('status', 'Website configuration successfully updated.');
    }
}
