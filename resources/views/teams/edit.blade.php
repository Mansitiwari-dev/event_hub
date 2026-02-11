@extends('layouts.app')

@section('title', 'Edit Team - Event Hub')

@section('content')
<div class="container py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-8 fade-in">
            <a href="{{ route('events.show', $team->event) }}" class="text-primary hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>Back to Event
            </a>
        </div>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Edit Team</h1>
            <h2 class="text-xl text-gray-600 mt-2">{{ $team->event->title }}</h2>
            <p class="text-gray-600 mt-4">Update team members and details</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Event Details Summary -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">EVENT DATE</p>
                    <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($team->event->start_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">GUESTS</p>
                    <p class="text-lg font-bold text-gray-900">{{ $team->event->guest_count }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">BUDGET</p>
                    <p class="text-lg font-bold text-gray-900">₹{{ number_format($team->event->budget) }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">LOCATION</p>
                    <p class="text-lg font-bold text-gray-900">{{ Str::limit($team->event->location, 15) }}</p>
                </div>
            </div>
        </div>

        <!-- Team Form -->
        <form action="{{ route('teams.update', $team) }}" method="POST" class="bg-white rounded-lg shadow-md p-8 mb-8">
            @csrf
            @method('PUT')

            <!-- Team Name -->
            <div class="form-group">
                <label for="team_name">Team Name *</label>
                <input type="text" id="team_name" name="team_name" 
                    placeholder="e.g., Premium Decoration Team"
                    value="{{ old('team_name', $team->team_name) }}" required>
                @error('team_name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Team Description -->
            <div class="form-group">
                <label for="description">Team Description</label>
                <textarea id="description" name="description" 
                    placeholder="Describe what this team handles...">{{ old('description', $team->description) }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vendor Selection -->
            <div class="mb-8">
                <label class="block font-bold text-gray-900 mb-4">
                    <i class="fas fa-users mr-2" style="color: #667eea;"></i> Team Members
                </label>

                <div class="space-y-4 mb-6">
                    @forelse($vendors as $vendor)
                        <label class="flex items-start p-4 border-2 {{ in_array($vendor->id, $team->vendors->pluck('id')->toArray()) ? 'border-blue-400 bg-blue-50' : 'border-gray-200' }} rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                            <input type="checkbox" name="vendor_ids[]" value="{{ $vendor->id }}" 
                                {{ in_array($vendor->id, $team->vendors->pluck('id')->toArray()) ? 'checked' : '' }}
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
                <div id="selectedSummary" class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-blue-900 font-semibold mb-3">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="selectedCount">{{ $team->vendors->count() }}</span> vendors selected
                    </p>
                    <div id="selectedList" class="space-y-1">
                        @foreach($team->vendors as $vendor)
                            <p class="text-blue-900">✓ {{ $vendor->company_name }}</p>
                        @endforeach
                    </div>
                    <div class="mt-3 p-3 bg-white rounded text-sm">
                        <p class="text-gray-600">Total Team Cost:</p>
                        <p class="text-2xl font-bold" style="color: #667eea;">₹<span id="totalCost">{{ number_format($team->vendors->sum('service_amount')) }}</span></p>
                    </div>
                </div>

                @error('vendor_ids')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary flex-1">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
                <a href="{{ route('events.show', $team->event) }}" class="btn btn-outline flex-1 text-center">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>

        <!-- Delete Team -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <h3 class="text-lg font-bold text-red-900 mb-2">Delete Team</h3>
            <p class="text-red-700 mb-4">This action cannot be undone.</p>
            <form action="{{ route('teams.destroy', $team) }}" method="POST" class="inline" 
                onsubmit="return confirm('Are you sure you want to delete this team?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: #ef4444; color: white;">
                    <i class="fas fa-trash mr-2"></i> Delete Team
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const checkboxes = document.querySelectorAll('input[name="vendor_ids[]"]');
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
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));
    updateSummary(); // Initial update
</script>
@endsection
