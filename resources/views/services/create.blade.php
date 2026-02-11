@extends('layouts.app')

@section('title', 'Create Service - Event Hub')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Add New Service</h1>

    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Service Name *</label>
                <input type="text" name="name" id="name" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('name') }}" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Service Type *</label>
                    <select name="type" id="type" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" required>
                        <option value="">Select Type</option>
                        <option value="decorator" @if(old('type') === 'decorator') selected @endif>Decorator</option>
                        <option value="catering" @if(old('type') === 'catering') selected @endif>Catering</option>
                        <option value="dj" @if(old('type') === 'dj') selected @endif>DJ / Sound / Lighting</option>
                        <option value="security" @if(old('type') === 'security') selected @endif>Security</option>
                    </select>
                    @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price ($) *</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('price') }}" required>
                    @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <input type="text" name="duration" id="duration" placeholder="e.g., 4 hours, Full day" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('duration') }}">
                    @error('duration') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="max_bookings" class="block text-sm font-medium text-gray-700">Max Bookings (Optional)</label>
                    <input type="number" name="max_bookings" id="max_bookings" min="1" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('max_bookings') }}">
                    @error('max_bookings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="features" class="block text-sm font-medium text-gray-700">Features/Inclusions</label>
                <textarea name="features" id="features" rows="3" placeholder="e.g., Setup, Takedown, Customization" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none">{{ old('features') }}</textarea>
                @error('features') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary-blue text-white px-6 py-2 rounded font-semibold hover:bg-blue-600">
                    Create Service
                </button>
                <a href="{{ route('services.index') }}" class="border border-gray-300 px-6 py-2 rounded font-semibold hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
