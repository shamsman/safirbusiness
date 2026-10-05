<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\Report;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredReports = Report::where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_date', 'desc')
            ->take(3)
            ->get();

        $latestBulletin = Bulletin::where('is_published', true)
            ->orderBy('published_date', 'desc')
            ->first();

        $servicesByPillar = Service::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('pillar_key');

        return view('pages.home', compact('featuredReports', 'latestBulletin', 'servicesByPillar'));
    }
}
