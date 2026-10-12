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
}
