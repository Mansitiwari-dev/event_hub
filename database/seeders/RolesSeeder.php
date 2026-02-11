<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Event customer who can create and manage events',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'event_manager',
                'display_name' => 'Event Manager',
                'description' => 'Manages events and hires vendors for event services',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'vendor',
                'display_name' => 'Vendor',
                'description' => 'Provides services for events',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'venue_manager',
                'display_name' => 'Venue Manager',
                'description' => 'Manages venue bookings and availability',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Using insert instead of create to avoid mass assignment issues
        DB::table('roles')->insert($roles);
    }
}