<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Report;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public const LOCALES = ['ar', 'en', 'tr'];
    public const DEFAULT_LOCALE = 'en';
    public const CANONICAL_URL = 'https://safirbusinesshub.com';
    public const CACHE_KEY = 'safir_sitemap_xml_v3';
    public const CACHE_TTL = 3600; // 1 hour

    /**
     * Render the XML sitemap.
     */
    public function index(): Response
    {
        // Don't cache in local debug environment to make testing immediate
        if (config('app.debug')) {
            Cache::forget(self::CACHE_KEY);
        }

        $xml = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $entries = $this->buildEntries();
            $body = view('sitemap', ['entries' => $entries])->render();

            return '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
                . '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>' . "\n"
                . trim($body);
        });

        return response($xml, 200, [
            'Content-Type'  => 'text/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=' . self::CACHE_TTL . ', s-maxage=' . self::CACHE_TTL . ', stale-while-revalidate=86400',
        ]);
    }

    /**
     * Build all URLs and hreflang alternates for the sitemap.
     */
    private function buildEntries(): array
    {
        $entries = [];

        // 1. Static / Core Landing Pages
        foreach ($this->staticRoutes() as $route) {
            foreach (self::LOCALES as $locale) {
                $entries[] = $this->makeEntry(
                    path:       $route['path'],
                    locale:     $locale,
                    changefreq: $route['changefreq'],
                    priority:   $route['priority'],
                    lastmod:    now()
                );
            }
        }

        // 2. Dynamic Published Reports
        try {
            $reports = Report::where('is_active', true)->get();
            foreach ($reports as $report) {
                if (empty($report->slug)) {
                    continue;
                }

                $lastmod = $report->updated_at ?? $report->published_date ?? now();

                foreach (self::LOCALES as $locale) {
                    $entries[] = $this->makeEntry(
                        path:       'reports/' . $report->slug,
                        locale:     $locale,
                        changefreq: 'monthly',
                        priority:   '0.8',
                        lastmod:    $lastmod
                    );
                }
            }
        } catch (\Throwable $e) {
            // Gracefully handle if DB table is unavailable
        }

        // 3. Dynamic Published Pages (custom pages)
        try {
            $reservedSlugs = [
                'about', 'about-us', 'embassies', 'corporates', 
                'contact', 'contact-us', 'reports', 'bulletin', 'services'
            ];

            $pages = Page::published()->get();
            foreach ($pages as $page) {
                if (empty($page->slug) || in_array($page->slug, $reservedSlugs, true)) {
                    continue;
                }

                $lastmod = $page->updated_at ?? $page->created_at ?? now();

                foreach (self::LOCALES as $locale) {
                    $entries[] = $this->makeEntry(
                        path:       'page/' . $page->slug,
                        locale:     $locale,
                        changefreq: 'monthly',
                        priority:   '0.7',
                        lastmod:    $lastmod
                    );
                }
            }
        } catch (\Throwable $e) {
            // Gracefully handle if DB table is unavailable
        }

        return $entries;
    }

    /**
     * Define static routes and their metadata.
     */
    private function staticRoutes(): array
    {
        return [
            ['path' => '',                   'changefreq' => 'daily',   'priority' => '1.0'],
            ['path' => 'embassies',          'changefreq' => 'weekly',  'priority' => '0.9'],
            ['path' => 'corporates',         'changefreq' => 'weekly',  'priority' => '0.9'],
            ['path' => 'services',           'changefreq' => 'weekly',  'priority' => '0.8'],
            ['path' => 'services/economy',   'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => 'services/relations', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => 'services/events',    'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => 'services/community', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => 'reports',            'changefreq' => 'daily',   'priority' => '0.9'],
            ['path' => 'bulletin',           'changefreq' => 'weekly',  'priority' => '0.8'],
            ['path' => 'about',              'changefreq' => 'monthly', 'priority' => '0.7'],
            ['path' => 'contact',            'changefreq' => 'monthly', 'priority' => '0.7'],
        ];
    }

    /**
     * Construct an individual sitemap entry with hreflang alternate links.
     */
    private function makeEntry(
        string $path,
        string $locale,
        string $changefreq,
        string $priority,
        ?DateTimeInterface $lastmod = null
    ): array {
        $alternates = [];

        foreach (self::LOCALES as $altLocale) {
            $alternates[] = [
                'hreflang' => $altLocale,
                'href'     => $this->urlFor($path, $altLocale),
            ];
        }

        // Google recommended x-default fallback
        $alternates[] = [
            'hreflang' => 'x-default',
            'href'     => $this->urlFor($path, self::DEFAULT_LOCALE),
        ];

        return [
            'loc'        => $this->urlFor($path, $locale),
            'lastmod'    => ($lastmod instanceof Carbon ? $lastmod : Carbon::parse($lastmod ?? now()))->toAtomString(),
            'changefreq' => $changefreq,
            'priority'   => $priority,
            'alternates' => $alternates,
        ];
    }

    /**
     * Build an absolute URL for a path and locale.
     */
    private function urlFor(string $path, string $locale): string
    {
        $path = trim($path, '/');
        $base = $this->getBaseUrl();

        return $path === ''
            ? "{$base}/{$locale}"
            : "{$base}/{$locale}/{$path}";
    }

    /**
     * Strictly return the canonical production domain (https://safirbusinesshub.com).
     * Never output internal Cloud Run URLs (*.a.run.app) into the sitemap.
     */
    private function getBaseUrl(): string
    {
        return self::CANONICAL_URL;
    }
}
