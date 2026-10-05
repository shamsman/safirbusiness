<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        $supported = ['ar', 'en', 'tr'];

        if (!in_array($locale, $supported, true)) {
            $locale = 'ar';
        }

        Session::put('locale', $locale);

        $previousUrl = url()->previous();
        $targetUrl = localized_url($locale, parse_url($previousUrl, PHP_URL_PATH) ?: "/{$locale}");

        return redirect($targetUrl);
    }
}
