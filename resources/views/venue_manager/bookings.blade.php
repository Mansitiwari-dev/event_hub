@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Booking Management</h1>
        <p class="text-gray-600 mt-2">Review and manage all venue booking requests</p>
    </div>

    <!-- Status Tabs -->
    <div class="mb-8 border-b">
        <div class="flex gap-4">
            <a href="{{ route('venue_manager.bookings', ['status' => 'all']) }}" 
               class="pb-3 px-4 font-semibold @if(!request('status') || request('status') === 'all') text-blue-600 border-b-2 border-blue-600 @else text-gray-600 @endif">
                All Bookings
            </a>
            <a href="{{ route('venue_manager.bookings', ['status' => 'pending']) }}" 
               class="pb-3 px-4 font-semibold @if(request('status') === 'pending') text-yellow-600 border-b-2 border-yellow-600 @else text-gray-600 @endif">
                Pending
            </a>
            <a href="{{ route('venue_manager.bookings', ['status' => 'confirmed']) }}" 
               class="pb-3 px-4 font-semibold @if(request('status') === 'confirmed') text-green-600 border-b-2 border-green-600 @else text-gray-600 @endif">
                Confirmed
            </a>
            <a href="{{ route('venue_manager.bookings', ['status' => 'rejected']) }}" 
               class="pb-3 px-4 font-semibold @if(request('status') === 'rejected') text-red-600 border-b-2 border-red-600 @else text-gray-600 @endif">
                Rejected
            </a>
            <a href="{{ route('venue_manager.bookings', ['status' => 'completed']) }}" 
               class="pb-3 px-4 font-semibold @if(request('status') === 'completed') text-blue-600 border-b-2 border-blue-600 @else text-gray-600 @endif">
                Completed
            </a>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Venue</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Event</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Booking Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Guests</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $bookings = [];
                        foreach(auth()->user()->managedVenues as $venue) {
                            foreach($venue->bookings as $booking) {
                                if (!request('status') || request('status') === 'all' || $booking->status === request('status')) {
                                    $bookings[] = $booking;
                                }
                            }
                        }
                    @endphp

                    @forelse($bookings as $booking)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $booking->venue->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="font-semibold text-gray-800">{{ $booking->event->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="font-semibold text-gray-800">{{ $booking->event?->customer?->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $booking->date->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $booking->guest_count ?? 0 }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                                    @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($booking->status === 'pending')
                                    <div class="flex gap-2">
                                        <button onclick="updateBookingStatus({{ $booking->id }}, 'confirmed')" class="text-green-600 hover:text-green-800 font-semibold text-xs">
                                            ✓ Confirm
                                        </button>
                                        <button onclick="updateBookingStatus({{ $booking->id }}, 'rejected')" class="text-red-600 hover:text-red-800 font-semibold text-xs">
                                            ✕ Reject
                                        </button>
                                    </div>
                                @else
                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">View</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No bookings found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function updateBookingStatus(bookingId, status) {
    if (confirm(`Are you sure you want to ${status} this booking?`)) {
        // TODO: Implement booking status update via AJAX or form submission
        console.log('Update booking:', bookingId, 'to status:', status);
    }
}
</script>
@endsection
