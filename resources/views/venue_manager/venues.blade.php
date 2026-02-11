@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Manage Venues</h1>
        <p class="text-gray-600 mt-2">View, edit, and manage all your venues</p>
    </div>

    <!-- Add Venue Button -->
    <div class="mb-8">
        <button onclick="document.getElementById('addVenueModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
            ➕ Add New Venue
        </button>
    </div>

    <!-- Venues Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse(auth()->user()->managedVenues as $venue)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                <!-- Venue Status -->
                <div class="h-2 @if($venue->is_available) bg-green-500 @else bg-red-500 @endif"></div>

                <!-- Venue Header -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $venue->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $venue->location }}</p>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                            @if($venue->is_available) bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            @if($venue->is_available) Active @else Inactive @endif
                        </span>
                    </div>

                    <!-- Venue Details -->
                    <div class="space-y-3 mb-4 pb-4 border-b">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Capacity:</span>
                            <span class="font-semibold text-gray-800">{{ $venue->capacity }} guests</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Price per Hour:</span>
                            <span class="font-semibold text-gray-800">${{ number_format($venue->price_per_hour, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Bookings:</span>
                            <span class="font-semibold text-gray-800">{{ $venue->bookings->count() }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Confirmed:</span>
                            <span class="font-semibold text-green-600">{{ $venue->bookings->where('status', 'confirmed')->count() }}</span>
                        </div>
                    </div>

                    <!-- Amenities -->
                    @if($venue->amenities && count(json_decode($venue->amenities, true)) > 0)
                        <div class="mb-4">
                            <div class="text-xs font-semibold text-gray-600 mb-2">AMENITIES</div>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($venue->amenities, true) as $amenity)
                                    <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $amenity }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t flex gap-2">
                    <button onclick="editVenue({{ $venue->id }})" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                        Edit
                    </button>
                    <button onclick="deleteVenue({{ $venue->id }})" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-600 text-lg">No venues yet</p>
                <p class="text-gray-500 mt-2">Start by adding your first venue</p>
                <button onclick="document.getElementById('addVenueModal').classList.remove('hidden')" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Add First Venue
                </button>
            </div>
        @endforelse
    </div>
</div>

<!-- Add/Edit Venue Modal -->
<div id="addVenueModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800">Add New Venue</h3>
            <button onclick="closeVenueModal()" class="text-gray-500 hover:text-gray-700 text-2xl">✕</button>
        </div>
        <form method="POST" action="{{ route('venue_manager.venues.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Venue Name</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Grand Ballroom">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                    <input type="text" name="location" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Full address">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Capacity</label>
                    <input type="number" name="capacity" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Number of guests">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price per Hour</label>
                    <input type="number" name="price_per_hour" required step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe your venue..."></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Is Available?</label>
                <input type="checkbox" name="is_available" value="1" checked class="w-4 h-4">
                <span class="text-sm text-gray-600 ml-2">Venue is available for bookings</span>
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="closeVenueModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Add Venue
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function closeVenueModal() {
    document.getElementById('addVenueModal').classList.add('hidden');
}

function editVenue(venueId) {
    // TODO: Implement edit functionality
    console.log('Edit venue:', venueId);
}

function deleteVenue(venueId) {
    if (confirm('Are you sure you want to delete this venue?')) {
        // TODO: Implement delete functionality
        console.log('Delete venue:', venueId);
    }
}
</script>
@endsection
