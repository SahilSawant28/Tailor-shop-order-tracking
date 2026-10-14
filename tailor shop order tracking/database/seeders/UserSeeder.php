<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * UserSeeder
 *
 * Creates the default admin and staff users for development.
 * These are ONLY for testing. In production, create real users.
 *
 * Run with: php artisan db:seed --class=UserSeeder
 * Or:       php artisan db:seed (runs DatabaseSeeder which calls this)
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin User ───────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@tailor.test'],
            [
                'name'      => 'Admin User',
                'email'     => 'admin@tailor.test',
                'phone'     => '9800000001',
                'password'  => Hash::make('password'),  // Laravel hashes automatically via casts
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        // ─── Staff User ───────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'staff@tailor.test'],
            [
                'name'      => 'Staff Tailor',
                'email'     => 'staff@tailor.test',
                'phone'     => '9800000002',
                'password'  => Hash::make('password'),
                'role'      => 'staff',
                'is_active' => true,
            ]
        );

        $this->command->info('✓ Admin user created: admin@tailor.test / password');
        $this->command->info('✓ Staff user created: staff@tailor.test / password');
    }
}
