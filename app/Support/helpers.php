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

if (!function_exists('site_address')) {
    /**
     * Retrieve the institutional headquarters address from settings.
     */
    function site_address(?string $default = null): string
    {
        $val = setting('office_address_ankara') ?: setting('footer_address');
        return !empty($val) ? (string) $val : (string) ($default ?? __('safir.contact.address'));
    }
}

if (!function_exists('media_disk')) {
    /**
     * Get the configured media storage disk.
     */
    function media_disk(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        return \Illuminate\Support\Facades\Storage::disk(config('filesystems.default', 'gcs'));
    }
}

if (!function_exists('media_url')) {
    /**
     * Generate the public URL for an uploaded media asset.
     */
    function media_url(?string $path, ?string $default = null): ?string
    {
        if (empty($path)) {
            return $default;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        try {
            // First check default disk (GCS)
            if (\Illuminate\Support\Facades\Storage::exists($path)) {
                return \Illuminate\Support\Facades\Storage::url($path);
            }

            // Fallback check on public disk for legacy local uploads
            if (config('filesystems.default') !== 'public' && \Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                /** @var \Illuminate\Filesystem\FilesystemAdapter $publicDisk */
                $publicDisk = \Illuminate\Support\Facades\Storage::disk('public');
                return $publicDisk->url($path);
            }

            return \Illuminate\Support\Facades\Storage::url($path);
        } catch (\Throwable $e) {
            return $default ?: $path;
        }
    }
}

