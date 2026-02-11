<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use App\Models\Service;

class BookingsSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::whereHas('role', fn($q) => $q->where('name','customer'))->get();
        $events = Event::all();
        $services = Service::all();
        
        // Skip if we don't have the minimum required data
        if ($events->isEmpty() || $customers->isEmpty() || $services->isEmpty()) {
            $this->command->info('Skipping BookingsSeeder - Not enough data (events, customers, or services)');
            return;
        }

        $i = 0;
        foreach ($customers as $c) {
            $event = $events[$i % $events->count()];
            $service = $services->random();

            Booking::firstOrCreate([
                'event_id' => $event->id,
                'customer_id' => $c->id
            ], [
                'service_id' => $service->id,
                'provider_id' => $service->provider_id,
                'amount' => $service->price,
                'status' => 'pending'
            ]);

            $i++;
        }
    }
}
