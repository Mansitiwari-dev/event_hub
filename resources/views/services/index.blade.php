@extends('layouts.app')

@section('title', 'Services - Event Hub')

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Services</h1>
        @auth
            @if (auth()->user()->isServiceProvider())
                <a href="{{ route('services.create') }}" class="bg-primary-blue text-white px-6 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-plus mr-2"></i>Add Service
                </a>
            @endif
        @endauth
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <form action="{{ route('services.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" placeholder="Search services..." value="{{ request('search') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <select name="type" class="w-full border rounded px-3 py-2">
                    <option value="">All Types</option>
                    <option value="decorator" @if(request('type') === 'decorator') selected @endif>Decorator</option>
                    <option value="catering" @if(request('type') === 'catering') selected @endif>Catering</option>
                    <option value="dj" @if(request('type') === 'dj') selected @endif>DJ / Sound / Lighting</option>
                    <option value="security" @if(request('type') === 'security') selected @endif>Security</option>
                </select>
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="available" value="1" @if(request('available')) checked @endif class="border rounded">
                    <span class="ml-2 text-sm">Available only</span>
                </label>
            </div>
            <button type="submit" class="bg-primary-blue text-white rounded hover:bg-blue-600">Search</button>
        </form>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($services as $service)
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="mb-4">
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-lg font-bold text-gray-800 flex-1">{{ $service->name }}</h2>
                        <span class="text-xs px-2 py-1 rounded @if($service->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                            {{ $service->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600">{{ ucfirst($service->type) }} • {{ $service->provider->name }}</p>
                </div>

                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($service->description, 80) }}</p>

                <div class="space-y-2 mb-4 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Price:</span>
                        <span class="font-bold text-primary-blue">${{ number_format($service->price, 2) }}</span>
                    </div>
                    @if ($service->duration)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Duration:</span>
                            <span>{{ $service->duration }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('services.show', $service) }}" class="flex-1 text-center bg-primary-blue text-white px-4 py-2 rounded text-sm hover:bg-blue-600">
                        View Details
                    </a>
                    @can('update', $service)
                        <a href="{{ route('services.edit', $service) }}" class="text-primary-blue border border-primary-blue px-4 py-2 rounded text-sm hover:bg-blue-50">
                            Edit
                        </a>
                    @endcan
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-600">No services found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $services->links() }}
    </div>
</div>
@endsection
