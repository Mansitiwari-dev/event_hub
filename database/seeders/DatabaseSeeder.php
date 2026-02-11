<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            VendorSpecializationSeeder::class,
            UsersSeeder::class,
            VendorProfileSeeder::class,
            ServiceSeeder::class,
            EventsSeeder::class,
            BookingsSeeder::class,
            ReviewsSeeder::class,
            TeamsSeeder::class,
        ]);
    }
}
