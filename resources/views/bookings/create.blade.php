@extends('layouts.app')

@section('title', 'Create Booking - Event Hub')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Book a Service</h1>

    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Event Selection -->
            <div>
                <label for="event_id" class="block text-sm font-medium text-gray-700">Select Event *</label>
                <select name="event_id" id="event_id" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" required>
                    <option value="">Choose an event...</option>
                    @foreach (auth()->user()->events as $event)
                        <option value="{{ $event->id }}" @if(old('event_id') == $event->id) selected @endif>
                            {{ $event->title }} ({{ $event->start_date->format('M d, Y') }})
                        </option>
                    @endforeach
                </select>
                @error('event_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Service Selection -->
            <div>
                <label for="service_id" class="block text-sm font-medium text-gray-700">Select Service *</label>
                <select name="service_id" id="service_id" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" required>
                    <option value="">Choose a service...</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" @if(old('service_id') == $service->id) selected @endif data-price="{{ $service->price }}">
                            {{ $service->name }} - ${{ number_format($service->price, 2) }} ({{ $service->provider->name }})
                        </option>
                    @endforeach
                </select>
                @error('service_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Booking Date -->
            <div>
                <label for="booking_date" class="block text-sm font-medium text-gray-700">Booking Date *</label>
                <input type="datetime-local" name="booking_date" id="booking_date" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('booking_date') }}" required>
                @error('booking_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Additional Notes</label>
                <textarea name="notes" id="notes" rows="4" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none">{{ old('notes') }}</textarea>
                @error('notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Price Display -->
            <div class="bg-light-grey p-4 rounded">
                <p class="text-sm text-gray-600">Estimated Amount:</p>
                <p class="text-2xl font-bold text-primary-blue" id="priceDisplay">$0.00</p>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary-blue text-white px-6 py-2 rounded font-semibold hover:bg-blue-600">
                    Request Booking
                </button>
                <a href="{{ route('bookings.index') }}" class="border border-gray-300 px-6 py-2 rounded font-semibold hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('service_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const price = selected.getAttribute('data-price') || '0';
        document.getElementById('priceDisplay').textContent = '$' + parseFloat(price).toFixed(2);
    });
</script>
@endsection
@endsection
