<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access'
            ],
            [
                'name' => 'organizer',
                'display_name' => 'Event Organizer',
                'description' => 'Manages event bookings and coordinates services'
            ],
            [
                'name' => 'vendor',
                'display_name' => 'Vendor',
                'description' => 'Provides services for events'
            ],
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Event customer who can create and manage events'
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}