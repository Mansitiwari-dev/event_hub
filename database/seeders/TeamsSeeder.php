<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;

class TeamsSeeder extends Seeder
{
    public function run(): void
    {
        $providers = User::whereHas('role', fn($q) => $q->where('name','provider'))->get();
        if ($providers->isEmpty()) return;

        // Get an event to associate with the team
        $event = \App\Models\Event::first();
        
        if (!$event) {
            $this->command->info('No events found. Creating a sample event for the team...');
            $event = \App\Models\Event::create([
                'title' => 'Sample Event',
                'description' => 'Sample event for team assignment',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(31),
                'customer_id' => 1, // Assuming admin user with ID 1 exists
            ]);
        }
        
        // Create a couple of demo teams and attach providers
        $teamA = Team::firstOrCreate(
            ['team_name' => 'Alpha Team'], 
            [
                'event_id' => $event->id,
                'description' => 'Core vendor team for events'
            ]
        );
        
        $teamB = Team::firstOrCreate(
            ['team_name' => 'Bravo Team'], 
            [
                'event_id' => $event->id,
                'description' => 'Backup vendor team'
            ]
        );

        $teamA->vendors()->sync($providers->take(2)->pluck('id')->toArray());
        $teamB->vendors()->sync($providers->slice(2)->pluck('id')->toArray());
    }
}
