<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\VendorProfile;
use App\Models\User;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = VendorProfile::all();
        $customers = User::whereHas('role', fn($q) => $q->where('name','customer'))->get();
        if ($vendors->isEmpty() || $customers->isEmpty()) return;

        foreach ($vendors as $vendor) {
            $sample = [
                'Excellent service, highly recommend.',
                'Good communication and timely delivery.',
                'Professional but pricey.',
                'Amazing work — will hire again.'
            ];

            $customers->random(2)->each(function($cust) use ($vendor, $sample) {
                Review::firstOrCreate([
                    'vendor_profile_id' => $vendor->id,
                    'customer_id' => $cust->id
                ], [
                    'rating' => rand(3,5),
                    'comments' => $sample[array_rand($sample)]
                ]);
            });
        }
    }
}
