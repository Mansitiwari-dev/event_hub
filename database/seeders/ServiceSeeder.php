<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = \App\Models\User::whereHas('role', function($q) {
            $q->where('name', \App\Models\Role::VENDOR);
        })->get();

        if ($vendors->isEmpty()) {
            echo "No vendor users found. Please run UserSeeder first.\n";
            return;
        }

        foreach ($vendors as $vendor) {
            \App\Models\Service::firstOrCreate(
                ['provider_id' => $vendor->id, 'name' => $vendor->name . ' Basic Package'],
                [
                    'description' => 'Professional services by ' . $vendor->name,
                    'price' => 5000,
                    'is_available' => true,
                    'type' => 'decorator',
                    'duration' => '2 hours',
                ]
            );
            echo "Created service for vendor: " . $vendor->name . "\n";
        }
    }
}