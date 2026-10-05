<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('localized_url')) {
    /**
     * Generate localized URL for a target locale while preserving path and query string.
     */
    function localized_url(string $targetLocale, ?string $url = null): string
    {
        $currentPath = $url ?: Request::path();
        $segments = explode('/', trim($currentPath, '/'));

        $supported = ['ar', 'en', 'tr'];

        if (!empty($segments[0]) && in_array($segments[0], $supported, true)) {
            $segments[0] = $targetLocale;
        } else {
            array_unshift($segments, $targetLocale);
        }

        $newPath = implode('/', $segments);
        $query = Request::getQueryString();

        return url($newPath) . ($query ? '?' . $query : '');
    }
}

if (!function_exists('route_ml')) {
    /**
     * Generate a URL for a named route prepended with the active locale.
     */
    function route_ml(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        $locale = app()->getLocale();

        if (!is_array($parameters)) {
            if (str_contains($name, 'pillar')) {
                $parameters = ['pillar' => $parameters];
            } elseif (str_contains($name, 'reports.show') || str_contains($name, 'reports.download')) {
                $parameters = ['slug' => $parameters];
            } else {
                $parameters = [$parameters];
            }
        }

        $parameters['locale'] = $locale;

        return route($name, $parameters, $absolute);
    }
}

if (!function_exists('is_rtl')) {
    /**
     * Check if the current locale is RTL.
     */
    function is_rtl(): bool
    {
        return app()->getLocale() === 'ar';
    }
}

if (!function_exists('setting')) {
    /**
     * Retrieve a website setting value by key.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return \App\Models\Setting::get($key, $default);
    }
}

