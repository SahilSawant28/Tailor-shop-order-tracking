<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder — Master seeder
 *
 * This is the entry point for all seeders.
 * Run with: php artisan db:seed
 *
 * Each phase will add more seeders here as we build the app.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Phase 2: Create admin and staff users
        $this->call(UserSeeder::class);

        // Phase 4: Customer seeder will be added here
        // $this->call(CustomerSeeder::class);

        // Phase 6: Garment seeder will be added here
        // $this->call(GarmentSeeder::class);

        // Phase 7: Sample orders will be added here
        // $this->call(OrderSeeder::class);
    }
}
