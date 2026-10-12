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
        // ==========================================
        // 1. Seed or Update Core & Platform Pages
        // ==========================================

        // 1.1 About Us Page (with Founders CV blocks)
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

        // 1.2 Embassies Portal Page
        $embassiesPage = Page::updateOrCreate(
            ['slug' => 'embassies'],
            [
                'template' => 'embassies',
                'title' => [
                    'en' => 'Diplomatic & Embassies Portal',
                    'ar' => 'بوابة السفارات والبعثات الدبلوماسية',
                    'tr' => 'Büyükelçilikler ve Diplomatik Portalı',
                ],
                'summary' => [
                    'en' => 'Dedicated diplomatic desk providing foreign embassies, commercial attachés, and sovereign delegations with direct access to Turkish public institutions, ministries, and industrial leaders.',
                    'ar' => 'منصة متخصصة لدعم السفارات الأجنبية، والمكاتب التجارية، والوفود الرسمية لربطها المباشر بالوزارات والهيئات الحكومية ومجتمع الأعمال التركي.',
                    'tr' => 'Yabancı büyükelçilikler, ticari ataşelikler ve resmi delegasyonlar için Türk kamu kurumları ve iş dünyasına doğrudan erişim kapısı.',
                ],
                'content' => [
                    'en' => '<p>Our Ankara Executive Office serves as a trusted bridge for accredited embassies, consular departments, and trade missions seeking strategic cooperation, inter-governmental liaison, and protocol assistance in the capital.</p>',
                    'ar' => '<p>يعمل مكتبنا التنفيذي في أنقرة كحلقة وصل معتمدة للبعثات الدبلوماسية والقنصلية والمكاتب التجارية الساعية لتطوير التعاون الاقتصادي والمؤسسي والتنسيق البروتوكولي مع المؤسسات التركية.</p>',
                    'tr' => '<p>Ankara Yönetim Ofisimiz, büyükelçilikler ve ticari heyetler için Türk bakanlıkları ve sanayi odaları ile işbirliği ve protokol süreçlerinde stratejik bir köprüdür.</p>',
                ],
                'meta_title' => [
                    'en' => 'Diplomatic & Embassies Portal — Safir Business Hub',
                    'ar' => 'بوابة السفارات والبعثات الدبلوماسية — ملتقى سفير للأعمال',
                    'tr' => 'Büyükelçilikler Portalı — Safir İş Merkezi',
                ],
                'meta_description' => [
                    'en' => 'Diplomatic protocol, institutional liaison, and sovereign delegation support in Ankara.',
                    'ar' => 'الخدمات الدبلوماسية والبروتوكولية ودعم الوفود الرسمية والسفارات في أنقرة.',
                    'tr' => 'Ankara’da büyükelçilikler için diplomatik protokol ve kurumsal temas hizmetleri.',
                ],
                'is_published' => true,
                'sort_order' => 2,
            ]
        );

        // 1.3 Corporates Portal Page
        $corporatesPage = Page::updateOrCreate(
            ['slug' => 'corporates'],
            [
                'template' => 'corporates',
                'title' => [
                    'en' => 'Corporate Market Entry & FDI',
                    'ar' => 'بوابة الشركات والاستثمار الأجنبي المباشر',
                    'tr' => 'Kurumsal Pazar Girişi ve Doğrudan Yatırımlar',
                ],
                'summary' => [
                    'en' => 'Comprehensive strategic advisory for multinational corporations, institutional investors, and sovereign funds expanding into Türkiye and regional markets.',
                    'ar' => 'حلول استشارية متكاملة للشركات الدولية، والمجموعات الاستثمارية، وصناديق الاستثمار السيادية للتوسع في السوق التركي والأسواق الإقليمية.',
                    'tr' => 'Türkiye ve bölge pazarlarına açılan çok uluslu şirketler ve kurumsal yatırımcılar için uçtan uca stratejik danışmanlık.',
                ],
                'content' => [
                    'en' => '<p>We empower international corporations to navigate Turkish investment incentives, industrial free zones, regulatory compliance, and joint-venture matchmaking with vetted Turkish industrial champions.</p>',
                    'ar' => '<p>نمكن الشركات العالمية من الاستفادة القصوى من حوافز الاستثمار الحكومية، والمناطق الحرة، والامتثال التنظيمي، وبناء شراكات استراتيجية ناجحة مع كبرى الشركات التركية.</p>',
                    'tr' => '<p>Uluslararası şirketlere yatırım teşvikleri, serbest bölgeler, mevzuat uyumu ve stratejik ortaklıklar konusunda kapsamlı rehberlik sunuyoruz.</p>',
                ],
                'meta_title' => [
                    'en' => 'Corporate Market Entry & FDI — Safir Business Hub',
                    'ar' => 'بوابة الشركات والتوسع الاستثماري — ملتقى سفير للأعمال',
                    'tr' => 'Kurumsal Pazar Girişi — Safir İş Merkezi',
                ],
                'meta_description' => [
                    'en' => 'Market entry, B2B matchmaking, and investment incentives for multinational corporations.',
                    'ar' => 'خدمات دخول السوق التركي، وربط الأعمال B2B، وحوافز الاستثمار للشركات العالمية.',
                    'tr' => 'Çok uluslu şirketler için Türkiye pazar girişi ve B2B eşleştirme danışmanlığı.',
                ],
                'is_published' => true,
                'sort_order' => 3,
            ]
        );

        // 1.4 Contact Us & Ankara HQ Page
        $contactPage = Page::updateOrCreate(
            ['slug' => 'contact'],
            [
                'template' => 'contact',
                'title' => [
                    'en' => 'Contact Ankara Headquarters',
                    'ar' => 'الاتصال بالمقر الرئيسي في أنقرة',
                    'tr' => 'Ankara Genel Merkez İletişim',
                ],
                'summary' => [
                    'en' => 'Connect with our executive advisors in Ankara for diplomatic liaison, institutional inquiries, and confidential corporate briefings.',
                    'ar' => 'تواصل مع مستشارينا التنفيذيين في أنقرة للاستفسارات الدبلوماسية، والتعاون المؤسسي، وجلسات الإحاطة الاقتصادية عالية السرية.',
                    'tr' => 'Diplomatik temaslar, kurumsal talepler ve gizli iş görüşmeleri için Ankara’daki danışmanlarımızla iletişime geçin.',
                ],
                'content' => [
                    'en' => '<p>Our headquarters is situated in the central institutional district of Ankara, ensuring swift coordination with ministries, embassies, and regulatory authorities.</p>',
                    'ar' => '<p>يقع مقرنا الرئيسي في قلب العاصمة الدبلوماسية والتنفيذية أنقرة، مما يتيح التنسيق الفوري والمباشر مع الوزارات والبعثات الدبلوماسية والجهات التشريعية.</p>',
                    'tr' => '<p>Genel merkezimiz Ankara’nın diplomatik merkezinde yer almakta olup, bakanlıklar ve büyükelçilikler ile hızlı koordinasyon sağlamaktadır.</p>',
                ],
                'meta_title' => [
                    'en' => 'Contact Us — Safir Business Hub Ankara',
                    'ar' => 'اتصل بنا — ملتقى سفير للأعمال أنقرة',
                    'tr' => 'İletişim — Safir İş Merkezi Ankara',
                ],
                'meta_description' => [
                    'en' => 'Direct contact and confidential briefing requests with Safir Business Hub Ankara HQ.',
                    'ar' => 'تواصل مباشر وطلب جلسات إحاطة مع ملتقى سفير للأعمال في أنقرة.',
                    'tr' => 'Safir İş Merkezi Ankara genel merkezi ile doğrudan iletişim.',
                ],
                'is_published' => true,
                'sort_order' => 4,
            ]
        );

        // 1.5 Research & Reports Center Page
        $reportsPage = Page::updateOrCreate(
            ['slug' => 'reports'],
            [
                'template' => 'default',
                'title' => [
                    'en' => 'Economic Intelligence & Reports Center',
                    'ar' => 'مركز التقارير والدراسات الاقتصادية',
                    'tr' => 'Ekonomik İstihbarat ve Raporlar Merkezi',
                ],
                'summary' => [
                    'en' => 'Rigorous macroeconomic intelligence, sectoral feasibility studies, and regulatory updates curated for sovereign decision-makers and global executives.',
                    'ar' => 'تقارير ودراسات قطاعية معمقة، وتحليلات الاقتصاد الكلي، وتحديثات القوانين واللوائح التنظيمية في السوق التركي.',
                    'tr' => 'Karar vericiler ve iş liderleri için makroekonomik istihbarat, sektörel fizibilite ve mevzuat analizleri.',
                ],
                'content' => [
                    'en' => '<p>Safir Business Hub publishes authoritative sectoral reports covering Turkish Free Zones, energy & defence industrial corridors, agro-commodities, logistics, and foreign direct investment incentives. Our research desk works in close proximity to Ankara statistical institutions to deliver high-precision actionable intelligence.</p>',
                    'ar' => '<p>يصدر ملتقى سفير للأعمال تقارير نوعية وتحليلات استراتيجية تغطي المناطق الحرة، والصناعات الدفاعية، وسلاسل الإمداد، وحوافز الاستثمار الحكومية، لتمكين المستثمرين وصناع القرار من اتخاذ خطوات استثمارية موثوقة.</p>',
                    'tr' => '<p>Safir İş Merkezi, serbest bölgeler, enerji, lojistik ve teşvik politikalarını kapsayan stratejik raporlar yayınlar.</p>',
                ],
                'is_published' => true,
                'sort_order' => 5,
            ]
        );

        // 1.6 Weekly Bulletin Archive Page
        $bulletinPage = Page::updateOrCreate(
            ['slug' => 'bulletin'],
            [
                'template' => 'default',
                'title' => [
                    'en' => 'Weekly Diplomatic & Economic Bulletin',
                    'ar' => 'النشرة الأسبوعية الدبلوماسية والاقتصادية',
                    'tr' => 'Haftalık Diplomatik ve Ekonomik Bülten',
                ],
                'summary' => [
                    'en' => 'A weekly strategic executive summary tracking regulatory decrees, bilateral agreements, sovereign trade visits, and high-level tenders across Türkiye.',
                    'ar' => 'ملخص تنفيذي أسبوعي يرصد أهم القرارات الرسمية، ومذكرات التفاهم الثنائية، ومستجدات التجارة والاستثمار في تركيا.',
                    'tr' => 'Resmi kararlar, ikili anlaşmalar ve haftalık ekonomik gelişmeleri derleyen stratejik yönetici bülteni.',
                ],
                'content' => [
                    'en' => '<p>The Safir Weekly Bulletin provides embassies and corporate subscribers with exclusive weekly coverage of official decisions, ministry circulars, trade delegations, and market trends.</p>',
                    'ar' => '<p>توفر النشرة الأسبوعية تحليلاً موجزاً ودقيقاً لأبرز التطورات الاقتصادية والتجارية وقرارات الجريدة الرسمية التركية.</p>',
                    'tr' => '<p>Haftalık bültenimiz, büyükelçilikler ve iş liderleri için en güncel ekonomik kararları özetler.</p>',
                ],
                'is_published' => true,
                'sort_order' => 6,
            ]
        );

        // 1.7 Services & Four Pillars Hub Page
        $servicesPage = Page::updateOrCreate(
            ['slug' => 'services'],
            [
                'template' => 'default',
                'title' => [
                    'en' => 'Institutional Solutions & Four Pillars',
                    'ar' => 'الحلول المؤسسية وركائز الأعمال الأربع',
                    'tr' => 'Kurumsal Çözümler ve Dört Ana Sütun',
                ],
                'summary' => [
                    'en' => 'Our integrated four pillars: Economy & Knowledge, Relations & Business, Conferences & Events, and Media & Community.',
                    'ar' => 'منظومتنا المتكاملة القائمة على أربع ركائز: الاقتصاد والمعرفة، العلاقات والأعمال، المؤتمرات والفعاليات، والمجتمع والإعلام.',
                    'tr' => 'Dört temel direğimiz: Ekonomi ve Bilgi, İlişkiler ve İş, Etkinlikler ve Konferanslar, Topluluk ve Medya.',
                ],
                'content' => [
                    'en' => '<p>Safir Business Hub operates through four interconnected strategic pillars tailored to bridge international embassies, sovereign entities, and private enterprises with Turkish institutions.</p>',
                    'ar' => '<p>يقدم الملتقى خدماته عبر أربع ركائز رئيسية متكاملة تلبي تطلعات الوفود الدبلوماسية والشركات العالمية في تركيا.</p>',
                    'tr' => '<p>Uluslararası aktörlerin Türkiye’deki hedeflerini gerçekleştirmeleri için tasarlanmış dört stratejik sütun.</p>',
                ],
                'is_published' => true,
                'sort_order' => 7,
            ]
        );

        // 1.8 Sub-pages for Dropdown items
        $subPagesData = [
            [
                'slug' => 'market-studies',
                'title' => ['en' => 'Market Studies & Sectoral Research', 'ar' => 'دراسات السوق والبحوث القطاعية', 'tr' => 'Pazar Araştırmaları ve Sektörel Analiz'],
                'summary' => ['en' => 'In-depth market entry feasibility, competitive landscape mapping, and regulatory evaluations.', 'ar' => 'دراسات الجدوى المتخصصة وتحليل الفرص الاستثمارية والمنافسة في السوق التركي.', 'tr' => 'Derinlemesine pazar fizibilitesi ve rekabet analizleri.'],
            ],
            [
                'slug' => 'political-reports',
                'title' => ['en' => 'Geopolitical & Policy Briefings', 'ar' => 'التقارير الجيوسياسية وتحليلات السياسات', 'tr' => 'Jeopolitik ve Politika Analizleri'],
                'summary' => ['en' => 'Strategic policy analysis examining inter-governmental dynamics, trade treaties, and diplomatic relations.', 'ar' => 'تحليلات سياسية واقتصادية متقدمة حول الاتفاقيات الثنائية والعلاقات الحكومية.', 'tr' => 'Hükümetlerarası dinamikler ve ticaret anlaşmaları analizleri.'],
            ],
            [
                'slug' => 'b2b-matchmaking',
                'title' => ['en' => 'B2B Matchmaking & Private Enterprise', 'ar' => 'التوفيق التجاري وربط الشركات B2B', 'tr' => 'B2B Eşleştirme ve Ticari Ortaklıklar'],
                'summary' => ['en' => 'High-level matchmaking connecting international investors with certified Turkish industrial manufacturers.', 'ar' => 'ربط المستثمرين والشركات الدولية مع كبرى الشركات والمصانع التركية المعتمدة.', 'tr' => 'Uluslararası yatırımcıları onaylı Türk üreticilerle buluşturma.'],
            ],
            [
                'slug' => 'chambers',
                'title' => ['en' => 'Bilateral Chambers of Commerce', 'ar' => 'غرف التجارة والاتحادات الثنائية', 'tr' => 'İkili Ticaret Odaları ve Birlikler'],
                'summary' => ['en' => 'Institutional alliances with industrial chambers, union of chambers (TOBB), and international business councils.', 'ar' => 'شراكات استراتيجية مع غرف الصناعة والتجارة التركية ومجالس الأعمال المشتركة.', 'tr' => 'Sanayi ve ticaret odaları ile kurumsal protokoller.'],
            ],
            [
                'slug' => 'government-relations',
                'title' => ['en' => 'Government Relations & Regulatory Navigation', 'ar' => 'العلاقات الحكومية والتنسيق الوزاري', 'tr' => 'Hükümet İlişkileri ve Mevzuat Yönetimi'],
                'summary' => ['en' => 'Direct liaison with Turkish ministries, presidency investment offices, free zones, and state agencies.', 'ar' => 'التنسيق المباشر مع الوزارات المعنية، ومكتب الاستثمار الرئاسي، وهيئات المناطق الحرة.', 'tr' => 'Bakanlıklar, yatırım ofisleri ve resmi kurumlarla doğrudan koordinasyon.'],
            ],
            [
                'slug' => 'conferences',
                'title' => ['en' => 'Bilateral Conferences & Economic Forums', 'ar' => 'المؤتمرات والمنتديات الاقتصادية الثنائية', 'tr' => 'İkili Konferanslar ve Ekonomik Forumlar'],
                'summary' => ['en' => 'Organizing high-profile summits, bilateral business roundtables, and investment forums in Ankara.', 'ar' => 'تنظيم مؤتمرات الأعمال، والمنتديات الاستثمارية رفيعة المستوى، وطاولات الحوار الثنائية.', 'tr' => 'Ankara’da üst düzey ikili zirveler ve yatırım forumları.'],
            ],
            [
                'slug' => 'press-conferences',
                'title' => ['en' => 'Diplomatic Press & Media Conferences', 'ar' => 'المؤتمرات الصحفية والإعلام الدبلوماسي', 'tr' => 'Diplomatik Basın Toplantıları'],
                'summary' => ['en' => 'Professional media handling, official delegation press briefings, and press release distribution.', 'ar' => 'إدارة المؤتمرات الصحفية الرسمية للوفود والسفارات وتغطية الفعاليات إعلامياً.', 'tr' => 'Resmi heyetler ve büyükelçilikler için profesyonel basın organizasyonları.'],
            ],
            [
                'slug' => 'consular-services',
                'title' => ['en' => 'Consular Support & Delegation Protocols', 'ar' => 'الخدمات القنصلية وبروتوكولات الوفود', 'tr' => 'Konsolosluk Desteği ve Delegasyon Protokolü'],
                'summary' => ['en' => 'End-to-end official reception, executive transportation, translation, and protocol coordination in Ankara.', 'ar' => 'خدمات الاستقبال الرسمي، والمرافقة البروتوكولية، والترجمة المعتمدة لكبار الشخصيات.', 'tr' => 'Resmi heyet karşılama, tercüme ve protokol yönetimi.'],
            ],
            [
                'slug' => 'media-relations',
                'title' => ['en' => 'Strategic Media Relations & Public Affairs', 'ar' => 'العلاقات الإعلامية الاستراتيجية والشؤون العامة', 'tr' => 'Stratejik Medya İlişkileri ve İletişim'],
                'summary' => ['en' => 'Institutional brand positioning, multilingual media dissemination, and thought leadership.', 'ar' => 'بناء الحضور الإعلامي المؤسسي والظهور الصحفي المتخصص عبر وسائل الإعلام التركية والدولية.', 'tr' => 'Çok dilli medya yönetimi ve kurumsal görünürlük stratejileri.'],
            ],
            [
                'slug' => 'civil-society',
                'title' => ['en' => 'Civil Society & Non-Governmental Alliances', 'ar' => 'منظمات المجتمع المدني والشراكات الأهلية', 'tr' => 'Sivil Toplum Kuruluşları ve Ortaklıklar'],
                'summary' => ['en' => 'Cooperation frameworks with international NGOs, development foundations, and academic institutions.', 'ar' => 'بناء جسور التعاون مع المنظمات غير الحكومية الدولية، والمؤسسات التنموية والأكاديمية.', 'tr' => 'Uluslararası sivil toplum kuruluşları ve kalkınma vakıfları ile işbirlikleri.'],
            ],
            [
                'slug' => 'charitable-initiatives',
                'title' => ['en' => 'Sustainable Development & Social Initiatives', 'ar' => 'مبادرات التنمية المستدامة والمسؤولية المجتمعية', 'tr' => 'Sürdürülebilir Kalkınma ve Sosyal İnisiyatifler'],
                'summary' => ['en' => 'Institutional corporate social responsibility, humanitarian programs, and sustainable impact projects.', 'ar' => 'برامج المسؤولية المجتمعية والمشاريع التنموية ذات الأثر المستدام بالتعاون مع الهيئات المعنية.', 'tr' => 'Kurumsal sosyal sorumluluk ve insani kalkınma projeleri.'],
            ],
        ];

        $orderIndex = 10;
        $createdPages = [];
        $createdPages['about'] = $aboutPage;
        $createdPages['embassies'] = $embassiesPage;
        $createdPages['corporates'] = $corporatesPage;
        $createdPages['contact'] = $contactPage;
        $createdPages['reports'] = $reportsPage;
        $createdPages['bulletin'] = $bulletinPage;
        $createdPages['services'] = $servicesPage;

        foreach ($subPagesData as $sp) {
            $createdPages[$sp['slug']] = Page::updateOrCreate(
                ['slug' => $sp['slug']],
                [
                    'template' => 'default',
                    'title' => $sp['title'],
                    'summary' => $sp['summary'],
                    'content' => [
                        'en' => "<p class='lead'>{$sp['summary']['en']}</p><p>For inquiries regarding this portfolio or bespoke diplomatic/corporate execution in Ankara, please contact our executive desk.</p>",
                        'ar' => "<p class='lead'>{$sp['summary']['ar']}</p><p>للحصول على استشارات تفصيلية أو تنسيق مباشر مع فريقنا في أنقرة، يرجى التواصل مع مكتب الإدارة التنفيذية.</p>",
                        'tr' => "<p class='lead'>{$sp['summary']['tr']}</p><p>Detaylı bilgi ve koordinasyon için Ankara yönetim ofisimizle iletişime geçebilirsiniz.</p>",
                    ],
                    'is_published' => true,
                    'sort_order' => $orderIndex++,
                ]
            );
        }

        // ==========================================
        // 2. Seed or Update Menus & MenuItems
        // ==========================================

        // 2.1 Header Navigation Menu
        $headerMenu = Menu::updateOrCreate(
            ['location' => 'header'],
            ['name' => 'Header Navigation', 'is_active' => true]
        );

        // Reset existing header items cleanly to avoid duplicates or broken trees
        MenuItem::where('menu_id', $headerMenu->id)->delete();

        // 1. Pillar 1: Economy & Knowledge
        $pEconomy = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Economy & Knowledge', 'ar' => 'الاقتصاد والمعرفة', 'tr' => 'Ekonomi ve Bilgi'],
            'type' => 'page',
            'page_id' => $createdPages['reports']->id,
            'url' => '/reports',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEconomy->id,
            'label' => ['en' => 'General Reports', 'ar' => 'التقارير العامة', 'tr' => 'Genel Raporlar'],
            'type' => 'page',
            'page_id' => $createdPages['reports']->id,
            'url' => '/reports',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEconomy->id,
            'label' => ['en' => 'Market Studies', 'ar' => 'دراسات السوق', 'tr' => 'Pazar Araştırmaları'],
            'type' => 'page',
            'page_id' => $createdPages['market-studies']->id,
            'url' => '/page/market-studies',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEconomy->id,
            'label' => ['en' => 'Political Reports', 'ar' => 'التقارير السياسية', 'tr' => 'Siyasi Raporlar'],
            'type' => 'page',
            'page_id' => $createdPages['political-reports']->id,
            'url' => '/page/political-reports',
            'sort_order' => 3,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEconomy->id,
            'label' => ['en' => 'Weekly Bulletin', 'ar' => 'النشرة الأسبوعية', 'tr' => 'Haftalık Bülten'],
            'type' => 'page',
            'page_id' => $createdPages['bulletin']->id,
            'url' => '/bulletin',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // 2. Pillar 2: Relations & Business
        $pRelations = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Relations & Business', 'ar' => 'العلاقات والأعمال', 'tr' => 'İlişkiler ve İş'],
            'type' => 'page',
            'page_id' => $createdPages['services']->id,
            'url' => '/services/relations',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pRelations->id,
            'label' => ['en' => 'B2B Matchmaking', 'ar' => 'التوفيق التجاري B2B', 'tr' => 'B2B Eşleştirme'],
            'type' => 'page',
            'page_id' => $createdPages['b2b-matchmaking']->id,
            'url' => '/page/b2b-matchmaking',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pRelations->id,
            'label' => ['en' => 'Chambers of Commerce', 'ar' => 'غرف التجارة', 'tr' => 'Ticaret Odaları'],
            'type' => 'page',
            'page_id' => $createdPages['chambers']->id,
            'url' => '/page/chambers',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pRelations->id,
            'label' => ['en' => 'Government Relations', 'ar' => 'العلاقات الحكومية', 'tr' => 'Hükümet İlişkileri'],
            'type' => 'page',
            'page_id' => $createdPages['government-relations']->id,
            'url' => '/page/government-relations',
            'sort_order' => 3,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pRelations->id,
            'label' => ['en' => 'Embassies Support', 'ar' => 'دعم السفارات', 'tr' => 'Büyükelçilik Desteği'],
            'type' => 'page',
            'page_id' => $createdPages['embassies']->id,
            'url' => '/embassies',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // 3. Pillar 3: Conferences & Events
        $pEvents = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Conferences & Events', 'ar' => 'الفعاليات والمؤتمرات', 'tr' => 'Etkinlikler ve Konferanslar'],
            'type' => 'page',
            'page_id' => $createdPages['services']->id,
            'url' => '/services/events',
            'sort_order' => 3,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEvents->id,
            'label' => ['en' => 'Conferences & Forums', 'ar' => 'المؤتمرات والمنتديات', 'tr' => 'Konferanslar ve Forumlar'],
            'type' => 'page',
            'page_id' => $createdPages['conferences']->id,
            'url' => '/page/conferences',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEvents->id,
            'label' => ['en' => 'Press Conferences', 'ar' => 'المؤتمرات الصحفية', 'tr' => 'Basın Toplantıları'],
            'type' => 'page',
            'page_id' => $createdPages['press-conferences']->id,
            'url' => '/page/press-conferences',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pEvents->id,
            'label' => ['en' => 'Consular Services', 'ar' => 'الخدمات القنصلية', 'tr' => 'Konsolosluk Hizmetleri'],
            'type' => 'page',
            'page_id' => $createdPages['consular-services']->id,
            'url' => '/page/consular-services',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // 4. Pillar 4: Media & Community
        $pCommunity = MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Media & Community', 'ar' => 'المجتمع والإعلام', 'tr' => 'Topluluk ve Medya'],
            'type' => 'page',
            'page_id' => $createdPages['services']->id,
            'url' => '/services/community',
            'sort_order' => 4,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pCommunity->id,
            'label' => ['en' => 'Media Relations', 'ar' => 'العلاقات الإعلامية', 'tr' => 'Medya İlişkileri'],
            'type' => 'page',
            'page_id' => $createdPages['media-relations']->id,
            'url' => '/page/media-relations',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pCommunity->id,
            'label' => ['en' => 'Civil Society', 'ar' => 'المجتمع المدني', 'tr' => 'Sivil Toplum'],
            'type' => 'page',
            'page_id' => $createdPages['civil-society']->id,
            'url' => '/page/civil-society',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'parent_id' => $pCommunity->id,
            'label' => ['en' => 'Charitable Initiatives', 'ar' => 'المبادرات الخيرية', 'tr' => 'Sosyal İnisiyatifler'],
            'type' => 'page',
            'page_id' => $createdPages['charitable-initiatives']->id,
            'url' => '/page/charitable-initiatives',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // 5. Direct Link: Embassies
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Embassies', 'ar' => 'السفارات', 'tr' => 'Büyükelçilikler'],
            'type' => 'page',
            'page_id' => $createdPages['embassies']->id,
            'url' => '/embassies',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        // 6. Direct Link: Corporates
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Corporates', 'ar' => 'الشركات', 'tr' => 'Şirketler'],
            'type' => 'page',
            'page_id' => $createdPages['corporates']->id,
            'url' => '/corporates',
            'sort_order' => 6,
            'is_active' => true,
        ]);

        // 7. Direct Link: Reports
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Reports', 'ar' => 'التقارير', 'tr' => 'Raporlar'],
            'type' => 'page',
            'page_id' => $createdPages['reports']->id,
            'url' => '/reports',
            'sort_order' => 7,
            'is_active' => true,
        ]);

        // 8. Direct Link: About Us
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'About Us', 'ar' => 'عن المنصة', 'tr' => 'Hakkımızda'],
            'type' => 'page',
            'page_id' => $createdPages['about']->id,
            'url' => '/about',
            'sort_order' => 8,
            'is_active' => true,
        ]);

        // 9. Direct Link: Contact Us
        MenuItem::create([
            'menu_id' => $headerMenu->id,
            'label' => ['en' => 'Contact Us', 'ar' => 'اتصل بنا', 'tr' => 'İletişim'],
            'type' => 'page',
            'page_id' => $createdPages['contact']->id,
            'url' => '/contact',
            'sort_order' => 9,
            'is_active' => true,
        ]);

        // 2.2 Footer Quick Links Menu
        $footerQuickMenu = Menu::updateOrCreate(
            ['location' => 'footer_quick_links'],
            ['name' => 'Footer Quick Links', 'is_active' => true]
        );
        MenuItem::where('menu_id', $footerQuickMenu->id)->delete();

        $footerQuickItems = [
            ['label' => ['en' => 'Embassies Portal', 'ar' => 'بوابة السفارات', 'tr' => 'Büyükelçilik Portalı'], 'type' => 'page', 'page_id' => $createdPages['embassies']->id, 'url' => '/embassies', 'sort_order' => 1],
            ['label' => ['en' => 'Corporate Entry', 'ar' => 'دخول الشركات', 'tr' => 'Kurumsal Giriş'], 'type' => 'page', 'page_id' => $createdPages['corporates']->id, 'url' => '/corporates', 'sort_order' => 2],
            ['label' => ['en' => 'Economic Reports', 'ar' => 'التقارير الاقتصادية', 'tr' => 'Ekonomik Raporlar'], 'type' => 'page', 'page_id' => $createdPages['reports']->id, 'url' => '/reports', 'sort_order' => 3],
            ['label' => ['en' => 'Weekly Bulletin', 'ar' => 'النشرة الأسبوعية', 'tr' => 'Haftalık Bülten'], 'type' => 'page', 'page_id' => $createdPages['bulletin']->id, 'url' => '/bulletin', 'sort_order' => 4],
            ['label' => ['en' => 'About Safir Hub', 'ar' => 'عن سفير هب', 'tr' => 'Safir Hub Hakkında'], 'type' => 'page', 'page_id' => $createdPages['about']->id, 'url' => '/about', 'sort_order' => 5],
            ['label' => ['en' => 'Contact Ankara HQ', 'ar' => 'الاتصال بالمقر الرئيسي', 'tr' => 'Ankara Genel Merkez'], 'type' => 'page', 'page_id' => $createdPages['contact']->id, 'url' => '/contact', 'sort_order' => 6],
        ];

        foreach ($footerQuickItems as $itemData) {
            $itemData['menu_id'] = $footerQuickMenu->id;
            $itemData['target'] = '_self';
            $itemData['is_active'] = true;
            MenuItem::create($itemData);
        }

        // 2.3 Footer Four Pillars Menu
        $footerPillarsMenu = Menu::updateOrCreate(
            ['location' => 'footer_pillars'],
            ['name' => 'Footer Four Pillars', 'is_active' => true]
        );
        MenuItem::where('menu_id', $footerPillarsMenu->id)->delete();

        $footerPillarsItems = [
            ['label' => ['en' => 'Economy & Knowledge', 'ar' => 'الاقتصاد والمعرفة', 'tr' => 'Ekonomi ve Bilgi'], 'type' => 'url', 'url' => '/services/economy', 'sort_order' => 1],
            ['label' => ['en' => 'Relations & Business', 'ar' => 'العلاقات والأعمال', 'tr' => 'İlişkiler ve İş'], 'type' => 'url', 'url' => '/services/relations', 'sort_order' => 2],
            ['label' => ['en' => 'Conferences & Events', 'ar' => 'الفعاليات والمؤتمرات', 'tr' => 'Etkinlikler ve Konferanslar'], 'type' => 'url', 'url' => '/services/events', 'sort_order' => 3],
            ['label' => ['en' => 'Media & Community', 'ar' => 'المجتمع والإعلام', 'tr' => 'Topluluk ve Medya'], 'type' => 'url', 'url' => '/services/community', 'sort_order' => 4],
            ['label' => ['en' => 'All Services & Portals', 'ar' => 'كافة الخدمات والحلول', 'tr' => 'Tüm Hizmetler'], 'type' => 'page', 'page_id' => $createdPages['services']->id, 'url' => '/services', 'sort_order' => 5],
        ];

        foreach ($footerPillarsItems as $itemData) {
            $itemData['menu_id'] = $footerPillarsMenu->id;
            $itemData['target'] = '_self';
            $itemData['is_active'] = true;
            MenuItem::create($itemData);
        }
    }
}
