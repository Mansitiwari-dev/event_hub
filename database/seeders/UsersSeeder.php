<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin'], [
            'display_name' => 'Administrator',
            'description' => 'System Administrator with full access'
        ]);
        
        $managerRole = Role::firstOrCreate(['name' => 'event_manager'], [
            'display_name' => 'Event Manager',
            'description' => 'Manages events and bookings'
        ]);
        
        $providerRole = Role::firstOrCreate(['name' => 'provider'], [
            'display_name' => 'Service Provider',
            'description' => 'Vendor providing services for events'
        ]);
        
        $customerRole = Role::firstOrCreate(['name' => 'customer'], [
            'display_name' => 'Customer',
            'description' => 'Regular customer who books events'
        ]);

        // Admin
        User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        // Event managers
        foreach (['Ravi Manager', 'Priya Manager'] as $i => $name) {
            User::firstOrCreate([
                'email' => 'manager'.($i+1).'@example.com'
            ], [
                'name' => $name,
                'password' => Hash::make('password'),
                'role_id' => $managerRole->id,
                'is_active' => true,
            ]);
        }

        // Providers
        foreach (['Decor Co','Catering Co','DJ Beats'] as $i => $name) {
            User::firstOrCreate([
                'email' => 'provider'.($i+1).'@example.com'
            ], [
                'name' => $name,
                'password' => Hash::make('password'),
                'role_id' => $providerRole->id,
                'is_active' => true,
            ]);
        }

        // Customers
        foreach (['Amit Customer','Neha Customer','Sonal Customer'] as $i => $name) {
            User::firstOrCreate([
                'email' => 'customer'.($i+1).'@example.com'
            ], [
                'name' => $name,
                'password' => Hash::make('password'),
                'role_id' => $customerRole->id,
                'is_active' => true,
            ]);
        }
    }
}