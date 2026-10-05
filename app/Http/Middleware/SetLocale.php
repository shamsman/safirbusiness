<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported application locales.
     */
    public const SUPPORTED_LOCALES = ['ar', 'en', 'tr'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeLocale = $request->route('locale');

        if ($routeLocale && in_array($routeLocale, self::SUPPORTED_LOCALES, true)) {
            $locale = $routeLocale;
            Session::put('locale', $locale);
        } elseif (Session::has('locale') && in_array(Session::get('locale'), self::SUPPORTED_LOCALES, true)) {
            $locale = Session::get('locale');
        } else {
            // Check browser preference or default to Arabic (or English)
            $browserPreferred = $request->getPreferredLanguage(self::SUPPORTED_LOCALES);
            $locale = in_array($browserPreferred, self::SUPPORTED_LOCALES, true) ? $browserPreferred : 'ar';
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        $isRtl = ($locale === 'ar');
        $localeLabels = [
            'ar' => [
                'name' => 'العربية',
                'native' => 'العربية',
                'dir' => 'rtl',
                'flag' => '🇸🇦',
                'code' => 'AR',
            ],
            'en' => [
                'name' => 'English',
                'native' => 'English',
                'dir' => 'ltr',
                'flag' => '🇬🇧',
                'code' => 'EN',
            ],
            'tr' => [
                'name' => 'Türkçe',
                'native' => 'Türkçe',
                'dir' => 'ltr',
                'flag' => '🇹🇷',
                'code' => 'TR',
            ],
        ];

        View::share('currentLocale', $locale);
        View::share('isRtl', $isRtl);
        View::share('localeLabels', $localeLabels);
        View::share('supportedLocales', self::SUPPORTED_LOCALES);

        return $next($request);
    }
}
