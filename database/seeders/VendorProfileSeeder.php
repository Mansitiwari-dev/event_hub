<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VendorProfile;
use App\Models\Role;

class VendorProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Get users with the 'vendor' role
        $vendors = User::whereHas('role', function($q) {
            $q->where('name', Role::VENDOR); // Using the constant from Role model
        })->get();

        foreach ($vendors as $vendor) {
            VendorProfile::firstOrCreate(
                ['user_id' => $vendor->id],
                [
                    'bio' => 'Professional services by '.$vendor->name,
                    'phone' => '999999999'.($vendor->id % 10),
                    'address' => 'City Center',
                    'website' => null,
                ]
            );
        }
    }
}