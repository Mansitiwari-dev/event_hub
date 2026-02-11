@extends('layouts.app')

@section('title', $service->name . ' - Event Hub')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $service->name }}</h1>
            <p class="text-gray-600 mt-2">{{ $service->provider->name }} • {{ ucfirst($service->type) }}</p>
        </div>
        <span class="text-sm px-3 py-1 rounded @if($service->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
            {{ $service->is_available ? 'Available' : 'Unavailable' }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Service Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Service Details</h2>
                <div class="space-y-4">
                    @if ($service->description)
                        <div>
                            <p class="text-sm text-gray-600">Description</p>
                            <p class="text-gray-800">{{ $service->description }}</p>
                        </div>
                    @endif
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Price</p>
                            <p class="text-2xl font-bold text-primary-blue">${{ number_format($service->price, 2) }}</p>
                        </div>
                        @if ($service->duration)
                            <div>
                                <p class="text-sm text-gray-600">Duration</p>
                                <p class="font-semibold">{{ $service->duration }}</p>
                            </div>
                        @endif
                    </div>
                    @if ($service->features)
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Features/Inclusions</p>
                            <p class="text-gray-800">{{ $service->features }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Bookings</h2>
                @if ($bookings->count() > 0)
                    <div class="space-y-4">
                        @foreach ($bookings as $booking)
                            <div class="border-b pb-4 last:border-b-0">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold">{{ $booking->event->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $booking->customer->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $booking->booking_date->format('M d, Y') }}</p>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded @if($booking->status === 'confirmed') bg-green-100 text-green-800 @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800 @elseif($booking->status === 'rejected') bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $bookings->links() }}
                @else
                    <p class="text-gray-600 text-center py-8">No bookings yet.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Provider Info -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4">Provider</h3>
                <p class="text-gray-800 font-semibold">{{ $service->provider->name }}</p>
                <p class="text-sm text-gray-600">{{ $service->provider->email }}</p>
                @if ($service->provider->phone)
                    <p class="text-sm text-gray-600">{{ $service->provider->phone }}</p>
                @endif
            </div>

            <!-- Book Service -->
            @auth
                @if (auth()->user()->hasRole('customer'))
                    <div class="bg-primary-blue text-white rounded-lg shadow p-6 mb-6">
                        <h3 class="font-semibold mb-4">Interested?</h3>
                        <p class="text-sm mb-4">Book this service for your event</p>
                        <a href="{{ route('bookings.create') }}?service_id={{ $service->id }}" class="block text-center bg-white text-primary-blue px-4 py-2 rounded font-semibold hover:bg-gray-100">
                            Book Now
                        </a>
                    </div>
                @endif
            @else
                <div class="bg-gray-200 text-gray-800 rounded-lg shadow p-6 mb-6">
                    <p class="text-sm mb-4">Login to book this service</p>
                    <a href="{{ route('login') }}" class="block text-center bg-primary-blue text-white px-4 py-2 rounded font-semibold hover:bg-blue-600">
                        Login
                    </a>
                </div>
            @endauth

            <!-- Edit/Delete (Provider only) -->
            @can('update', $service)
                <div class="space-y-2">
                    <a href="{{ route('services.edit', $service) }}" class="block text-center bg-primary-blue text-white px-4 py-2 rounded hover:bg-blue-600">
                        <i class="fas fa-edit mr-2"></i>Edit Service
                    </a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash mr-2"></i>Delete Service
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection
