@extends('layouts.app')

@section('title', 'Edit Vendor Profile - Event Hub')

@section('content')
<div class="container py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-8 fade-in">
            <a href="{{ route('vendors.show', $vendor) }}" class="text-primary hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>Back to Profile
            </a>
        </div>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Edit Vendor Profile</h1>
            <p class="text-gray-600 mt-2">Update your business information and services</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('vendors.update', $vendor) }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf
            @method('PUT')

            <!-- Company Name -->
            <div class="form-group">
                <label for="company_name">Company Name *</label>
                <input type="text" id="company_name" name="company_name" 
                    value="{{ old('company_name', $vendor->company_name) }}"
                    placeholder="Enter your company name" required>
                @error('company_name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Business Description *</label>
                <textarea id="description" name="description" placeholder="Describe your business, specialties, and approach..."
                    required>{{ old('description', $vendor->description) }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-2">
                    <i class="fas fa-info-circle mr-1"></i> Help customers understand your business
                </p>
            </div>

            <!-- Experience -->
            <div class="form-group">
                <label for="experience">Years of Experience *</label>
                <input type="number" id="experience" name="experience" min="0" max="100"
                    value="{{ old('experience', $vendor->experience) }}"
                    placeholder="0" required>
                @error('experience')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Contact Phone *</label>
                <input type="tel" id="phone" name="phone"
                    value="{{ old('phone', $vendor->phone) }}"
                    placeholder="+91 XXXXX XXXXX" required>
                @error('phone')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Business Address *</label>
                <input type="text" id="address" name="address"
                    value="{{ old('address', $vendor->address) }}"
                    placeholder="Street, City, State, Pincode" required>
                @error('address')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Service Amount -->
            <div class="form-group">
                <label for="service_amount">Service Amount (₹) *</label>
                <input type="number" id="service_amount" name="service_amount" min="0" step="100"
                    value="{{ old('service_amount', $vendor->service_amount) }}"
                    placeholder="0" required>
                @error('service_amount')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-2">
                    <i class="fas fa-info-circle mr-1"></i> Base service cost per event
                </p>
            </div>

            <!-- Availability -->
            <div class="form-group">
                <label for="availability">Availability (JSON Format)</label>
                <textarea id="availability" name="availability" 
                    placeholder='{"weekdays": ["Monday", "Tuesday", ...], "hours": "9AM-6PM"}'
                >{{ old('availability', $vendor->availability ? json_encode($vendor->availability) : '') }}</textarea>
                @error('availability')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-2">
                    <i class="fas fa-info-circle mr-1"></i> Optional: Use JSON format to specify your availability
                </p>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-8"></div>

            <!-- Current Services -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Your Services</h3>
                
                @forelse($vendor->services as $service)
                    <div class="border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">{{ $service->name }}</p>
                                <p class="text-sm text-gray-600">{{ $service->type }}</p>
                                <p class="text-primary font-bold mt-2" style="color: #667eea;">₹{{ number_format($service->price) }}</p>
                            </div>
                            <a href="{{ route('services.edit', $service) }}" class="text-primary hover:underline text-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 text-center py-8">
                        <i class="fas fa-inbox text-gray-300 text-3xl mb-3 block"></i>
                        You haven't created any services yet.
                        <a href="{{ route('services.create') }}" class="text-primary hover:underline font-semibold">
                            Create one now
                        </a>
                    </p>
                @endforelse
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary flex-1">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
                <a href="{{ route('vendors.show', $vendor) }}" class="btn btn-outline flex-1 text-center">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>

        <!-- Portfolio Management Link -->
        <div class="mt-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-md p-8 text-white text-center">
            <h3 class="text-2xl font-bold mb-3">Manage Your Portfolio</h3>
            <p class="mb-6">Add stunning images showcasing your work to attract more customers</p>
            <a href="{{ route('vendors.show', $vendor) }}#reviews" class="btn btn-outline" style="border-color: white; color: white;">
                <i class="fas fa-images mr-2"></i> Go to Portfolio Section
            </a>
        </div>
    </div>
</div>
@endsection
