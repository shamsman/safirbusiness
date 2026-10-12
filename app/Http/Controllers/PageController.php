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

        if ($page->template === 'about') {
            return view('pages.about', compact('page'));
        }

        return view('pages.show', compact('page'));
    }
}
