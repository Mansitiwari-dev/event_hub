@extends('layouts.app')

@section('title', 'Edit Service - Event Hub')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Service</h1>

    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Service Name *</label>
                <input type="text" name="name" id="name" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('name', $service->name) }}" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none">{{ old('description', $service->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Service Type *</label>
                    <select name="type" id="type" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" required>
                        <option value="decorator" @if(old('type', $service->type) === 'decorator') selected @endif>Decorator</option>
                        <option value="catering" @if(old('type', $service->type) === 'catering') selected @endif>Catering</option>
                        <option value="dj" @if(old('type', $service->type) === 'dj') selected @endif>DJ / Sound / Lighting</option>
                        <option value="security" @if(old('type', $service->type) === 'security') selected @endif>Security</option>
                    </select>
                    @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price ($) *</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('price', $service->price) }}" required>
                    @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <input type="text" name="duration" id="duration" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('duration', $service->duration) }}">
                    @error('duration') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="max_bookings" class="block text-sm font-medium text-gray-700">Max Bookings</label>
                    <input type="number" name="max_bookings" id="max_bookings" min="1" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('max_bookings', $service->max_bookings) }}">
                    @error('max_bookings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="features" class="block text-sm font-medium text-gray-700">Features/Inclusions</label>
                <textarea name="features" id="features" rows="3" class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:border-primary-blue focus:outline-none">{{ old('features', $service->features) }}</textarea>
                @error('features') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="is_available" class="flex items-center">
                    <input type="checkbox" name="is_available" id="is_available" value="1" @if(old('is_available', $service->is_available)) checked @endif class="border rounded">
                    <span class="ml-2 text-sm text-gray-700">Available for booking</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary-blue text-white px-6 py-2 rounded font-semibold hover:bg-blue-600">
                    Update Service
                </button>
                <a href="{{ route('services.show', $service) }}" class="border border-gray-300 px-6 py-2 rounded font-semibold hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
