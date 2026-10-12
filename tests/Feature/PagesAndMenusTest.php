<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\User;
use Database\Seeders\PageAndMenuSeeder;
use Database\Seeders\SafirPlatformSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesAndMenusTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SettingSeeder::class);
        $this->seed(SafirPlatformSeeder::class);
        $this->seed(PageAndMenuSeeder::class);
    }

    protected function getAdminUser(): User
    {
        return User::firstOrCreate(
            ['email' => 'admin_test@safirbusiness.com'],
            [
                'name' => 'Admin Tester',
                'password' => bcrypt('password'),
                'role' => UserRole::Superadmin,
                'is_active' => true,
            ]
        );
    }

    public function test_public_about_page_renders_successfully(): void
    {
        $response = $this->get('/en/about');
        $response->assertStatus(200);
        $response->assertSee('Dr. Shams Al-Din Al-Tamimi');
        $response->assertSee('Eng. Tariq Al-Hashimi');
    }

    public function test_dynamic_page_renders_successfully(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'test-governance'],
            [
                'template' => 'default',
                'title' => ['en' => 'Corporate Governance Framework'],
                'content' => ['en' => '<p>Institutional compliance details.</p>'],
                'is_published' => true,
            ]
        );

        $response = $this->get('/en/page/test-governance');
        $response->assertStatus(200);
        $response->assertSee('Corporate Governance Framework');
        $response->assertSee('Institutional compliance details.');
    }

    public function test_admin_can_access_pages_management(): void
    {
        $admin = $this->getAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.pages.index'));
        $response->assertStatus(200);
        $response->assertSee('Pages Management');
    }

    public function test_admin_can_create_and_delete_page(): void
    {
        $admin = $this->getAdminUser();

        $response = $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title_en' => 'Investment Protocol 2026',
            'slug' => 'investment-protocol-2026',
            'template' => 'default',
            'summary_en' => 'Overview of FDI incentives',
            'content_en' => '<p>Detailed content here</p>',
            'is_published' => 1,
            'sort_order' => 5,
        ]);

        $response->assertRedirect(route('admin.pages.index'));
        $this->assertDatabaseHas('pages', ['slug' => 'investment-protocol-2026']);

        $page = Page::where('slug', 'investment-protocol-2026')->first();
        $this->assertNotNull($page);

        // Delete page
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.pages.destroy', $page));
        $deleteResponse->assertRedirect(route('admin.pages.index'));
        $this->assertDatabaseMissing('pages', ['slug' => 'investment-protocol-2026']);
    }

    public function test_admin_can_access_menus_and_manage_items(): void
    {
        $admin = $this->getAdminUser();

        $menu = Menu::firstOrCreate(
            ['location' => 'test_menu'],
            ['name' => 'Test Navigation', 'is_active' => true]
        );

        $response = $this->actingAs($admin)->get(route('admin.menus.show', $menu));
        $response->assertStatus(200);
        $response->assertSee('Test Navigation');

        // Add menu item
        $addResponse = $this->actingAs($admin)->post(route('admin.menus.items.store', $menu), [
            'label_en' => 'Strategic Research',
            'type' => 'url',
            'url' => '/research',
            'target' => '_self',
            'is_active' => 1,
        ]);

        $addResponse->assertRedirect();
        $this->assertDatabaseHas('menu_items', [
            'menu_id' => $menu->id,
            'url' => '/research',
        ]);

        $item = MenuItem::where('menu_id', $menu->id)->where('url', '/research')->first();
        $this->assertNotNull($item);

        // Delete menu item
        $delResponse = $this->actingAs($admin)->delete(route('admin.menus.items.destroy', [$menu, $item]));
        $delResponse->assertRedirect();
        $this->assertDatabaseMissing('menu_items', ['id' => $item->id]);
    }

    public function test_all_platform_pages_and_menus_render_dynamically(): void
    {
        // 1. Home page renders dynamic header menu items
        $response = $this->get('/en');
        $response->assertStatus(200);
        $response->assertSee('Economy & Knowledge');
        $response->assertSee('General Reports');
        $response->assertSee('Market Studies');
        $response->assertSee('Embassies');
        $response->assertSee('Corporates');
        $response->assertSee('About Us');
        $response->assertSee('Contact Us');

        // 2. Embassies page renders with editable page content
        $embassiesResp = $this->get('/en/embassies');
        $embassiesResp->assertStatus(200);
        $embassiesResp->assertSee('Diplomatic & Embassies Portal');

        // 3. Corporates page renders with editable page content
        $corporatesResp = $this->get('/en/corporates');
        $corporatesResp->assertStatus(200);
        $corporatesResp->assertSee('Corporate Market Entry & FDI');

        // 4. Contact page renders with editable page content
        $contactResp = $this->get('/en/contact');
        $contactResp->assertStatus(200);
        $contactResp->assertSee('Contact Ankara Headquarters');

        // 5. Updating Page content immediately reflects on the public view
        $embassiesPage = Page::where('slug', 'embassies')->first();
        $this->assertNotNull($embassiesPage);
        $embassiesPage->update([
            'title' => [
                'en' => 'Custom Executive Diplomatic Gateway',
                'ar' => 'بوابة السفارات الدبلوماسية المخصصة',
                'tr' => 'Özel Diplomatik Kapı',
            ],
        ]);

        $updatedResp = $this->get('/en/embassies');
        $updatedResp->assertStatus(200);
        $updatedResp->assertSee('Custom Executive Diplomatic Gateway');
    }

    public function test_admin_can_add_hierarchical_menu_item_linked_to_page(): void
    {
        $admin = $this->getAdminUser();
        $headerMenu = Menu::where('location', 'header')->first();
        $parentItem = $headerMenu->items()->whereNull('parent_id')->first();
        $targetPage = Page::where('slug', 'market-studies')->first();

        $response = $this->actingAs($admin)->post(route('admin.menus.items.store', $headerMenu), [
            'label_en' => 'Bespoke Sector Briefing',
            'type' => 'page',
            'page_id' => $targetPage->id,
            'parent_id' => $parentItem->id,
            'target' => '_self',
            'is_active' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('menu_items', [
            'menu_id' => $headerMenu->id,
            'parent_id' => $parentItem->id,
            'page_id' => $targetPage->id,
            'type' => 'page',
        ]);
    }
}
