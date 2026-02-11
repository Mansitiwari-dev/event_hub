<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
            [
                'name' => Role::ADMIN,
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'organizer',  // Changed from 'event_manager' to match Role::ORGANIZER
                'display_name' => 'Event Organizer',
                'description' => 'Manages event bookings and coordinates services',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => Role::CUSTOMER,
                'display_name' => 'Customer',
                'description' => 'Event customer who can create and manage events',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => Role::VENDOR,  // Using VENDOR for all vendor types
                'display_name' => 'Vendor',
                'description' => 'Provides services for events',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Using insert instead of create to avoid mass assignment issues
        DB::table('roles')->insert($roles);
    }
}