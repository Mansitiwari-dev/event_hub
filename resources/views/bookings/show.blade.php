@extends('layouts.app')

@section('title', 'Booking Details - Event Hub')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-start mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Booking Details</h1>
        <span class="text-sm px-3 py-1 rounded @if($booking->status === 'confirmed') bg-green-100 text-green-800 @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800 @elseif($booking->status === 'rejected') bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst($booking->status) }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Booking Info -->
        <div class="lg:col-span-2">
            <!-- Service -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Service</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600">Service Name</p>
                        <p class="text-lg font-semibold">{{ $booking->service->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Service Type</p>
                        <p class="font-semibold">{{ ucfirst($booking->service->type) }}</p>
                    </div>
                    @if ($booking->service->description)
                        <div>
                            <p class="text-sm text-gray-600">Description</p>
                            <p class="font-semibold">{{ $booking->service->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Event -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Event</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600">Event Title</p>
                        <p class="text-lg font-semibold">{{ $booking->event->title }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Event Date</p>
                            <p class="font-semibold">{{ $booking->event->start_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Booking Date</p>
                            <p class="font-semibold">{{ $booking->booking_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if ($booking->notes)
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Notes</h2>
                    <p class="text-gray-800">{{ $booking->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Amount -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4">Amount</h3>
                <p class="text-3xl font-bold text-primary-blue">${{ number_format($booking->amount, 2) }}</p>
            </div>

            <!-- Customer -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4">Customer</h3>
                <p class="text-gray-800 font-semibold">{{ $booking->customer->name }}</p>
                <p class="text-sm text-gray-600">{{ $booking->customer->email }}</p>
                @if ($booking->customer->phone)
                    <p class="text-sm text-gray-600">{{ $booking->customer->phone }}</p>
                @endif
            </div>

            <!-- Provider -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4">Service Provider</h3>
                <p class="text-gray-800 font-semibold">{{ $booking->provider->name }}</p>
                <p class="text-sm text-gray-600">{{ $booking->provider->email }}</p>
                @if ($booking->provider->phone)
                    <p class="text-sm text-gray-600">{{ $booking->provider->phone }}</p>
                @endif
            </div>

            <!-- Actions -->
            @if ($booking->status === 'pending')
                @if ($booking->provider_id === auth()->id())
                    <!-- Provider Actions -->
                    <div class="space-y-2">
                        <form action="{{ route('bookings.confirm', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700">
                                <i class="fas fa-check mr-2"></i>Confirm Booking
                            </button>
                        </form>
                        <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded font-semibold hover:bg-red-700">
                                <i class="fas fa-times mr-2"></i>Reject Booking
                            </button>
                        </form>
                    </div>
                @elseif ($booking->customer_id === auth()->id())
                    <!-- Customer Actions -->
                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded font-semibold hover:bg-red-700" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-times mr-2"></i>Cancel Booking
                        </button>
                    </form>
                @endif
            @elseif ($booking->status === 'confirmed')
                @if ($booking->provider_id === auth()->id())
                    <form action="{{ route('bookings.complete', $booking) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700">
                            <i class="fas fa-check-circle mr-2"></i>Mark as Completed
                        </button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
