<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a published custom page by slug.
     */
    public function show(string $locale, string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        if ($page->template === 'about' || $slug === 'about' || $slug === 'about-us') {
            return view('pages.about', compact('page'));
        }

        if ($page->template === 'embassies' || $slug === 'embassies') {
            return app(LandingController::class)->embassies();
        }

        if ($page->template === 'corporates' || $slug === 'corporates') {
            return app(LandingController::class)->corporates();
        }

        if ($page->template === 'contact' || $slug === 'contact') {
            return app(LandingController::class)->contact();
        }

        return view('pages.show', compact('page'));
    }
}
