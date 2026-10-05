<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Root redirect to preferred or default locale
Route::get('/', function (Request $request) {
    $locale = session('locale');
    if (!$locale || !in_array($locale, ['ar', 'en', 'tr'], true)) {
        $preferred = $request->getPreferredLanguage(['ar', 'en', 'tr']);
        $locale = $preferred ?: 'ar';
    }
    return redirect("/{$locale}");
});

// Locale switcher
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Global actions (Inquiries and Newsletter subscriptions)
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::post('/subscribers', [SubscriberController::class, 'store'])->name('subscribers.store');

// Multilingual Routes Group
Route::prefix('{locale}')->where(['locale' => 'ar|en|tr'])->group(function () {
    // 1. Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // 2. Dedicated Pillars & Landing Pages
    Route::get('/embassies', [LandingController::class, 'embassies'])->name('embassies');
    Route::get('/corporates', [LandingController::class, 'corporates'])->name('corporates');

    // 3. Four Pillars & Services
    Route::get('/services', [LandingController::class, 'services'])->name('services.index');
    Route::get('/services/{pillar}', [LandingController::class, 'services'])->name('services.pillar');

    // 4. Research & Reports Center
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{slug}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{slug}/download', [ReportController::class, 'download'])->name('reports.download');

    // 5. Weekly Bulletin Archive
    Route::get('/bulletin', [LandingController::class, 'bulletin'])->name('bulletin');

    // 6. About & Ecosystem
    Route::get('/about', [LandingController::class, 'about'])->name('about');

    // 7. Contact Us & Ankara Office
    Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
});
