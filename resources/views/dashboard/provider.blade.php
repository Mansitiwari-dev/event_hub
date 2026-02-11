@extends('layouts.app')

@section('title', 'Provider Dashboard - Event Hub')

@section('content')
<div>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Welcome, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-600">Manage your services and bookings</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Services -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Services</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalServices }}</p>
                </div>
                <i class="fas fa-star text-primary-blue text-4xl opacity-20"></i>
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

        <!-- Total Earnings -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Earnings</p>
                    <p class="text-3xl font-bold text-green-600">${{ number_format($totalEarnings, 2) }}</p>
                </div>
                <i class="fas fa-dollar-sign text-green-600 text-4xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <a href="{{ route('services.create') }}" class="bg-primary-blue text-white px-6 py-3 rounded font-semibold hover:bg-blue-600 transition inline-block">
            <i class="fas fa-plus mr-2"></i>Add New Service
        </a>
        <a href="{{ route('services.index') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded font-semibold hover:bg-gray-300 transition inline-block">
            <i class="fas fa-list mr-2"></i>Manage Services
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Services -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Services</h2>
            @if ($recentServices->count() > 0)
                <div class="space-y-4">
                    @foreach ($recentServices as $service)
                        <div class="border-b pb-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $service->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ ucfirst($service->type) }} • ${{ number_format($service->price, 2) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $service->getBookingCount() }} booking(s)</p>
                                </div>
                                <span class="text-xs px-2 py-1 rounded @if($service->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                    {{ $service->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">No services yet. <a href="{{ route('services.create') }}" class="text-primary-blue hover:underline">Create one now!</a></p>
            @endif
            <a href="{{ route('services.index') }}" class="text-primary-blue hover:underline text-sm mt-4 inline-block">View all services →</a>
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
                                    <p class="text-sm text-gray-600">{{ $booking->customer->name }}</p>
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
                <p class="text-gray-600 text-center py-8">No bookings yet.</p>
            @endif
            <a href="{{ route('bookings.index') }}" class="text-primary-blue hover:underline text-sm mt-4 inline-block">View all bookings →</a>
        </div>
    </div>
</div>
@endsection
