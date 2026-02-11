<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Get role IDs using the Role model constants
        $customerRole = Role::where('name', Role::CUSTOMER)->firstOrFail();
        $organizerRole = Role::where('name', 'organizer')->firstOrFail();
        $vendorRole = Role::where('name', Role::VENDOR)->firstOrFail();

        // Create sample customers
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'John Customer',
                'password' => Hash::make('password'),
                'phone' => '+1234567890',
                'address' => '123 Customer St, City',
                'role_id' => $customerRole->id,
                'is_active' => true,
            ]
        );

        // Create sample event organizer
        User::updateOrCreate(
            ['email' => 'organizer@example.com'],
            [
                'name' => 'Event Organizer Pro',
                'password' => Hash::make('password'),
                'phone' => '+1111111111',
                'address' => '456 Event Ave, City',
                'role_id' => $organizerRole->id,
                'is_active' => true,
            ]
        );

        // Create sample vendors
        $vendors = [
            [
                'email' => 'decorator@example.com',
                'name' => 'Elegant Decorators',
                'phone' => '+2222222222',
                'address' => '123 Design St, City',
            ],
            [
                'email' => 'catering@example.com',
                'name' => 'Gourmet Catering Co',
                'phone' => '+3333333333',
                'address' => '456 Kitchen Ave, City',
            ],
            [
                'email' => 'dj@example.com',
                'name' => 'Sound & Lights Pro',
                'phone' => '+4444444444',
                'address' => '789 Sound Blvd, City',
            ],
            [
                'email' => 'security@example.com',
                'name' => 'Secure Events Security',
                'phone' => '+5555555555',
                'address' => '321 Guard Lane, City',
            ]
        ];

        foreach ($vendors as $vendor) {
            User::updateOrCreate(
                ['email' => $vendor['email']],
                array_merge($vendor, [
                    'password' => Hash::make('password'),
                    'role_id' => $vendorRole->id,
                    'is_active' => true,
                ])
            );
        }
    }
}