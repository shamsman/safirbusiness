<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('q');

        $query = Report::where('is_active', true);

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $reports = $query->orderBy('published_date', 'desc')->paginate(9)->withQueryString();

        $categories = [
            'macro_markets' => [
                'en' => 'Macro & Markets',
                'ar' => 'الاقتصاد الكلي والأسواق',
                'tr' => 'Makroekonomi ve Piyasalar',
            ],
            'logistics' => [
                'en' => 'Logistics, Corridors & Infrastructure',
                'ar' => 'اللوجستيات والممرات والبنية التحتية',
                'tr' => 'Lojistik, Koridorlar ve Altyapı',
            ],
            'incentives' => [
                'en' => 'Investment & Incentives',
                'ar' => 'الاستثمار والحوافز',
                'tr' => 'Yatırım ve Teşvikler',
            ],
            'defence' => [
                'en' => 'Defence & Advanced Industry',
                'ar' => 'الصناعات الدفاعية والمتقدمة',
                'tr' => 'Savunma ve İleri Sanayi',
            ],
            'procurement' => [
                'en' => 'Trade & Regulation',
                'ar' => 'التجارة والتشريعات',
                'tr' => 'Ticaret ve Mevzuat',
            ],
            'diplomacy' => [
                'en' => 'Diplomacy & Policy',
                'ar' => 'الدبلوماسية والسياسات',
                'tr' => 'Diplomasi ve Politika',
            ],
            'free_zones' => [
                'en' => 'Free Zones & Industrial Parks',
                'ar' => 'المناطق الحرة والمدن الصناعية',
                'tr' => 'Serbest Bölgeler ve OSB\'ler',
            ],
        ];

        $latestBulletins = Bulletin::where('is_published', true)
            ->orderBy('published_date', 'desc')
            ->take(3)
            ->get();

        return view('pages.reports.index', compact('reports', 'categories', 'category', 'search', 'latestBulletins'));
    }

    public function show(string $locale, string $slug)
    {
        $report = Report::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $relatedReports = Report::where('is_active', true)
            ->where('id', '!=', $report->id)
            ->where('category', $report->category)
            ->take(3)
            ->get();

        if ($relatedReports->isEmpty()) {
            $relatedReports = Report::where('is_active', true)
                ->where('id', '!=', $report->id)
                ->take(3)
                ->get();
        }

        return view('pages.reports.show', compact('report', 'relatedReports'));
    }

    public function download(string $locale, string $slug)
    {
        $report = Report::where('slug', $slug)->firstOrFail();
        $report->increment('downloads_count');

        // Provide a formatted briefing download text/markdown response if no physical PDF exists yet
        $title = $report->getLocalized('title', $locale);
        $summary = $report->getLocalized('summary', $locale);
        $date = $report->published_date->format('Y-m-d');

        $content = "SAFIR BUSINESS HUB — ANKARA DIPLOMATIC & CORPORATE ADVISORY\n";
        $content .= "Intelligence Briefing: {$title}\n";
        $content .= "Category: {$report->category_name} | Date: {$date} | Read Time: {$report->read_time}\n";
        $content .= str_repeat("=", 70) . "\n\n";
        $content .= "EXECUTIVE SUMMARY:\n{$summary}\n\n";
        $content .= "BRIEFING DETAILS:\n" . strip_tags($report->getLocalized('content', $locale)) . "\n\n";
        $content .= str_repeat("-", 70) . "\n";
        $content .= "Safir Business Hub, Kizilirmak Mah., Sogutozu, Cankaya, 06510 Ankara, Turkiye\n";
        $content .= "Contact: hello@safirbusinesshub.com | www.safirbusinesshub.com\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"safir-briefing-{$slug}-{$locale}.txt\"",
        ]);
    }
}
