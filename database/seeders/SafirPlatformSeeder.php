<?php

namespace Database\Seeders;

use App\Models\Bulletin;
use App\Models\Report;
use App\Models\Service;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SafirPlatformSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Reports
        $reports = [
            [
                'slug' => 'turkiye-2025-macro-outlook',
                'category' => 'macro_markets',
                'title' => [
                    'en' => 'Türkiye 2025 Macroeconomic Outlook: Disinflation, a Stronger Lira and the New Investment Window',
                    'ar' => 'آفاق الاقتصاد الكلي في تركيا 2025: تباطؤ التضخم، ليرة أقوى، ونافذة استثمارية جديدة',
                    'tr' => 'Türkiye 2025 Makroekonomik Görünümü: Dezenflasyon, Güçlenen TL ve Yeni Yatırım Penceresi',
                ],
                'summary' => [
                    'en' => 'A data-driven review of Türkiye\'s disinflation path, the shift toward orthodox monetary policy, and what a stabilising lira means for foreign direct investment, joint ventures and long-horizon capital allocation.',
                    'ar' => 'مراجعة معمّقة قائمة على البيانات لمسار تباطؤ التضخم في تركيا، والتحول نحو سياسة نقدية تقليدية، وما يعنيه استقرار الليرة لتدفقات الاستثمار الأجنبي المباشر والمشاريع المشتركة وتخصيص رؤوس الأموال.',
                    'tr' => 'Türkiye\'nin dezenflasyon patikası, ortodoks para politikasına dönüş ve istikrar kazanan TL\'nin doğrudan yabancı yatırım, ortak girişimler ve uzun vadeli sermaye tahsisi açısından anlamı üzerine veri temelli analiz.',
                ],
                'content' => [
                    'en' => "<h3>Executive Summary</h3><p>Türkiye enters 2025 with an orthodox monetary policy framework anchoring market expectations. Disinflation is steadily taking hold, driven by tight liquidity and fiscal rebalancing. For foreign institutional investors and multinational corporations, this environment represents the most predictable macroeconomic foundation seen in over five years.</p><h4>Key Insights</h4><ul><li>Headline inflation projected to converge toward central bank interim targets.</li><li>Renewed sovereign rating upgrades unlocking lower borrowing costs and private equity flows.</li><li>Strategic FDI incentives expanding for high-technology manufacturing and energy transition projects.</li></ul>",
                    'ar' => "<h3>الخلاصة التنفيذية</h3><p>تدخل تركيا عام 2025 في ظل إطار سياسة نقدية تقليدية يعيد ترسيخ توقعات الأسواق واستقرارها. ويأخذ تباطؤ التضخم مساراً تصاعدياً مدفوعاً بضبط السيولة النقدية وإعادة التوازن المالي، مما يوفر بيئة استثمارية هي الأكثر استقراراً وقابلية للتنبؤ منذ أكثر من خمس سنوات.</p><h4>أبرز المؤشرات</h4><ul><li>انخفاض معدلات التضخم نحو المستهدفات المرحلية للبنك المركزي.</li><li>ترقيات متتالية للتصنيف الائتماني السيادي تفتح الباب أمام انخفاض تكلفة التمويل وتدفق رؤوس الأموال الخاصة.</li><li>توسع حوافز الاستثمار الأجنبي المباشر في الصناعات المتقدمة ومشاريع تحول الطاقة.</li></ul>",
                    'tr' => "<h3>Yönetici Özeti</h3><p>Türkiye, piyasa beklentilerini çıpalayan rasyonel para politikası çerçevesiyle yeni bir döneme girmektedir. Dezenflasyon süreci sıkı likidite yönetimiyle ivme kazanırken, yabancı doğrudan yatırımcılar için son beş yılın en öngörülebilir makroekonomik zemini oluşmaktadır.</p><h4>Öne Çıkan Bulgular</h4><ul><li>Manşet enflasyonun Merkez Bankası ara hedeflerine doğru kademeli yakınsaması.</li><li>Kredi derecelendirme kuruluşlarının not artışlarıyla azalan borçlanma maliyetleri.</li><li>Yüksek teknoloji üretimi ve enerji dönüşümü projelerinde genişleyen stratejik teşvikler.</li></ul>",
                ],
                'tags' => ['Macro', 'Inflation', 'MonetaryPolicy', 'FDI', 'Türkiye2025'],
                'read_time' => '14 min',
                'published_date' => '2025-01-12',
                'downloads_count' => 1420,
                'is_featured' => true,
            ],
            [
                'slug' => 'middle-corridor-logistics-trans-caspian',
                'category' => 'logistics',
                'title' => [
                    'en' => 'The Middle Corridor at Scale: Gulf–Türkiye–Central Asia Logistics After the Trans-Caspian Expansion',
                    'ar' => 'الممر الأوسط بحجمه الكامل: لوجستيات الخليج–تركيا–آسيا الوسطى بعد توسّع عبور بحر قزوين',
                    'tr' => 'Ölçeklenen Orta Koridor: Trans-Hazar Genişlemesi Sonrası Körfez–Türkiye–Orta Asya Lojistiği',
                ],
                'summary' => [
                    'en' => 'How expanded Trans-Caspian capacity, the Baku–Tbilisi–Kars line and Turkish port investment are reshaping transit times and landed costs for Gulf exporters and Central Asian importers.',
                    'ar' => 'كيف تعيد الطاقة الاستيعابية الموسّعة في عبور بحر قزوين، وخط باكو–تبليسي–قارص، والاستثمارات التركية في الموانئ، رسم أزمنة العبور والتكاليف لمصدّري الخليج ومستوردي آسيا الوسطى.',
                    'tr' => 'Genişleyen Trans-Hazar kapasitesi, Bakü–Tiflis–Kars demiryolu ve Türk liman yatırımlarının Körfez ihracatçıları için transit sürelerini ve maliyetleri nasıl yeniden şekillendirdiği.',
                ],
                'content' => [
                    'en' => "<h3>The Geo-Economic Pivot</h3><p>Supply chain security has propelled the Trans-Caspian International Transport Route (the Middle Corridor) from an alternative path to a central arterial line linking Asia, Türkiye, and Europe. With modernized customs digital systems and port infrastructure in Mersin and Filyos, container dwell times have fallen significantly.</p>",
                    'ar' => "<h3>التحول الجيو-اقتصادي</h3><p>حوّل الاهتمام العالمي بأمن سلاسل الإمداد الممر الدولي عبر بحر قزوين (الممر الأوسط) من مسار بديل إلى شريان نقل رئيسي يربط آسيا بتركيا وأوروبا. ومع تحديث النظم الجمركية الرقمية وموانئ مرسين وفيليوس، انخفضت مدة مكوث الحاويات بشكل لافت.</p>",
                    'tr' => "<h3>Jeo-Ekonomik Eksen Değişimi</h3><p>Tedarik zinciri güvenliği, Trans-Hazar Uluslararası Taşıma Güzergâhını (Orta Koridor) alternatif bir rotadan ana ticaret damarına dönüştürmüştür. Mersin ve Filyos limanlarındaki kapasite artışları ve dijital gümrük entegrasyonu transit sürelerini radikal biçimde kısaltmaktadır.</p>",
                ],
                'tags' => ['MiddleCorridor', 'Logistics', 'TransCaspian', 'GulfTrade', 'Ports'],
                'read_time' => '11 min',
                'published_date' => '2025-02-03',
                'downloads_count' => 980,
                'is_featured' => true,
            ],
            [
                'slug' => 'turkiye-investment-incentive-regime',
                'category' => 'incentives',
                'title' => [
                    'en' => 'Türkiye\'s Investment Incentive Regime: A Practical Guide for Gulf Family Offices and Holding Companies',
                    'ar' => 'نظام الحوافز الاستثمارية في تركيا: دليل عملي لمكاتب العائلات والشركات القابضة الخليجية',
                    'tr' => 'Türkiye\'de Yatırım Teşvik Rejimi: Körfez Aile Ofisleri ve Holding Şirketleri İçin Uygulamalı Rehber',
                ],
                'summary' => [
                    'en' => 'A step-by-step breakdown of investment incentive certificates, VAT and customs exemptions, social security premium support, priority-region incentives and strategic investment frameworks.',
                    'ar' => 'شرح تفصيلي لشهادات الحوافز الاستثمارية، وإعفاءات ضريبة القيمة المضافة والجمارك، ودعم التأمينات الاجتماعية، وحوافز المناطق ذات الأولوية بما يتوافق مع الهياكل الاستثمارية الخليجية.',
                    'tr' => 'Yatırım teşvik belgesi, KDV ve gümrük vergisi muafiyetleri, SGK prim desteği, öncelikli bölge teşvikleri ve stratejik yatırım çerçevesinin Körfez fonları açısından incelenmesi.',
                ],
                'content' => [
                    'en' => "<h3>Structured Tax & Capital Optimization</h3><p>Türkiye offers six distinct tiers of regional and strategic investment incentives administered by the Ministry of Industry and Technology. By properly structuring capital investments through certified regimes, corporate income tax liabilities can be reduced by up to 80% with substantial withholding exemptions.</p>",
                    'ar' => "<h3>تحسين الضرائب ورأس المال</h3><p>توفر تركيا ستة مستويات من الحوافز الإقليمية والاستراتيجية التي تديرها وزارة الصناعة والتكنولوجيا. ومن خلال الهيكلة الدقيقة للاستثمارات عبر القنوات المعتمدة، يمكن خفض التزامات ضريبة الشركات بما يصل إلى 80% مع إعفاءات ضريبية شاملة.</p>",
                    'tr' => "<h3>Vergi ve Sermaye Optimizasyonu</h3><p>Sanayi ve Teknoloji Bakanlığı koordinasyonunda yürütülen altı kademeli teşvik sistemi; KDV istisnası, gümrük muafiyeti, vergi indirimi ve faiz desteği gibi somut avantajlar sağlamaktadır.</p>",
                ],
                'tags' => ['Incentives', 'FamilyOffices', 'GCC', 'TaxResidency', 'StrategicInvestment'],
                'read_time' => '16 min',
                'published_date' => '2025-02-19',
                'downloads_count' => 1150,
                'is_featured' => true,
            ],
            [
                'slug' => 'defence-aerospace-supplier-localisation',
                'category' => 'defence',
                'title' => [
                    'en' => 'Defence, Aerospace and Dual-Use Manufacturing: Mapping Türkiye\'s Supplier Localisation Opportunity',
                    'ar' => 'الصناعات الدفاعية والفضائية وثنائية الاستخدام: خريطة فرص التوطين لدى الموردين في تركيا',
                    'tr' => 'Savunma, Havacılık ve Çift Kullanımlı Üretim: Türkiye\'nin Yerlileştirme Fırsat Haritası',
                ],
                'summary' => [
                    'en' => 'An assessment of localisation rates, offset expectations and qualified-supplier gaps across Turkish defence programmes, with an entry map for foreign component manufacturers.',
                    'ar' => 'تقييم معدلات التوطين، وتوقعات الالتزامات التعويضية (الأوفست)، وفجوات الموردين المؤهلين في برامج الدفاع والفضاء التركية، مع خريطة دخول لمصنّعي المكوّنات الأجانب.',
                    'tr' => 'Türk savunma ve havacılık ekosisteminde yerlilik oranları, offset beklentileri ve nitelikli tedarikçi fırsatları üzerine yabancı üreticilere yönelik giriş haritası.',
                ],
                'content' => [
                    'en' => "<h3>Aerospace & Defence Cluster Expansion</h3><p>With domestic procurement exceeding $15 billion annually and domestic content ratios surpassing 80%, the Presidency of Defence Industries (SSB) is actively encouraging joint ventures and localized component manufacturing in Ankara (Kahramankazan aerospace cluster) and Istanbul technoparks.</p>",
                    'ar' => "<h3>توسع التجمع الفضائي والدفاعي</h3><p>مع تجاوز حجم المشتريات المحلية 15 مليار دولار سنوياً وتخطي نسبة التوطين 80%، تشجع رئاسة الصناعات الدفاعية (SSB) تأسيس المشاريع المشتركة وتوطين صناعة المكونات في مجمع الصناعات الفضائية بأنقرة وتكنوباركات إسطنبول.</p>",
                    'tr' => "<h3>Havacılık ve Savunma Kümelenmesi</h3><p>Yıllık 15 milyar doları aşan savunma sanayii cirosu ve %80'in üzerindeki yerlilik oranıyla Savunma Sanayii Başkanlığı (SSB); Ankara Kahramankazan Havacılık İhtisas OSB ve teknoparklarda yabancı teknoloji ortaklıklarını desteklemektedir.</p>",
                ],
                'tags' => ['Defence', 'Aerospace', 'SSB', 'Offset', 'Localisation'],
                'read_time' => '13 min',
                'published_date' => '2025-03-07',
                'downloads_count' => 840,
                'is_featured' => false,
            ],
            [
                'slug' => 'ankara-diplomatic-economy-missions',
                'category' => 'diplomacy',
                'title' => [
                    'en' => 'Ankara\'s Diplomatic Economy: How Missions Shape Commercial Diplomacy in 2025',
                    'ar' => 'الاقتصاد الدبلوماسي في أنقرة: كيف تشكّل البعثات الدبلوماسية التجارة الخارجية في 2025',
                    'tr' => 'Ankara\'nın Diplomatik Ekonomisi: Misyonlar 2025\'te Ticari Diplomasiyi Nasıl Şekillendiriyor',
                ],
                'summary' => [
                    'en' => 'An analysis of how embassies, trade attachés and bilateral chambers convert Ankara\'s diplomatic calendar into commercial outcomes — and where private-sector gaps lie.',
                    'ar' => 'تحليل لكيفية تحويل السفارات والملحقين التجاريين والغرف الثنائية للتقويم الدبلوماسي في أنقرة إلى نتائج تجارية، وأين تكمن الفجوات في انخراط القطاع الخاص.',
                    'tr' => 'Büyükelçiliklerin, ticaret ataşeliklerinin ve ikili ticaret odalarının Ankara\'nın diplomatik takvimini ticari sonuçlara dönüştürme dinamiklerinin analizi.',
                ],
                'content' => [
                    'en' => "<h3>Commercial Diplomacy Redefined</h3><p>The modern diplomatic mission in Ankara is increasingly functioning as a primary commercial intelligence hub. From bilateral free trade talks to institutional MoUs with DEİK and TOBB, diplomatic desks that combine policy protocol with business matchmaking achieve demonstrably higher bilateral transaction volumes.</p>",
                    'ar' => "<h3>إعادة تعريف الدبلوماسية الاقتصادية</h3><p>باتت البعثة الدبلوماسية الحديثة في أنقرة تعمل بصفتها مركزاً رئيساً للاستخبارات التجارية والاقتصادية. ومن خلال مفاوضات التجارة الحرة وتوقيع مذكرات التفاهم مع ديوان العلاقات الخارجية (DEİK) واتحاد الغرف (TOBB)، تحقق البعثات التي تدمج البروتوكول بالتشبيك التجاري نتائج ملموسة.</p>",
                    'tr' => "<h3>Ticari Diplomasinin Dönüşümü</h3><p>Ankara'daki diplomatik misyonlar, ikili ticaret hacmini artırmada kritik istihbarat ve koordinasyon merkezleri haline gelmiştir. DEİK ve TOBB ile kurulan resmî kanallar, diplomatik protokol ile ticari eşleştirmeyi birleştiren misyonlara büyük avantaj sağlamaktadır.</p>",
                ],
                'tags' => ['Diplomacy', 'Ankara', 'Embassies', 'TradeAttaché', 'BilateralTrade'],
                'read_time' => '10 min',
                'published_date' => '2025-03-24',
                'downloads_count' => 760,
                'is_featured' => false,
            ],
            [
                'slug' => 'free-zones-technoparks-cost-incentive-map',
                'category' => 'free_zones',
                'title' => [
                    'en' => 'Free Zones, Technoparks and Organized Industrial Zones: A Comparative Cost & Incentive Map (2025)',
                    'ar' => 'المناطق الحرة والتكنوباركات والمناطق الصناعية المنظمة: خريطة مقارنة للتكاليف والحوافز (2025)',
                    'tr' => 'Serbest Bölgeler, Teknoparklar ve Organize Sanayi Bölgeleri: Karşılaştırmalı Maliyet ve Teşvik Haritası (2025)',
                ],
                'summary' => [
                    'en' => 'A side-by-side comparison of Türkiye\'s 19 free zones, technoparks and OIZs across tax treatment, customs, employment costs, utilities and time-to-operate.',
                    'ar' => 'مقارنة مباشرة بين المناطق الحرة الـ19 والتكنوباركات والمناطق الصناعية المنظمة في تركيا من حيث المعاملة الضريبية والجمارك وتكاليف العمالة والمرافق وزمن بدء التشغيل.',
                    'tr' => 'Türkiye\'nin 19 serbest bölgesi, teknoparkları ve OSB\'lerinin vergi muafiyetleri, gümrük rejimi, işgücü maliyeti ve altyapı olanakları açısından yan yana karşılaştırması.',
                ],
                'content' => [
                    'en' => "<h3>Site Selection Strategy</h3><p>Choosing between an Aegean Free Zone manufacturing facility, an Ankara Technopark R&D center, or an Anatolian Organized Industrial Zone can alter operating margins by 18-24%. This study evaluates land purchase vs. long-term lease models, corporate tax exemptions on export revenues, and zero-customs machinery importation.</p>",
                    'ar' => "<h3>استراتيجية اختيار موقع الاستثمار</h3><p>المفاضلة بين منشأة تصنيع في المنطقة الحرة لإيجه، أو مركز بحث وتطوير في أحد تكنوباركات أنقرة، أو مصنع في منطقة صناعية منظمة، قد تؤثر على هوامش الأرباح التشغيلية بنسبة تتراوح بين 18% و24%. وتفصّل هذه الدراسة خيارات التملك مقابل الإيجار طويل الأجل والإعفاءات الضريبية الكاملة على إيرادات التصدير.</p>",
                    'tr' => "<h3>Yatırım Yeri Seçim Stratejisi</h3><p>Ege Serbest Bölgesi, Ankara Teknoparkları veya Organize Sanayi Bölgeleri (OSB) arasındaki doğru seçim; operasyonel marjlarda %18-24 oranında verimlilik farkı yaratabilir. Bu çalışma, arazi mülkiyeti, uzun vadeli tahsisler ve ihracat gelirlerindeki kurumlar vergisi istisnalarını karşılaştırır.</p>",
                ],
                'tags' => ['FreeZones', 'OSB', 'Technoparks', 'Manufacturing', 'CostComparison'],
                'read_time' => '12 min',
                'published_date' => '2025-04-05',
                'downloads_count' => 890,
                'is_featured' => false,
            ],
        ];

        foreach ($reports as $data) {
            Report::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // 2. Seed Bulletins
        $bulletins = [
            [
                'issue_number' => 'Issue #52',
                'published_date' => '2025-04-07',
                'title' => [
                    'en' => 'Weekly Economic Bulletin: Q1 FDI Inflows, CBRT Policy Rates & Middle Corridor Updates',
                    'ar' => 'النشرة الاقتصادية الأسبوعية: تدفقات الاستثمار للربع الأول، أسعار فائدة المركزي، وتطورات الممر الأوسط',
                    'tr' => 'Haftalık Ekonomi Bülteni: 1. Çeyrek DYY Girişleri, TCMB Politika Faizi ve Orta Koridor Gelişmeleri',
                ],
                'summary' => [
                    'en' => 'Comprehensive weekly briefing on official gazette enactments, treasury bond yields, bilateral trade agreements with the GCC, and updated export incentive rates.',
                    'ar' => 'إيجاز أسبوعي شامل يتناول قرارات الجريدة الرسمية، عوائد السندات الحكومية، اتفاقيات التجارة البينية مع دول الخليج، ومعدلات حوافز التصدير المحدثة.',
                    'tr' => 'Resmî Gazete düzenlemeleri, tahvil getirileri, Körfez ülkeleriyle ikili ticaret gelişmeleri ve güncellenen ihracat teşviklerine dair haftalık kapsamlı brifing.',
                ],
                'highlights' => [
                    'en' => [
                        'Treasury 10-year yields compress 85 bps following foreign inflows.',
                        'Ministry of Trade announces revised customs tariff thresholds for high-tech industrial machinery.',
                        'Turkish Contractors Association (TMB) signs $3.2B infrastructure framework in Central Asia.',
                    ],
                    'ar' => [
                        'انخفاض عوائد سندات الخزانة لأجل 10 سنوات بمقدار 85 نقطة أساس عقب تدفقات أجنبية جديدة.',
                        'وزارة التجارة تعلن تعديلات على التعريفات الجمركية للآلات الصناعية ذات التقنية العالية.',
                        'اتحاد المقاولين الأتراك (TMB) يوقع اتفاقية إطارية لمشاريع بنية تحتية بقيمة 3.2 مليار دولار في آسيا الوسطى.',
                    ],
                    'tr' => [
                        'Yabancı fon girişleriyle Hazine 10 yıllık tahvil getirilerinde 85 baz puan gerileme.',
                        'Ticaret Bakanlığı yüksek teknolojili sanayi makinelerinde gümrük tarife düzenlemesini açıkladı.',
                        'Türkiye Müteahhitler Birliği (TMB) Orta Asya\'da 3,2 milyar dolarlık altyapı çerçeve anlaşması imzaladı.',
                    ],
                ],
            ],
            [
                'issue_number' => 'Issue #51',
                'published_date' => '2025-03-31',
                'title' => [
                    'en' => 'Weekly Economic Bulletin: Energy Transition Incentives & Export Sector Growth',
                    'ar' => 'النشرة الاقتصادية الأسبوعية: حوافز تحول الطاقة ونمو القطاعات التصديرية',
                    'tr' => 'Haftalık Ekonomi Bülteni: Enerji Dönüşümü Teşvikleri ve İhracat Sektörü Büyümesi',
                ],
                'summary' => [
                    'en' => 'Focus on renewable energy grid connectivity quotas, automotive export numbers, and bilateral investment committee agendas in Ankara.',
                    'ar' => 'التركيز على حصص الربط بشبكات الطاقة المتجددة، وأرقام صادرات السيارات، وأجندة لجان الاستثمار الثنائية في أنقرة.',
                    'tr' => 'Yenilenebilir enerji şebeke bağlantı kotaları, otomotiv ihracat verileri ve Ankara\'daki ikili yatırım komiteleri gündemi.',
                ],
                'highlights' => [
                    'en' => [
                        'Solar and wind capacity allocations for industrial self-consumption expanded by 2 GW.',
                        'Automotive export value sets monthly record led by EV and hybrid vehicle production lines.',
                    ],
                    'ar' => [
                        'زيادة مخصصات الطاقة الشمسية وطاقة الرياح للاستهلاك الصناعي الذاتي بمقدار 2 غيغاواط.',
                        'صادرات قطاع السيارات تسجل رقماً قياسياً شهرياً بدعم من خطوط إنتاج السيارات الكهربائية والهجينة.',
                    ],
                    'tr' => [
                        'Sanayi öz tüketimine yönelik rüzgâr ve güneş kapasite tahsisleri 2 GW genişletildi.',
                        'Otomotiv ihracatı hibrit ve elektrikli araç hatlarının öncülüğünde aylık rekor kırdı.',
                    ],
                ],
            ],
        ];

        foreach ($bulletins as $b) {
            Bulletin::updateOrCreate(['issue_number' => $b['issue_number']], $b);
        }

        // 3. Seed Services across 4 Pillars
        $services = [
            // Pillar 1: Economy & Knowledge
            [
                'pillar_key' => 'economy',
                'slug' => 'macroeconomic-policy-briefings',
                'title' => [
                    'en' => 'General, Sectoral & Monthly Economic Reports',
                    'ar' => 'تقارير اقتصادية عامة وقطاعية وشهرية',
                    'tr' => 'Genel, Sektörel ve Aylık Ekonomik Raporlar',
                ],
                'summary' => [
                    'en' => 'Macroeconomic trajectory, inflation trends, monetary policy decisions, and sectoral forecasting designed for executive decision-makers.',
                    'ar' => 'مسار الاقتصاد الكلي، اتجاهات التضخم، قرارات السياسة النقدية، والتوقعات القطاعية المعدة لصناع القرار التنفيذيين.',
                    'tr' => 'Makroekonomik görünüm, enflasyon trendleri, para politikası kararları ve yöneticilere özel sektörel projeksiyonlar.',
                ],
                'description' => [
                    'en' => 'Our intelligence unit tracks the real dynamics of Türkiye\'s economy, translating Central Bank actions, Treasury debt figures, and trade balance movements into actionable commercial insights.',
                    'ar' => 'ترصد وحدتنا الاستخباراتية الديناميكيات الفعلية للاقتصاد التركي، محولة قرارات البنك المركزي وأرقام الخزانة والميزان التجاري إلى رؤى تجارية قابلة للتنفيذ المباشر.',
                    'tr' => 'Ekonomi istihbarat birimimiz Merkez Bankası kararlarını, Hazine borçlanma dinamiklerini ve dış ticaret dengesini eyleme dönüştürülebilir ticari verilere çevirir.',
                ],
                'deliverables' => [
                    'Monthly Macro Dashboard (EN/AR/TR)',
                    'Sector Deep-Dive Slides (Automotive, Defence, Agri, Energy)',
                    'Direct Access to Ankara Chief Economist Briefings',
                ],
                'icon' => 'chart-bar',
                'sort_order' => 1,
            ],
            [
                'pillar_key' => 'economy',
                'slug' => 'market-studies-feasibility',
                'title' => [
                    'en' => 'In-Depth Market Studies & Feasibility',
                    'ar' => 'دراسات سوقية وجدوى معمّقة',
                    'tr' => 'Derinlemesine Pazar ve Fizibilite Çalışmaları',
                ],
                'summary' => [
                    'en' => 'Rigorous commercial due diligence, supply chain mapping, distributor vetting, and competitor benchmarking.',
                    'ar' => 'فحص تجاري نافٍ للجهالة، خرائط سلاسل الإمداد، تدقيق الموزعين، والمقارنة المعيارية للمنافسين.',
                    'tr' => 'Titiz ticari durum tespiti, tedarik zinciri haritalaması, distribütör denetimi ve rekabet kıyaslaması.',
                ],
                'description' => [
                    'en' => 'Before deploying capital, foreign corporates require localized intelligence. We conduct field interviews with Turkish suppliers, associations, and clients to provide verified numbers.',
                    'ar' => 'قبل توظيف رأس المال، تحتاج الشركات الأجنبية إلى استخبارات محلية موثوقة. نجري مقابلات ميدانية مع الموردين والجمعيات والعملاء الأتراك لتقديم أرقام مدققة.',
                    'tr' => 'Yatırım öncesinde yabancı şirketlerin ihtiyaç duyduğu yerel verileri; sahada tedarikçiler, birlikler ve müşterilerle görüşerek doğrulanmış biçimde sunuyoruz.',
                ],
                'deliverables' => [
                    'Competitor Market Share Matrix',
                    'Direct Field Interview Findings',
                    'Pricing, Margins & Supply Chain Resilience Report',
                ],
                'icon' => 'document-search',
                'sort_order' => 2,
            ],
            [
                'pillar_key' => 'economy',
                'slug' => 'weekly-economic-bulletin',
                'title' => [
                    'en' => 'Weekly Economic Bulletin & Official Gazette Tracker',
                    'ar' => 'النشرة الاقتصادية الأسبوعية ومتابعة الجريدة الرسمية',
                    'tr' => 'Haftalık Ekonomi Bülteni ve Resmî Gazete Takibi',
                ],
                'summary' => [
                    'en' => 'Curated Monday morning briefings covering regulatory amendments, investment incentives, and presidential decrees.',
                    'ar' => 'إيجاز صباح كل اثنين يغطي التعديلات التشريعية، حوافز الاستثمار، والقرارات الرئاسية ذات الأثر الاقتصادي.',
                    'tr' => 'Mevzuat değişiklikleri, yatırım teşvikleri ve Cumhurbaşkanlığı kararlarını içeren pazartesi sabahı brifingi.',
                ],
                'description' => [
                    'en' => 'Navigating Türkiye\'s fast-moving Official Gazette is essential for compliance and capturing incentive windows before deadlines expire.',
                    'ar' => 'تعد متابعة الجريدة الرسمية التركية السريعة أمراً أساسياً لضمان الامتثال واقتناص فرص الحوافز الحكومية قبل انتهاء مواعيدها.',
                    'tr' => 'Resmî Gazete\'deki hızlı mevzuat akışını takip etmek, yasal uyum ve teşvik pencerelerinden zamanında yararlanmak için hayatidir.',
                ],
                'deliverables' => [
                    'Weekly 3-Page Executive PDF',
                    'Gazette Translation Summaries (AR/EN)',
                    'Instant Regulatory Alert Broadcasts',
                ],
                'icon' => 'newspaper',
                'sort_order' => 3,
            ],

            // Pillar 2: Relations & Business
            [
                'pillar_key' => 'relations',
                'slug' => 'b2b-matchmaking-partnerships',
                'title' => [
                    'en' => 'Business Meetings & B2B Matchmaking',
                    'ar' => 'لقاءات الأعمال والتوفيق بين الشركات (B2B)',
                    'tr' => 'İş Görüşmeleri ve B2B Eşleştirme',
                ],
                'summary' => [
                    'en' => 'Connecting international corporations with verified Turkish manufacturers, contractors, and joint-venture partners.',
                    'ar' => 'ربط الشركات الدولية بالمصنّعين والمقاولين والشركاء الأتراك المؤهلين مسبقاً لمشاريع مشتركة.',
                    'tr' => 'Uluslararası şirketleri onaylı Türk üreticiler, müteahhitler ve ortak girişim adaylarıyla buluşturma.',
                ],
                'description' => [
                    'en' => 'We curate 1-on-1 business meetings with decision-makers who have real purchasing or production authority, backed by bilateral background checks.',
                    'ar' => 'ننظم اجتماعات أعمال فردية مباشرة مع أصحاب القرار الفعليين في الإنتاج والشراء، مدعومة بتحريات مهنية مسبقة.',
                    'tr' => 'Gerçek satın alma veya üretim yetkisine sahip karar vericilerle, arka plan kontrolleri yapılmış bire bir iş toplantıları koordine ediyoruz.',
                ],
                'deliverables' => [
                    'Vetted Partner Shortlist with Financial Scoring',
                    'Organized 1-on-1 Bilateral Meetings',
                    'Simultaneous Interpreter & Protocol Escort',
                ],
                'icon' => 'handshake',
                'sort_order' => 1,
            ],
            [
                'pillar_key' => 'relations',
                'slug' => 'institutional-government-relations',
                'title' => [
                    'en' => 'Institutional & Government Relations',
                    'ar' => 'العلاقات المؤسسية والحكومية (الوزارات والهيئات)',
                    'tr' => 'Kurumsal ve Kamu İlişkileri (Bakanlıklar ve Düzenleyici Kurumlar)',
                ],
                'summary' => [
                    'en' => 'Navigating ministries, regulatory boards, chambers of commerce, and apex bodies in Ankara with protocol elegance.',
                    'ar' => 'التنسيق والتواصل مع الوزارات والهيئات التنظيمية والغرف التجارية والاتحادات في أنقرة بأعلى درجات اللباقة والبروتوكول.',
                    'tr' => 'Ankara\'daki bakanlıklar, düzenleyici kurullar, ticaret odaları ve çatı kuruluşlarla kurumsal temas yönetimi.',
                ],
                'description' => [
                    'en' => 'From the Ministry of Trade to the Investment Office and TOBB, our team ensures your files are presented to the right general directorates with proper documentation.',
                    'ar' => 'من وزارة التجارة إلى مكتب الاستثمار التابع لرئاسة الجمهورية واتحاد الغرف (TOBB)، نضمن وصول ملفاتكم للمديريات العامة المعنية بدقة.',
                    'tr' => 'Ticaret Bakanlığı\'ndan Yatırım Ofisi\'ne ve TOBB\'a kadar, dosyalarınızın doğru genel müdürlüklere usulüne uygun sunulmasını sağlıyoruz.',
                ],
                'deliverables' => [
                    'Stakeholder Hierarchy & Decision-Maker Map',
                    'Official Meeting Scheduling & File Preparation',
                    'Follow-up & Commitment Tracking Desk',
                ],
                'icon' => 'building-library',
                'sort_order' => 2,
            ],
            [
                'pillar_key' => 'relations',
                'slug' => 'delegations-official-visits',
                'title' => [
                    'en' => 'Delegations & Official Visit Programs',
                    'ar' => 'برامج إدارة وتنظيم الوفود والزيارات الرسمية',
                    'tr' => 'Resmî Heyet ve Ziyaret Programları Tasarımı',
                ],
                'summary' => [
                    'en' => 'Comprehensive design and execution of incoming ministerial, parliamentary, and trade delegations.',
                    'ar' => 'تصميم وتنفيذ متكامل لزيارات الوفود الوزارية والبرلمانية والتجارية رفيعة المستوى إلى تركيا.',
                    'tr' => 'Türkiye\'ye gelen bakanlık, parlamento ve ticaret heyetlerinin uçtan uca programlanması ve icrası.',
                ],
                'description' => [
                    'en' => 'Complete agenda architecture: meeting rooms at Ankara 5-star diplomatic venues, motorcade transfers, security liaison, bilateral signing ceremonies, and official readouts.',
                    'ar' => 'هندسة شاملة لجدول الأعمال: حجز القاعات الدبلوماسية، مواكب النقل الرسمية، التنسيق الأمني، مراسم توقيع الاتفاقيات، وصياغة البيانات الختامية.',
                    'tr' => 'Eksiksiz gündem mimarisi: Ankara diplomatik mekânları, VIP konvoy intikalleri, güvenlik irtibatı, imza törenleri ve resmî tutanaklar.',
                ],
                'deliverables' => [
                    'Master Delegation Schedule & Protocol Handbook',
                    'Full VIP Logistics & Secure Transport Fleet',
                    'Post-Visit Readout & Action Item Registry',
                ],
                'icon' => 'user-group',
                'sort_order' => 3,
            ],

            // Pillar 3: Events & Support Services
            [
                'pillar_key' => 'events',
                'slug' => 'conferences-official-events',
                'title' => [
                    'en' => 'Conferences & Official High-Level Events',
                    'ar' => 'المؤتمرات والفعاليات الرسمية رفيعة المستوى',
                    'tr' => 'Üst Düzey Resmî Konferans ve Zirveler',
                ],
                'summary' => [
                    'en' => 'End-to-end production of bilateral investment forums, diplomatic celebrations, and economic summits in Ankara and Istanbul.',
                    'ar' => 'إنتاج وتنظيم متكامل لمنتديات الاستثمار الثنائية، الاحتفالات الدبلوماسية، والقمم الاقتصادية في أنقرة وإسطنبول.',
                    'tr' => 'Ankara ve İstanbul\'da ikili yatırım forumları, diplomatik resepsiyonlar ve ekonomik zirvelerin uçtan uca yönetimi.',
                ],
                'description' => [
                    'en' => 'Managing guest lists, stage design, audiovisual production, simultaneous translation booths, VIP hospitality, and international press coverage.',
                    'ar' => 'إدارة قوائم كبار الضيوف، تصميم المسرح، التجهيزات الصوتية والمرئية، مقصورات الترجمة الفورية، الضيافة الرفيعة، والتغطية الإعلامية.',
                    'tr' => 'Seçkin davetli listeleri, sahne tasarımı, teknik prodüksiyon, simultane kabinleri, VIP ağırlama ve uluslararası basın koordinasyonu.',
                ],
                'deliverables' => [
                    'Event Production & Protocol Sequencing',
                    'Simultaneous Interpretation in AR, EN, TR',
                    'Official Guest Accreditation System',
                ],
                'icon' => 'microphone',
                'sort_order' => 1,
            ],
            [
                'pillar_key' => 'events',
                'slug' => 'consular-support-services',
                'title' => [
                    'en' => 'Consular, Legalization & Translation Services',
                    'ar' => 'الخدمات القنصلية والتصديقات والترجمة المعتمدة',
                    'tr' => 'Konsolosluk, Tasdik ve Yeminli Tercüme Hizmetleri',
                ],
                'summary' => [
                    'en' => 'Fast-track document review, apostille validation, notary chains, and certified institutional translations.',
                    'ar' => 'مراجعة سريعة للوثائق، تصديقات الأبوستيل، التوثيق العدلي (النوتر)، والترجمة المؤسسية المعتمدة رسمياً.',
                    'tr' => 'Hızlı belge inceleme, apostil tasdiki, noter zincirleri ve resmî kurumlara sunulacak yeminli tercüme süreçleri.',
                ],
                'description' => [
                    'en' => 'We handle commercial contracts, powers of attorney, certificates of origin, and residency filings with total compliance and confidentiality.',
                    'ar' => 'نتولى العقود التجارية، الوكالات الرسمية، شهادات المنشأ، وملفات الإقامة والعمل بامتثال تام وسرية مطلقة.',
                    'tr' => 'Ticari sözleşmeler, vekâletnameler, menşe şahadetnameleri ve oturum dosyalarını tam yasal uyum ve gizlilikle yönetiyoruz.',
                ],
                'deliverables' => [
                    'Notarized & Apostilled Document Delivery',
                    'Sworn Legal Translations (AR / EN / TR)',
                    'Digital Document Tracking System',
                ],
                'icon' => 'check-badge',
                'sort_order' => 2,
            ],

            // Pillar 4: Community & Media
            [
                'pillar_key' => 'community',
                'slug' => 'strategic-media-relations',
                'title' => [
                    'en' => 'Strategic Media Relations & Press Briefings',
                    'ar' => 'العلاقات الإعلامية والصحفية الاستراتيجية والإيجازات',
                    'tr' => 'Stratejik Basın ve Medya İlişkileri ve Brifingler',
                ],
                'summary' => [
                    'en' => 'Positioning institutional initiatives and economic partnerships across prominent Turkish, Arab, and international outlets.',
                    'ar' => 'إبراز المبادرات المؤسسية والشراكات الاقتصادية عبر أبرز وسائل الإعلام التركية والعربية والدولية.',
                    'tr' => 'Kurumsal inisiyatifleri ve ekonomik ortaklıkları Türk, Arap ve uluslararası basında stratejik konumlandırma.',
                ],
                'description' => [
                    'en' => 'Press release drafting, media conferences in Ankara, op-ed placements, and crisis communications aligned with diplomatic standards.',
                    'ar' => 'صياغة البيانات الصحفية، تنظيم المؤتمرات الإعلامية في أنقرة، نشر مقالات الرأي التنفيذية، وإدارة التواصل الاستراتيجي.',
                    'tr' => 'Basın bülteni hazırlama, basın toplantıları, köşe yazıları ve diplomatik hassasiyete uygun kriz iletişimi.',
                ],
                'deliverables' => [
                    'Multilingual Press Releases (TR/AR/EN)',
                    'Tier-1 Media Placement Network in Ankara & Istanbul',
                    'Media Monitoring & Sentiment Readout',
                ],
                'icon' => 'globe-alt',
                'sort_order' => 1,
            ],
            [
                'pillar_key' => 'community',
                'slug' => 'civil-society-charitable-campaigns',
                'title' => [
                    'en' => 'Civil Society & Bilateral Social Initiatives',
                    'ar' => 'منظمات المجتمع المدني والمبادرات الاجتماعية الثنائية',
                    'tr' => 'Sivil Toplum ve İkili Sosyal İnisiyatifler',
                ],
                'summary' => [
                    'en' => 'Structuring charitable campaigns, cultural exchange programs, and community alliances that strengthen bilateral affinity.',
                    'ar' => 'هيكلة الحملات الخيرية وبرامج التبادل الثقافي والتحالفات المجتمعية التي تعزز الروابط بين الشعوب والمؤسسات.',
                    'tr' => 'İkili bağları güçlendiren yardım kampanyaları, kültürel değişim programları ve toplumsal ortaklıkların yapılandırılması.',
                ],
                'description' => [
                    'en' => 'Facilitating lawful, high-impact social initiatives in Türkiye in partnership with registered foundations, municipalities, and AFAD/Kızılay where appropriate.',
                    'ar' => 'تيسير المبادرات الاجتماعية القانونية والمؤثرة في تركيا بالشراكة مع الأوقاف المسجلة والبلديات والهيئات المعنية.',
                    'tr' => 'Vakıflar, belediyeler ve ilgili resmî kuruluşlarla iş birliği içinde yasal ve yüksek etkili sosyal projelerin icrası.',
                ],
                'deliverables' => [
                    'NGO Due Diligence & Legal Alignment',
                    'Bilateral Campaign Launch & Media Wrap-up',
                    'Institutional Impact Documentation',
                ],
                'icon' => 'heart',
                'sort_order' => 2,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 4. Seed sample subscribers
        Subscriber::firstOrCreate(
            ['email' => 'ambassador.office@safirbusinesshub.com'],
            ['full_name' => 'Diplomatic Trade Attaché Desk', 'organization' => 'Foreign Commercial Office', 'locale' => 'en']
        );
        Subscriber::firstOrCreate(
            ['email' => 'advisory.director@safirbusinesshub.com'],
            ['full_name' => 'Dr. Tariq Al-Hashimi', 'organization' => 'GCC Sovereign Advisory Group', 'locale' => 'ar']
        );
    }
}
