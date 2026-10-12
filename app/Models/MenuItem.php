<?php

namespace App\Models;

use App\Models\Traits\HasMultilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory, HasMultilingualFields;

    protected $fillable = [
        'menu_id',
        'parent_id',
        'label',
        'type',
        'url',
        'route_name',
        'page_id',
        'target',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'label' => 'array',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order', 'asc');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function getLabelTextAttribute(): string
    {
        return $this->getLocalized('label') ?: '';
    }

    /**
     * Resolve the target URL according to type and current locale.
     */
    public function resolveUrl(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();

        if ($this->type === 'page') {
            $page = $this->page ?: ($this->page_id ? Page::find($this->page_id) : null);
            if ($page) {
                return $page->url($locale);
            }
        }

        if ($this->type === 'route' && $this->route_name) {
            try {
                if (\Illuminate\Support\Facades\Route::has($this->route_name)) {
                    return route_ml($this->route_name);
                }
            } catch (\Throwable $e) {
                // fallback
            }
        }

        if (!empty($this->url)) {
            if (str_starts_with($this->url, 'http://') || str_starts_with($this->url, 'https://') || str_starts_with($this->url, '#')) {
                return $this->url;
            }
            // If relative internal path like '/services' or '/about'
            $cleanUrl = ltrim($this->url, '/');
            return url("/{$locale}/" . $cleanUrl);
        }

        return '#';
    }

    /**
     * Determine if this menu item or any of its children corresponds to the current page.
     */
    public function isActive(?string $locale = null): bool
    {
        $locale = $locale ?: app()->getLocale();

        if ($this->type === 'page') {
            $page = $this->page ?: ($this->page_id ? Page::find($this->page_id) : null);
            if ($page) {
                if (request()->routeIs('pages.show') && request()->route('slug') === $page->slug) {
                    return true;
                }
                if ($page->slug === 'about' && request()->routeIs('about')) {
                    return true;
                }
                if ($page->slug === 'embassies' && request()->routeIs('embassies')) {
                    return true;
                }
                if ($page->slug === 'corporates' && request()->routeIs('corporates')) {
                    return true;
                }
                if (($page->slug === 'contact' || $page->slug === 'contact-us') && request()->routeIs('contact')) {
                    return true;
                }
                if ($page->slug === 'reports' && request()->routeIs('reports.*')) {
                    return true;
                }
                if ($page->slug === 'bulletin' && request()->routeIs('bulletin')) {
                    return true;
                }
                if ($page->slug === 'services' && request()->routeIs('services.*')) {
                    return true;
                }
            }
        }

        if ($this->type === 'route' && $this->route_name) {
            if (request()->routeIs($this->route_name) || request()->routeIs($this->route_name . '.*')) {
                return true;
            }
        }

        if (!empty($this->url) && $this->url !== '#' && $this->url !== '/') {
            $targetUrl = $this->resolveUrl($locale);
            $currentUrl = request()->url();
            if (rtrim($currentUrl, '/') === rtrim($targetUrl, '/')) {
                return true;
            }
        }

        // Check if any child item is active
        if ($this->relationLoaded('children') && $this->children->isNotEmpty()) {
            foreach ($this->children as $child) {
                if ($child->isActive($locale)) {
                    return true;
                }
            }
        }

        return false;
    }
}
