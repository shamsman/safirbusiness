<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PageAndMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed or Update About Us Page
        $aboutPage = Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'template' => 'about',
                'title' => [
                    'en' => 'About Safir Business Hub',
                    'ar' => 'عن ملتقى سفير للأعمال',
                    'tr' => 'Safir İş Merkezi Hakkında',
                ],
                'summary' => [
                    'en' => 'Safir Business Hub is an Ankara-based diplomatic, institutional, and commercial ecosystem designed to facilitate strategic market entry, inter-governmental cooperation, and high-impact corporate expansion across Türkiye and global markets.',
                    'ar' => 'ملتقى سفير للأعمال هو منظومة مؤسسية ودبلوماسية واقتصادية متكاملة تتخذ من العاصمة التركية أنقرة مقراً لها، متخصصة في تمكين الدخول الاستراتيجي للأسواق، وتعزيز العلاقات الحكومية والتجارية، وقيادة التوسع الاستثماري بين تركيا والأسواق الدولية.',
                    'tr' => 'Safir İş Merkezi, Ankara merkezli diplomatik, kurumsal ve ticari bir ekosistem olup, Türkiye ve küresel pazarlar arasında stratejik pazar girişi, hükümetlerarası işbirliği ve yüksek etkili kurumsal büyümeyi yönetmektedir.',
                ],
                'content' => [
                    'en' => '<p class="lead">Safir Business Hub was established in Ankara to serve as the premier diplomatic and economic nexus connecting international embassies, sovereign investment authorities, corporate conglomerates, and institutional decision-makers with the vibrant Turkish economy.</p><p>We operate directly at the heart of Türkiye’s decision-making apparatus, bridging sovereign delegations and private enterprise with high-level ministries, industrial chambers, free zones, and key stakeholders. Our multi-disciplinary advisory framework blends diplomatic protocol with rigorous macro-intelligence and commercial execution.</p>',
                    'ar' => '<p class="lead">تأسس ملتقى سفير للأعمال في العاصمة التركية أنقرة ليكون الرابط المؤسسي والدبلوماسي الأبرز الذي يجمع بين السفارات والبعثات الدبلوماسية، وصناديق الاستثمار السيادية، والشركات الدولية متعددة الجنسيات، مع صناع القرار في الاقتصاد التركي.</p><p>نعمل من قلب عاصمة القرار التركي لفتح الأبواب الموثوقة أمام الشراكات الاستراتيجية ووفود الأعمال، وتوفير الدراسات القطاعية المعمقة، والربط التجاري والاستثماري المتكامل بين تركيا والعالم العربي والأسواق الدولية.</p>',
                    'tr' => '<p class="lead">Safir İş Merkezi, uluslararası büyükelçilikleri, egemen yatırım otoritelerini ve çok uluslu şirketleri Türkiye ekonomisinin karar vericileriyle buluşturan öncü bir diplomatik ve ekonomik köprü olarak Ankara’da kurulmuştur.</p><p>Devlet kurumları, sanayi odaları, serbest bölgeler ve küresel iş liderleri arasında stratejik işbirliklerini hayata geçiriyor, protokol güvenilirliği ile ticari yürütmeyi bir araya getiriyoruz.</p>',
                ],
                'blocks' => [
                    'founders' => [
                        [
                            'id' => 'founder-1',
                            'name' => 'Dr. Shams Al-Din Al-Tamimi',
                            'role' => [
                                'en' => 'Co-Founder & Executive Chairman',
                                'ar' => 'المؤسس المشارك ورئيس مجلس الإدارة',
                                'tr' => 'Kurucu Ortak ve Yönetim Kurulu Başkanı',
                            ],
                            'badge' => [
                                'en' => 'Diplomatic Advisory & Sovereign Relations',
                                'ar' => 'الاستشارات الدبلوماسية والعلاقات السيادية',
                                'tr' => 'Diplomatik Danışmanlık ve Hükümet İlişkileri',
                            ],
                            'bio' => [
                                'en' => 'Senior diplomatic and geopolitical advisor with over 22 years of high-level engagement alongside foreign embassies, inter-governmental bodies, and international economic chambers in Ankara. Pioneer in institutional matchmaking and sovereign delegation protocols.',
                                'ar' => 'مستشار دبلوماسي واقتصادي رفيع بخبرة تتجاوز 22 عاماً في العمل الاستشاري المباشر مع السفارات المعتمدة، والهيئات الحكومية، والاتحادات التجارية في أنقرة. يقود الاستراتيجيات السيادية وملفات التعاون الاقتصادي الثنائي.',
                                'tr' => 'Ankara’da büyükelçilikler, bakanlıklar ve uluslararası ticaret odalarıyla 22 yılı aşkın üst düzey çalışma tecrübesine sahip diplomatik ve jeopolitik danışman. Hükümetlerarası işbirliği ve protokol yönetiminde öncü.',
                            ],
                            'highlights' => [
                                'en' => [
                                    'Advised 30+ diplomatic missions and trade offices on Turkish economic engagements',
                                    'Key architect of high-level bilateral commercial treaties and chamber alliances',
                                    'Dean of foreign corporate and consular protocol frameworks in the capital',
                                ],
                                'ar' => [
                                    'تقديم استشارات لأكثر من 30 بعثة دبلوماسية وملحقية تجارية في تركيا',
                                    'مهندس رئيسي لمذكرات التفاهم الاقتصادية واتفاقيات غرف التجارة الثنائية',
                                    'خبير مرجعي في بروتوكولات الوفود الرسمية والخدمات القنصلية والمؤسسية',
                                ],
                                'tr' => [
                                    '30’dan fazla büyükelçilik ve ticari ataşeliğe stratejik danışmanlık',
                                    'İkili ticaret anlaşmaları ve oda protokollerinin koordinasyonu',
                                    'Resmi heyetler ve konsolosluk hizmetlerinde üst düzey deneyim',
                                ],
                            ],
                            'education' => [
                                'en' => [
                                    'Ph.D. in International Relations & Geopolitics',
                                    'M.Sc. in Diplomatic Studies & Public Policy',
                                ],
                                'ar' => [
                                    'دكتوراه في العلاقات الدولية والجيوسياسية',
                                    'ماجستير في الدراسات الدبلوماسية والسياسات العامة',
                                ],
                                'tr' => [
                                    'Uluslararası İlişkiler ve Jeopolitik Doktora',
                                    'Diplomatik Çalışmalar ve Kamu Politikası Yüksek Lisans',
                                ],
                            ],
                            'linkedin' => 'https://linkedin.com',
                            'email' => 'chairman@safirbusiness.com',
                        ],
                        [
                            'id' => 'founder-2',
                            'name' => 'Eng. Tariq Al-Hashimi',
                            'role' => [
                                'en' => 'Co-Founder & Managing Director',
                                'ar' => 'المؤسس المشارك والمدير العام التنفيذي',
                                'tr' => 'Kurucu Ortak ve Genel Müdür',
                            ],
                            'badge' => [
                                'en' => 'Cross-Border Investment & Corporate Market Entry',
                                'ar' => 'الاستثمار الدولي والدخول الاستراتيجي للأسواق',
                                'tr' => 'Sınır Ötesi Yatırımlar ve Pazar Girişi',
                            ],
                            'bio' => [
                                'en' => 'Strategic enterprise advisor and investment specialist who has orchestrated multi-million-dollar cross-border ventures, FDI projects, and public-private consortia across Türkiye, the Gulf, and Europe in manufacturing, logistics, and infrastructure.',
                                'ar' => 'خبير استثماري واستراتيجي بارز قاد مشاريع استثمار أجنبي مباشر وتحالفات استراتيجية بقيمة مئات الملايين من الدولارات عبر تركيا والخليج العربي في قطاعات الصناعة واللوجستيات والبنية التحتية.',
                                'tr' => 'Türkiye, Körfez ve Avrupa genelinde sanayi, lojistik ve teknoloji alanlarında yüz milyonlarca dolarlık doğrudan yabancı yatırım ve ortak girişimi yönetmiş kurumsal strateji lideri.',
                            ],
                            'highlights' => [
                                'en' => [
                                    'Facilitated $400M+ in cross-border foreign direct investment and joint ventures',
                                    'Trusted board advisor to sovereign wealth funds and multinational enterprises',
                                    'Expert in Turkish Free Zones, investment incentives, and strategic joint ventures',
                                ],
                                'ar' => [
                                    'تيسير استثمارات وتوسعات بقيمة تتجاوز 400 مليون دولار في السوق التركي',
                                    'مستشار استراتيجي لمجموعات استثمارية كبرى وصناديق إقليمية',
                                    'خبير متخصص في حوافز الاستثمار الحكومية، والمناطق الحرة، وعمليات الاستحواذ',
                                ],
                                'tr' => [
                                    '400 milyon doları aşkın doğrudan yatırım ve ortak girişim yönetimi',
                                    'Bölgesel fonlar ve çok uluslu şirketlere yönetim kurulu danışmanlığı',
                                    'Türkiye Yatırım Teşvikleri ve Serbest Bölgeler uzmanlığı',
                                ],
                            ],
                            'education' => [
                                'en' => [
                                    'MBA in Strategic Management & Corporate Finance — INSEAD',
                                    'B.Sc. in Industrial & Systems Engineering',
                                ],
                                'ar' => [
                                    'ماجستير إدارة الأعمال والتمويل المؤسسي — إنسياد (INSEAD)',
                                    'بكالوريوس الهندسة الصناعية وهندسة النظم',
                                ],
                                'tr' => [
                                    'Stratejik Yönetim ve Kurumsal Finans MBA — INSEAD',
                                    'Endüstri Mühendisliği Lisans',
                                ],
                            ],
                            'linkedin' => 'https://linkedin.com',
                            'email' => 'managing.director@safirbusiness.com',
                        ],
                    ],
                ],
                'meta_title' => [
                    'en' => 'About Safir Business Hub — Leadership & Institutional Vision',
                    'ar' => 'عن ملتقى سفير للأعمال — القيادة والرؤية المؤسسية',
                    'tr' => 'Safir İş Merkezi Hakkında — Liderlik ve Kurumsal Vizyon',
                ],
                'meta_description' => [
                    'en' => 'Discover Safir Business Hub, our diplomatic economic advisory mission in Ankara, and our executive founding leadership.',
                    'ar' => 'تعرف على ملتقى سفير للأعمال في أنقرة، ورسالتنا الدبلوماسية والاقتصادية، والسيرة الذاتية للمؤسسين.',
                    'tr' => 'Safir İş Merkezi’ni, Ankara’daki diplomatik ve ekonomik misyonumuzu ve kurucu liderlerimizi keşfedin.',
                ],
                'is_published' => true,
                'sort_order' => 1,
            ]
        );

        // 2. Seed Menus
        // A) Header Menu
        $headerMenu = Menu::firstOrCreate(
            ['location' => 'header'],
            ['name' => 'Header Navigation', 'is_active' => true]
        );

        if ($headerMenu->items()->count() === 0) {
            $headerItems = [
                [
                    'label' => ['en' => 'Economy & Knowledge', 'ar' => 'الاقتصاد والمعرفة', 'tr' => 'Ekonomi ve Bilgi'],
                    'type' => 'url',
                    'url' => '/reports',
                    'sort_order' => 1,
                ],
                [
                    'label' => ['en' => 'Relations & Business', 'ar' => 'العلاقات والأعمال', 'tr' => 'İlişkiler ve İş'],
                    'type' => 'url',
                    'url' => '/services/relations',
                    'sort_order' => 2,
                ],
                [
                    'label' => ['en' => 'Conferences & Events', 'ar' => 'الفعاليات والمؤتمرات', 'tr' => 'Etkinlikler ve Konferanslar'],
                    'type' => 'url',
                    'url' => '/services/events',
                    'sort_order' => 3,
                ],
                [
                    'label' => ['en' => 'Media & Community', 'ar' => 'المجتمع والإعلام', 'tr' => 'Topluluk ve Medya'],
                    'type' => 'url',
                    'url' => '/services/community',
                    'sort_order' => 4,
                ],
                [
                    'label' => ['en' => 'Embassies', 'ar' => 'السفارات', 'tr' => 'Büyükelçilikler'],
                    'type' => 'url',
                    'url' => '/embassies',
                    'sort_order' => 5,
                ],
                [
                    'label' => ['en' => 'Corporates', 'ar' => 'الشركات', 'tr' => 'Şirketler'],
                    'type' => 'url',
                    'url' => '/corporates',
                    'sort_order' => 6,
                ],
                [
                    'label' => ['en' => 'About Us', 'ar' => 'عن المنصة', 'tr' => 'Hakkımızda'],
                    'type' => 'page',
                    'page_id' => $aboutPage->id,
                    'sort_order' => 7,
                ],
                [
                    'label' => ['en' => 'Contact Us', 'ar' => 'اتصل بنا', 'tr' => 'İletişim'],
                    'type' => 'url',
                    'url' => '/contact',
                    'sort_order' => 8,
                ],
            ];

            foreach ($headerItems as $itemData) {
                $itemData['menu_id'] = $headerMenu->id;
                $itemData['target'] = '_self';
                $itemData['is_active'] = true;
                MenuItem::create($itemData);
            }
        }

        // B) Footer Quick Links Menu
        $footerQuickMenu = Menu::firstOrCreate(
            ['location' => 'footer_quick_links'],
            ['name' => 'Footer Quick Links', 'is_active' => true]
        );

        if ($footerQuickMenu->items()->count() === 0) {
            $footerQuickItems = [
                ['label' => ['en' => 'Embassies Portal', 'ar' => 'بوابة السفارات', 'tr' => 'Büyükelçilik Portalı'], 'url' => '/embassies', 'sort_order' => 1],
                ['label' => ['en' => 'Corporate Entry', 'ar' => 'دخول الشركات', 'tr' => 'Kurumsal Giriş'], 'url' => '/corporates', 'sort_order' => 2],
                ['label' => ['en' => 'Economic Reports', 'ar' => 'التقارير الاقتصادية', 'tr' => 'Ekonomik Raporlar'], 'url' => '/reports', 'sort_order' => 3],
                ['label' => ['en' => 'Weekly Bulletin', 'ar' => 'النشرة الأسبوعية', 'tr' => 'Haftalık Bülten'], 'url' => '/bulletin', 'sort_order' => 4],
                ['label' => ['en' => 'About Safir Hub', 'ar' => 'عن سفير هب', 'tr' => 'Safir Hub Hakkında'], 'type' => 'page', 'page_id' => $aboutPage->id, 'sort_order' => 5],
                ['label' => ['en' => 'Contact Ankara HQ', 'ar' => 'الاتصال بالمقر الرئيسي', 'tr' => 'Ankara Genel Merkez'], 'url' => '/contact', 'sort_order' => 6],
            ];

            foreach ($footerQuickItems as $itemData) {
                $itemData['menu_id'] = $footerQuickMenu->id;
                $itemData['type'] = $itemData['type'] ?? 'url';
                $itemData['target'] = '_self';
                $itemData['is_active'] = true;
                MenuItem::create($itemData);
            }
        }
    }
}
