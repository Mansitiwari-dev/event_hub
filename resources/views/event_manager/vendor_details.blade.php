@extends('layouts.app')

@section('title', 'Vendor Details - EventHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('event_manager.vendors') }}" class="text-blue-400 hover:text-blue-300 font-bold flex items-center gap-2">
                ← Back to Vendors
            </a>
        </div>

        <!-- Vendor Details Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
            <!-- Header -->
            <div class="h-40 bg-gradient-to-r from-purple-600 to-pink-600 relative">
                <div class="absolute inset-0 opacity-20 bg-pattern"></div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if($vendor)
                    <!-- Vendor Name -->
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-8 -mt-10 relative">
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl font-black text-white mb-2">{{ $vendor->user->name ?? 'Vendor' }}</h1>
                            <p class="text-lg text-blue-200">Professional Vendor Services</p>
                        </div>
                    </div>

                    <!-- Services Grid -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-white mb-4">🎯 Services Offered</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($vendor->specializations->count() > 0)
                                @foreach($vendor->specializations as $spec)
                                    <div class="p-4 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-lg border border-blue-400/30">
                                        <p class="text-blue-300 font-semibold">{{ $spec->name }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-blue-200">No specializations listed</p>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-8 pb-8 border-b border-slate-600">
                        <h2 class="text-xl font-bold text-white mb-4">📞 Contact Information</h2>
                        <div class="space-y-3 text-blue-200">
                            <p><strong>Email:</strong> {{ $vendor->user->email ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $vendor->phone ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $vendor->address ?? 'N/A' }}</p>
                            <p><strong>City:</strong> {{ $vendor->city ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Portfolio Images -->
                    @if($vendor->portfolioImages->count() > 0)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-white mb-4">📸 Portfolio</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($vendor->portfolioImages as $image)
                                    <div class="rounded-lg overflow-hidden border border-slate-600">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Portfolio" class="w-full h-48 object-cover hover:scale-105 transition-transform">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Action Button -->
                    <div class="flex gap-4">
                        <a href="{{ route('event_manager.vendors') }}" class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg text-center">
                            Hire This Vendor
                        </a>
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-blue-200 text-lg">Vendor not found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
