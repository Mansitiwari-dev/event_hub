<?php
// fix_seeders.php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Role;
use App\Models\Service;
use App\Models\Event;

// 1. Check and fix ServiceSeeder
echo "=== Fixing Service Seeder ===\n";
$vendors = User::whereHas('role', function($q) {
    $q->where('name', Role::VENDOR);
})->get();

if ($vendors->isEmpty()) {
    echo "No vendor users found. Please run UserSeeder first.\n";
} else {
    foreach ($vendors as $vendor) {
        $service = Service::firstOrCreate(
            ['provider_id' => $vendor->id, 'name' => $vendor->name . ' Basic Package'],
            [
                'description' => 'Professional services by ' . $vendor->name,
                'price' => 5000,
                'is_available' => true,
                'type' => 'standard',
                'duration' => '2 hours',
            ]
        );
        echo "Service created/updated for {$vendor->name}: {$service->name}\n";
    }
}

// 2. Check and fix EventsSeeder
echo "\n=== Fixing Events Seeder ===\n";
$organizers = User::whereHas('role', function($q) {
    $q->where('name', 'organizer');
})->get();

$customers = User::whereHas('role', function($q) {
    $q->where('name', Role::CUSTOMER);
})->get();

if ($organizers->isEmpty() || $customers->isEmpty()) {
    echo "Need at least one organizer and one customer to create events\n";
} else {
    foreach ($organizers as $organizer) {
        $event = Event::firstOrCreate(
            ['title' => 'Sample Event by ' . $organizer->name],
            [
                'description' => 'This is a sample event description.',
                'event_type' => 'conference',
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(8),
                'location' => 'Main Hall',
                'guest_count' => 100,
                'budget' => 5000,
                'status' => 'upcoming',
                'event_manager_id' => $organizer->id,
                'customer_id' => $customers->first()->id,
            ]
        );
        echo "Event created/updated: {$event->title}\n";
    }
}

// 3. Verify data
echo "\n=== Verifying Data ===\n";
echo "Total services: " . Service::count() . "\n";
echo "Total events: " . Event::count() . "\n";