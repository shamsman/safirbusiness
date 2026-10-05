<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\Report;
use App\Models\Service;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function embassies()
    {
        $diplomaticServices = Service::where('pillar_key', 'relations')
            ->orWhere('slug', 'consular-support-services')
            ->orWhere('slug', 'conferences-official-events')
            ->get();

        $diplomaticReports = Report::whereIn('category', ['diplomacy', 'procurement', 'macro_markets'])
            ->take(3)
            ->get();

        return view('pages.embassies', compact('diplomaticServices', 'diplomaticReports'));
    }

    public function corporates()
    {
        $corporateServices = Service::where('pillar_key', 'relations')
            ->orWhere('pillar_key', 'economy')
            ->get();

        $corporateReports = Report::whereIn('category', ['incentives', 'free_zones', 'macro_markets', 'defence'])
            ->take(3)
            ->get();

        return view('pages.corporates', compact('corporateServices', 'corporateReports'));
    }

    public function services(?string $locale = null, ?string $pillar = null)
    {
        $query = Service::where('is_active', true)->orderBy('sort_order', 'asc');

        if ($pillar && in_array($pillar, ['economy', 'relations', 'events', 'community'], true)) {
            $services = $query->where('pillar_key', $pillar)->get();
            $activePillar = $pillar;
        } else {
            $services = $query->get()->groupBy('pillar_key');
            $activePillar = 'all';
        }

        return view('pages.services', compact('services', 'activePillar'));
    }

    public function bulletin()
    {
        $bulletins = Bulletin::where('is_published', true)
            ->orderBy('published_date', 'desc')
            ->paginate(6);

        return view('pages.bulletin', compact('bulletins'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
