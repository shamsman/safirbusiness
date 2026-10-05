<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed or update the Superadmin account
        User::updateOrCreate(
            ['email' => 'shamsman1@gmail.com'],
            [
                'name'              => 'Shams Superadmin',
                'password'          => Hash::make('271119800'),
                'role'              => UserRole::Superadmin,
                'phone'             => '+90 555 123 4567',
                'is_active'         => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed a sample admin and editor for demo / role-testing if needed
        User::firstOrCreate(
            ['email' => 'admin@safirbusiness.com'],
            [
                'name'              => 'Operations Admin',
                'password'          => Hash::make('SafirAdmin2026!'),
                'role'              => UserRole::Admin,
                'phone'             => '+90 312 400 1122',
                'is_active'         => true,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'editor@safirbusiness.com'],
            [
                'name'              => 'Content Editor',
                'password'          => Hash::make('SafirEditor2026!'),
                'role'              => UserRole::Editor,
                'phone'             => '+90 312 400 3344',
                'is_active'         => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
