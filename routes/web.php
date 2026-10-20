<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// XML Sitemap for Search Engines
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');

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

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

// Protected Admin Hub
Route::prefix('admin')->name('admin.')->middleware(['auth', 'active'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Users Module (Superadmin, Admin)
    Route::middleware('role:superadmin,admin')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    // Website Settings Module (Superadmin, Admin)
    Route::middleware('role:superadmin,admin')->group(function () {
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });

    // Pages Module (Superadmin, Admin)
    Route::middleware('role:superadmin,admin')->group(function () {
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::patch('/pages/{page}/toggle', [\App\Http\Controllers\Admin\PageController::class, 'toggle'])->name('pages.toggle');
    });

    // Menus Module (Superadmin, Admin)
    Route::middleware('role:superadmin,admin')->group(function () {
        Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
        Route::post('/menus/{menu}/items', [\App\Http\Controllers\Admin\MenuItemController::class, 'store'])->name('menus.items.store');
        Route::put('/menus/{menu}/items/{item}', [\App\Http\Controllers\Admin\MenuItemController::class, 'update'])->name('menus.items.update');
        Route::delete('/menus/{menu}/items/{item}', [\App\Http\Controllers\Admin\MenuItemController::class, 'destroy'])->name('menus.items.destroy');
        Route::post('/menus/{menu}/reorder', [\App\Http\Controllers\Admin\MenuItemController::class, 'reorder'])->name('menus.reorder');
    });
});

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
    Route::get('/about-us', [LandingController::class, 'about'])->name('about.alias');

    // 7. Contact Us & Ankara Office
    Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
    Route::get('/contact-us', [LandingController::class, 'contact'])->name('contact.alias');

    // 8. Dynamic Pages
    Route::get('/page/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');
});
