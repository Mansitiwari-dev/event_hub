<?php

namespace Database\Seeders;

use App\Models\VendorSpecialization;
use Illuminate\Database\Seeder;

class VendorSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            [
                'name' => 'decoration',
                'description' => 'Event decoration and setup services',
                'icon' => 'decoration',
            ],
            [
                'name' => 'catering',
                'description' => 'Food and beverage catering services',
                'icon' => 'catering',
            ],
            [
                'name' => 'security',
                'description' => 'Event security and protection services',
                'icon' => 'security',
            ],
            [
                'name' => 'music',
                'description' => 'Live music performance services',
                'icon' => 'music',
            ],
            [
                'name' => 'dj',
                'description' => 'DJ and sound mixing services',
                'icon' => 'dj',
            ],
            [
                'name' => 'hosting',
                'description' => 'Event hosting and MC services',
                'icon' => 'hosting',
            ],
            [
                'name' => 'photography',
                'description' => 'Photography and photo services',
                'icon' => 'photography',
            ],
            [
                'name' => 'videography',
                'description' => 'Video recording and editing services',
                'icon' => 'videography',
            ],
            [
                'name' => 'flowers',
                'description' => 'Floral arrangements and decorations',
                'icon' => 'flowers',
            ],
            [
                'name' => 'transportation',
                'description' => 'Event transportation services',
                'icon' => 'transportation',
            ],
        ];

        foreach ($specializations as $specialization) {
            VendorSpecialization::firstOrCreate(
                ['name' => $specialization['name']],
                $specialization
            );
        }
    }
}
