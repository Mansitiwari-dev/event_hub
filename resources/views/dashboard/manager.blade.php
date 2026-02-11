@extends('layouts.app')

@section('title', 'Manager Dashboard - Event Hub')

@section('content')
<div>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Event Manager Dashboard 👋</h1>
        <p class="text-gray-600">Manage all events and bookings in the system</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Events -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Events</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalEvents }}</p>
                </div>
                <i class="fas fa-calendar text-primary-blue text-4xl opacity-20"></i>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
                </div>
                <i class="fas fa-check-square text-primary-blue text-4xl opacity-20"></i>
            </div>
        </div>

        <!-- Confirmed Bookings -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Confirmed</p>
                    <p class="text-3xl font-bold text-green-600">{{ $confirmedBookings }}</p>
                </div>
                <i class="fas fa-thumbs-up text-green-600 text-4xl opacity-20"></i>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Revenue</p>
                    <p class="text-3xl font-bold text-green-600">${{ number_format($totalRevenue, 2) }}</p>
                </div>
                <i class="fas fa-dollar-sign text-green-600 text-4xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <a href="{{ route('events.index') }}" class="bg-primary-blue text-white px-6 py-3 rounded font-semibold hover:bg-blue-600 transition inline-block">
            <i class="fas fa-calendar mr-2"></i>View All Events
        </a>
        <a href="{{ route('bookings.index') }}" class="bg-primary-blue text-white px-6 py-3 rounded font-semibold hover:bg-blue-600 transition inline-block">
            <i class="fas fa-check-square mr-2"></i>View All Bookings
        </a>
        <a href="{{ route('services.index') }}" class="bg-primary-blue text-white px-6 py-3 rounded font-semibold hover:bg-blue-600 transition inline-block">
            <i class="fas fa-star mr-2"></i>View All Services
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Events -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Events</h2>
            @if ($recentEvents->count() > 0)
                <div class="space-y-4">
                    @foreach ($recentEvents as $event)
                        <div class="border-b pb-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $event->customer->name }} • {{ $event->location }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $event->start_date->format('M d, Y') }}</p>
                                </div>
                                <span class="text-xs px-2 py-1 rounded @if($event->status === 'confirmed') bg-green-100 text-green-800 @elseif($event->status === 'pending') bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">No events in the system.</p>
            @endif
            <a href="{{ route('events.index') }}" class="text-primary-blue hover:underline text-sm mt-4 inline-block">View all events →</a>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Bookings</h2>
            @if ($recentBookings->count() > 0)
                <div class="space-y-4">
                    @foreach ($recentBookings as $booking)
                        <div class="border-b pb-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $booking->service->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $booking->event->title }}</p>
                                    <p class="text-xs text-gray-500 mt-1">${{ number_format($booking->amount, 2) }}</p>
                                </div>
                                <span class="text-xs px-2 py-1 rounded @if($booking->status === 'confirmed') bg-green-100 text-green-800 @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800 @elseif($booking->status === 'rejected') bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">No bookings in the system.</p>
            @endif
            <a href="{{ route('bookings.index') }}" class="text-primary-blue hover:underline text-sm mt-4 inline-block">View all bookings →</a>
        </div>
    </div>
</div>
@endsection
