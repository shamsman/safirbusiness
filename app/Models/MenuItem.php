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

        if ($this->type === 'page' && $this->page) {
            return $this->page->url($locale);
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
}
