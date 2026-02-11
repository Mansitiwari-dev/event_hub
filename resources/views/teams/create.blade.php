@extends('layouts.app')

@section('title', 'Create Team - Event Hub')

@section('content')
<div class="container py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-8 fade-in">
            <a href="{{ route('events.show', $event) }}" class="text-primary hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>Back to Event
            </a>
        </div>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Create Team for Event</h1>
            <h2 class="text-xl text-gray-600 mt-2">{{ $event->title }}</h2>
            <p class="text-gray-600 mt-4">Select vendors to form a team for your event</p>
        </div>

        <!-- Event Details Summary -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">EVENT DATE</p>
                    <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">GUESTS</p>
                    <p class="text-lg font-bold text-gray-900">{{ $event->guest_count }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">BUDGET</p>
                    <p class="text-lg font-bold text-gray-900">₹{{ number_format($event->budget) }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">LOCATION</p>
                    <p class="text-lg font-bold text-gray-900">{{ Str::limit($event->location, 15) }}</p>
                </div>
            </div>
        </div>

        <!-- Team Form -->
        <form action="{{ route('teams.store', $event) }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf

            <!-- Team Name -->
            <div class="form-group">
                <label for="team_name">Team Name *</label>
                <input type="text" id="team_name" name="team_name" 
                    placeholder="e.g., Premium Decoration Team, All-in-One Setup"
                    value="{{ old('team_name') }}" required>
                @error('team_name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Team Description -->
            <div class="form-group">
                <label for="description">Team Description (Optional)</label>
                <textarea id="description" name="description" 
                    placeholder="Describe what this team will handle for your event..."></textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vendor Selection -->
            <div class="mb-8">
                <label class="block font-bold text-gray-900 mb-4">
                    <i class="fas fa-users mr-2" style="color: #667eea;"></i> Select Vendors
                </label>

                @if($vendors->isEmpty())
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg text-center">
                        <p class="text-blue-900 mb-4">No vendors available. Create vendors first.</p>
                        <a href="{{ route('services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Create Service
                        </a>
                    </div>
                @else
                    <div class="space-y-4 mb-6">
                        @forelse($vendors as $vendor)
                            <label class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                                <input type="checkbox" name="vendor_ids[]" value="{{ $vendor->id }}" 
                                    {{ in_array($vendor->id, old('vendor_ids', [])) ? 'checked' : '' }}
                                    class="mt-1">
                                
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-bold text-gray-900">{{ $vendor->company_name }}</p>
                                        <div class="flex items-center text-yellow-400 text-sm">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($vendor->rating))
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="text-gray-600 ml-1">({{ $vendor->review_count }})</span>
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($vendor->description, 80) }}</p>
                                    
                                    <div class="grid grid-cols-3 gap-4 mt-3 text-sm">
                                        <div>
                                            <span class="text-gray-600">Experience:</span>
                                            <p class="font-semibold text-gray-900">{{ $vendor->experience }}+ yrs</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Service Amount:</span>
                                            <p class="font-semibold" style="color: #667eea;">₹{{ number_format($vendor->service_amount) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Contact:</span>
                                            <p class="font-semibold text-gray-900">{{ $vendor->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-inbox text-gray-300 text-3xl mb-3 block"></i>
                                <p class="text-gray-600">No vendors found</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Selected Vendors Summary -->
                    <div id="selectedSummary" class="bg-blue-50 border border-blue-200 rounded-lg p-4 hidden">
                        <p class="text-blue-900 font-semibold mb-3">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span id="selectedCount">0</span> vendors selected
                        </p>
                        <div id="selectedList" class="space-y-1">
                            <!-- Dynamically updated -->
                        </div>
                        <div class="mt-3 p-3 bg-white rounded text-sm">
                            <p class="text-gray-600">Estimated Total Cost:</p>
                            <p class="text-2xl font-bold" style="color: #667eea;">₹<span id="totalCost">0</span></p>
                        </div>
                    </div>

                    @error('vendor_ids')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                @endif
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary flex-1">
                    <i class="fas fa-plus mr-2"></i> Create Team
                </button>
                <a href="{{ route('events.show', $event) }}" class="btn btn-outline flex-1 text-center">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const checkboxes = document.querySelectorAll('input[name="vendor_ids[]"]');
    const selectedSummary = document.getElementById('selectedSummary');
    const selectedCount = document.getElementById('selectedCount');
    const selectedList = document.getElementById('selectedList');
    const totalCost = document.getElementById('totalCost');
    const vendorData = {
        @foreach($vendors as $vendor)
            {{ $vendor->id }}: { name: '{{ $vendor->company_name }}', cost: {{ $vendor->service_amount }} },
        @endforeach
    };

    function updateSummary() {
        const selected = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => ({
                id: cb.value,
                ...vendorData[cb.value]
            }));

        selectedCount.textContent = selected.length;
        selectedList.innerHTML = selected.map(v => 
            `<p class="text-blue-900">✓ ${v.name}</p>`
        ).join('');

        const total = selected.reduce((sum, v) => sum + v.cost, 0);
        totalCost.textContent = total.toLocaleString('en-IN');

        selectedSummary.classList.toggle('hidden', selected.length === 0);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));
    updateSummary(); // Initial update
</script>
@endsection
