<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization',
        'country',
        'email',
        'phone',
        'service_type',
        'details',
        'status',
        'ip_address',
    ];

    public function getServiceTypeLabelAttribute(): string
    {
        $types = [
            'embassy' => [
                'en' => 'Embassies & Institutional Support',
                'ar' => 'السفارات والدعم المؤسسي',
                'tr' => 'Büyükelçilikler ve Kurumsal Destek',
            ],
            'corporate' => [
                'en' => 'Corporate Market Entry & Expansion',
                'ar' => 'دخول السوق وتوسع الشركات',
                'tr' => 'Pazara Giriş ve Şirket Büyümesi',
            ],
            'b2b' => [
                'en' => 'B2B Matchmaking & Bilateral Delegations',
                'ar' => 'التوفيق التجاري B2B والوفود الثنائية',
                'tr' => 'B2B Eşleştirme ve İkili Heyetler',
            ],
            'reports' => [
                'en' => 'Economic Reports & Sector Studies',
                'ar' => 'التقارير الاقتصادية والدراسات القطاعية',
                'tr' => 'Ekonomik Raporlar ve Sektör Çalışmaları',
            ],
            'events' => [
                'en' => 'Official Events, Conferences & Protocols',
                'ar' => 'الفعاليات الرسمية والمؤتمرات والبروتوكول',
                'tr' => 'Resmî Etkinlikler, Konferanslar ve Protokol',
            ],
            'consular' => [
                'en' => 'Consular, Legalization & Translation Services',
                'ar' => 'الخدمات القنصلية والتصديقات والترجمة',
                'tr' => 'Konsolosluk, Tasdik ve Tercüme Hizmetleri',
            ],
            'general' => [
                'en' => 'General Inquiry / Advisory Scoping',
                'ar' => 'استفسار عام / جلسة تقييم استشاري',
                'tr' => 'Genel Danışma / Kapsam Değerlendirme',
            ],
        ];

        $locale = app()->getLocale();
        return $types[$this->service_type][$locale] ?? ($types[$this->service_type]['en'] ?? ucfirst($this->service_type));
    }
}
