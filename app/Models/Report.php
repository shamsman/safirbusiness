<?php

namespace App\Models;

use App\Models\Traits\HasMultilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, HasMultilingualFields;

    protected $fillable = [
        'slug',
        'category',
        'title',
        'summary',
        'content',
        'tags',
        'read_time',
        'published_date',
        'pdf_file',
        'downloads_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'content' => 'array',
        'tags' => 'array',
        'published_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getCategoryNameAttribute(): string
    {
        $categories = [
            'macro_markets' => [
                'en' => 'Macro & Markets',
                'ar' => 'الاقتصاد الكلي والأسواق',
                'tr' => 'Makroekonomi ve Piyasalar',
            ],
            'logistics' => [
                'en' => 'Logistics, Corridors & Infrastructure',
                'ar' => 'اللوجستيات والممرات والبنية التحتية',
                'tr' => 'Lojistik, Koridorlar ve Altyapı',
            ],
            'incentives' => [
                'en' => 'Investment & Incentives',
                'ar' => 'الاستثمار والحوافز',
                'tr' => 'Yatırım ve Teşvikler',
            ],
            'defence' => [
                'en' => 'Defence & Advanced Industry',
                'ar' => 'الصناعات الدفاعية والمتقدمة',
                'tr' => 'Savunma ve İleri Sanayi',
            ],
            'procurement' => [
                'en' => 'Trade & Regulation',
                'ar' => 'التجارة والتشريعات',
                'tr' => 'Ticaret ve Mevzuat',
            ],
            'diplomacy' => [
                'en' => 'Diplomacy & Policy',
                'ar' => 'الدبلوماسية والسياسات',
                'tr' => 'Diplomasi ve Politika',
            ],
            'free_zones' => [
                'en' => 'Free Zones & Industrial Parks',
                'ar' => 'المناطق الحرة والمدن الصناعية',
                'tr' => 'Serbest Bölgeler ve OSB\'ler',
            ],
        ];

        $locale = app()->getLocale();
        return $categories[$this->category][$locale] ?? ($categories[$this->category]['en'] ?? ucfirst($this->category));
    }
}
