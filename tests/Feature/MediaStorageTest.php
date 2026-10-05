<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaStorageTest extends TestCase
{
    use RefreshDatabase;

    public function test_media_disk_and_url_helpers(): void
    {
        Storage::fake('gcs');

        Storage::disk('gcs')->put('test/image.png', 'dummy-data');

        $this->assertTrue(Storage::disk('gcs')->exists('test/image.png'));
        
        $url = media_url('test/image.png');
        $this->assertNotEmpty($url);
        $this->assertStringContainsString('test/image.png', $url);
    }

    public function test_admin_can_upload_branding_logo_to_media_storage(): void
    {
        Storage::fake('gcs');

        $admin = User::factory()->create([
            'role' => UserRole::Superadmin,
            'is_active' => true,
        ]);

        $file = UploadedFile::fake()->image('logo.png', 200, 60);

        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'active_tab' => 'branding',
            'site_logo' => $file,
        ]);

        $response->assertRedirect(route('admin.settings.index', ['tab' => 'branding']));

        $storedLogo = Setting::get('site_logo');
        $this->assertNotEmpty($storedLogo);
        $this->assertTrue(Storage::disk('gcs')->exists($storedLogo));
    }

    public function test_user_avatar_can_be_uploaded_to_media_storage(): void
    {
        Storage::fake('gcs');

        $admin = User::factory()->create([
            'role' => UserRole::Superadmin,
            'is_active' => true,
        ]);

        $targetUser = User::factory()->create([
            'role' => UserRole::Editor,
            'is_active' => true,
        ]);

        $avatar = UploadedFile::fake()->image('avatar.jpg', 150, 150);

        $response = $this->actingAs($admin)->put(route('admin.users.update', $targetUser), [
            'name' => 'Updated User',
            'email' => $targetUser->email,
            'role' => UserRole::Editor->value,
            'avatar' => $avatar,
        ]);

        $response->assertRedirect(route('admin.users.index'));

        $targetUser->refresh();
        $this->assertNotNull($targetUser->avatar);
        $this->assertTrue(Storage::disk('gcs')->exists($targetUser->avatar));
        $this->assertStringContainsString('avatars/', $targetUser->avatar);
        $this->assertStringContainsString($targetUser->avatar, $targetUser->avatarUrl());
    }
}
