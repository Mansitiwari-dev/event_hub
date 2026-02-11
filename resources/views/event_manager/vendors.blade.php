@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 pt-20">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">Find Vendors</h1>
            <p class="text-blue-300 mt-2">Search and hire vendors for your events</p>
        </div>

        <!-- Search and Filters -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-lg shadow-lg p-6 mb-8 border border-slate-600">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Search by Name</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Vendor name..." class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Filter by Service</label>
                    <select name="specialization" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">All Services</option>
                        @php
                            $specializations = \App\Models\VendorSpecialization::all();
                        @endphp
                        @foreach($specializations as $spec)
                            <option value="{{ $spec->id }}" @selected(request('specialization') == $spec->id)>{{ $spec->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Filter by Event</label>
                    <select name="event" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">All Events</option>
                        @foreach(auth()->user()->customerEvents as $event)
                            <option value="{{ $event->id }}" @selected(request('event') == $event->id)>{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                        Search
                    </button>
                    <a href="{{ route('event_manager.vendors') }}" class="flex-1 bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded-lg text-center transition-all duration-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Vendors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $vendors = \App\Models\VendorProfile::whereHas('specializations')->with('specializations', 'user')->get();
                if (request('specialization')) {
                    $vendors = $vendors->filter(fn($v) => $v->specializations->contains('id', request('specialization')));
                }
            @endphp

            @forelse($vendors as $vendor)
                <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-600">
                    <!-- Vendor Header with Gradient -->
                    <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 border-b border-slate-600">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $vendor->user->name ?? 'Vendor' }}</h3>
                                <p class="text-sm text-blue-200 mt-1">{{ $vendor->business_name ?? 'Professional Services' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vendor Details -->
                    <div class="p-6 space-y-4">
                        <!-- Specializations -->
                        <div>
                            <div class="text-xs font-semibold text-blue-300 mb-2 uppercase tracking-wide">Specializations</div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($vendor->specializations as $spec)
                                    <span class="inline-block bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full text-xs font-semibold border border-purple-400/30">
                                        {{ $spec->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Description -->
                        @if($vendor->description)
                            <div>
                                <div class="text-xs font-semibold text-blue-300 mb-1 uppercase tracking-wide">About</div>
                                <p class="text-sm text-blue-100 line-clamp-2">{{ $vendor->description }}</p>
                            </div>
                        @endif

                        <!-- Experience -->
                        @if($vendor->years_of_experience)
                            <div>
                                <div class="text-xs font-semibold text-blue-300 mb-1 uppercase tracking-wide">Experience</div>
                                <p class="text-sm text-white">{{ $vendor->years_of_experience }} years</p>
                            </div>
                        @endif

                        <!-- Rating -->
                        <div class="flex items-center gap-2">
                            <div class="text-sm font-semibold text-white">Rating:</div>
                            <div class="flex text-yellow-400">
                                @php
                                    $rating = $vendor->reviews->avg('rating') ?? 0;
                                    $fullStars = floor($rating);
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '★';
                                    }
                                    for ($i = $fullStars; $i < 5; $i++) {
                                        echo '☆';
                                    }
                                @endphp
                            </div>
                            <span class="text-xs text-blue-300">({{ $vendor->reviews->count() }} reviews)</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="px-6 py-4 bg-slate-700/50 border-t border-slate-600 flex gap-2">
                        <button onclick="viewVendorDetails({{ $vendor->id }})" class="flex-1 bg-slate-600 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded-lg text-sm transition-all duration-200">
                            View Profile
                        </button>
                        <button onclick="hireVendor({{ $vendor->id }})" class="flex-1 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition-all duration-200">
                            Hire
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-gradient-to-br from-slate-800 to-slate-700 rounded-lg shadow-lg p-8 text-center border border-slate-600">
                    <p class="text-blue-300 text-lg">No vendors found matching your criteria.</p>
                    <p class="text-blue-400 mt-2">Try adjusting your filters or search term.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Hire Vendor Modal -->
<div id="hireVendorModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-lg shadow-2xl p-8 max-w-md w-full mx-4 border border-slate-600">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white">Hire Vendor</h3>
            <button onclick="closeHireModal()" class="text-blue-400 hover:text-blue-300 text-2xl font-bold">✕</button>
        </div>
        <form id="hireForm" method="POST" action="">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-white mb-2">Select Event</label>
                <select name="event_id" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Choose Event --</option>
                    @foreach(auth()->user()->customerEvents as $event)
                        <option value="{{ $event->id }}">{{ $event->title }} ({{ $event->start_date->format('M d, Y') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-white mb-2">Select Service</label>
                <select name="specialization_id" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Choose Service --</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-white mb-2">Agreed Rate</label>
                <input type="number" name="agreed_rate" step="0.01" placeholder="Enter rate" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="closeHireModal()" class="flex-1 bg-slate-600 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                    Send Contract
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function hireVendor(vendorId) {
    document.getElementById('hireForm').action = "{{ route('event_manager.contracts.store') }}";
    document.querySelector('input[name="vendor_id"]')?.remove();
    
    const vendorInput = document.createElement('input');
    vendorInput.type = 'hidden';
    vendorInput.name = 'vendor_id';
    vendorInput.value = vendorId;
    document.getElementById('hireForm').appendChild(vendorInput);
    
    document.getElementById('hireVendorModal').classList.remove('hidden');
}

function closeHireModal() {
    document.getElementById('hireVendorModal').classList.add('hidden');
}

function viewVendorDetails(vendorId) {
    window.location.href = "{{ route('event_manager.vendor.details', ':id') }}".replace(':id', vendorId);
}
</script>
@endsection
