<?php

namespace App\Models;

use App\Models\Traits\HasMultilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, HasMultilingualFields;

    protected $fillable = [
        'pillar_key',
        'slug',
        'title',
        'summary',
        'description',
        'deliverables',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'description' => 'array',
        'deliverables' => 'array',
        'is_active' => 'boolean',
    ];

    public function getPillarNameAttribute(): string
    {
        $pillars = [
            'economy' => [
                'en' => 'Economy & Knowledge',
                'ar' => 'الاقتصاد والمعرفة',
                'tr' => 'Ekonomi ve Bilgi',
            ],
            'relations' => [
                'en' => 'Relations & Business',
                'ar' => 'العلاقات والأعمال',
                'tr' => 'İlişkiler ve İş',
            ],
            'events' => [
                'en' => 'Events & Support Services',
                'ar' => 'الفعاليات والخدمات المساندة',
                'tr' => 'Etkinlikler ve Destek Hizmetleri',
            ],
            'community' => [
                'en' => 'Community & Media',
                'ar' => 'المجتمع والإعلام',
                'tr' => 'Topluluk ve Medya',
            ],
        ];

        $locale = app()->getLocale();
        return $pillars[$this->pillar_key][$locale] ?? ($pillars[$this->pillar_key]['en'] ?? ucfirst($this->pillar_key));
    }
}
