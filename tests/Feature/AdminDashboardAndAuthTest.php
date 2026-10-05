<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardAndAuthTest extends TestCase
{
    /**
     * Test admin login with seeded credentials.
     */
    public function test_admin_can_login_with_provided_credentials(): void
    {
        $response = $this->post('/login', [
            'email'    => 'shamsman1@gmail.com',
            'password' => '271119800',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
        $this->assertTrue(auth()->user()->isSuperadmin());
    }

    /**
     * Test login failure with incorrect credentials.
     */
    public function test_login_fails_with_invalid_password(): void
    {
        $response = $this->post('/login', [
            'email'    => 'shamsman1@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test guest user self-registration always assigns Guest role.
     */
    public function test_registration_assigns_guest_role(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'New Delegate',
            'email'                 => 'delegate@embassy.org',
            'phone'                 => '+90 555 999 8877',
            'password'              => 'DelegatePass2026!',
            'password_confirmation' => 'DelegatePass2026!',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();

        $user = User::where('email', 'delegate@embassy.org')->first();
        $this->assertNotNull($user);
        $this->assertEquals(UserRole::Guest, $user->role);
    }

    /**
     * Test Guest role is blocked from /admin/users and /admin/settings.
     */
    public function test_guest_cannot_access_user_management_or_settings(): void
    {
        $guest = User::factory()->create([
            'role'      => UserRole::Guest,
            'is_active' => true,
        ]);

        $this->actingAs($guest);

        $usersResponse = $this->get('/admin/users');
        $usersResponse->assertStatus(403);

        $settingsResponse = $this->get('/admin/settings');
        $settingsResponse->assertStatus(403);
    }

    /**
     * Test Superadmin can access dashboard, users, and settings.
     */
    public function test_superadmin_has_full_access(): void
    {
        $superadmin = User::where('email', 'shamsman1@gmail.com')->first();
        $this->actingAs($superadmin);

        $dashResponse = $this->get('/admin');
        $dashResponse->assertStatus(200);

        $usersResponse = $this->get('/admin/users');
        $usersResponse->assertStatus(200);

        $settingsResponse = $this->get('/admin/settings');
        $settingsResponse->assertStatus(200);
    }

    /**
     * Test Superadmin can create a user.
     */
    public function test_superadmin_can_create_user(): void
    {
        $superadmin = User::where('email', 'shamsman1@gmail.com')->first();
        $this->actingAs($superadmin);

        $response = $this->post('/admin/users', [
            'name'                  => 'Senior Economic Editor',
            'email'                 => 'economic.editor@safirbusiness.com',
            'phone'                 => '+90 312 900 1122',
            'role'                  => 'editor',
            'password'              => 'SafirEditor2026!',
            'password_confirmation' => 'SafirEditor2026!',
            'is_active'             => '1',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'economic.editor@safirbusiness.com',
            'role'  => 'editor',
        ]);
    }

    /**
     * Test updating website settings.
     */
    public function test_settings_can_be_updated_and_retrieved(): void
    {
        $superadmin = User::where('email', 'shamsman1@gmail.com')->first();
        $this->actingAs($superadmin);

        $response = $this->post('/admin/settings', [
            'site_name'     => 'Safir Sovereign Hub',
            'contact_email' => 'sovereign@safirbusiness.com',
            'contact_phone' => '+90 312 888 7766',
        ]);

        $response->assertRedirect('/admin/settings?tab=general');

        $this->assertEquals('Safir Sovereign Hub', setting('site_name'));
        $this->assertEquals('sovereign@safirbusiness.com', setting('contact_email'));
        $this->assertEquals('+90 312 888 7766', setting('contact_phone'));
    }
}
