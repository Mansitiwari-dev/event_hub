<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Carbon;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        $managers = User::whereHas('role', fn($q) => $q->where('name','event_manager'))->get();
        $customer = User::whereHas('role', fn($q) => $q->where('name','customer'))->first();
        
        if (!$customer) {
            $this->command->warn('No customer found. Please run UsersSeeder first.');
            return;
        }

        $i = 1;
        foreach ($managers as $m) {
            Event::firstOrCreate([
                'title' => "Demo Event {$i} by {$m->name}",
                'event_manager_id' => $m->id
            ], [
                'customer_id' => $customer->id,  // Added customer_id
                'description' => 'Demo event for testing',
                'event_type' => 'wedding',
                'start_date' => Carbon::now()->addDays(7 * $i),
                'end_date' => Carbon::now()->addDays(7 * $i)->addHours(6),       
                'location' => 'Banquet Hall',
                'guest_count' => 150 + ($i * 10),
                'budget' => 50000 + ($i * 2000),
                'status' => 'pending'
            ]);
            $i++;
        }
    }
}