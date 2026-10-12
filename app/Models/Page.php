<?php

namespace App\Models;

use App\Models\Traits\HasMultilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, HasMultilingualFields;

    protected $fillable = [
        'slug',
        'template',
        'title',
        'summary',
        'content',
        'blocks',
        'meta_title',
        'meta_description',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'content' => 'array',
        'blocks' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getTitleTextAttribute(): string
    {
        return $this->getLocalized('title') ?: ($this->slug ?? 'Page');
    }

    public function getSummaryTextAttribute(): ?string
    {
        return $this->getLocalized('summary');
    }

    public function getContentHtmlAttribute(): ?string
    {
        return $this->getLocalized('content');
    }

    public function getMetaTitleTextAttribute(): ?string
    {
        return $this->getLocalized('meta_title') ?: $this->getTitleTextAttribute();
    }

    public function getMetaDescriptionTextAttribute(): ?string
    {
        return $this->getLocalized('meta_description') ?: $this->getSummaryTextAttribute();
    }

    /**
     * Generate localized public URL.
     */
    public function url(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        if ($this->slug === 'about' || $this->slug === 'about-us') {
            return route_ml('about');
        }
        return route('pages.show', ['locale' => $locale, 'slug' => $this->slug]);
    }
}
