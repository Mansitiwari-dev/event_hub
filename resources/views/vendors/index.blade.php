{{-- Vendors index — modern card grid with gradient, hover lift, pagination --}}
@extends('layouts.app')

@section('title', 'Vendors')

@section('app-content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Vendors</h1>
    <form action="{{ route('vendors.index') }}" method="GET" class="flex gap-2">
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Search vendors..." class="px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:outline-none" />
      <button type="submit" class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-semibold">Search</button>
    </form>
  </div>

  @if($vendors->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($vendors as $vendor)
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1 overflow-hidden">
          <div class="bg-gradient-to-r from-primary to-secondary h-24"></div>
          <div class="p-4">
            <h3 class="text-lg font-bold text-gray-800">{{ $vendor->name }}</h3>
            <p class="text-sm text-gray-500 mt-1">{{ ucfirst(optional($vendor->role)->name) }}</p>
            <div class="flex items-center mt-3 text-yellow-500">
              <span>⭐</span>
              <span class="text-sm font-semibold ml-1">4.8 (32)</span>
            </div>
            <a href="{{ route('vendors.show', $vendor) }}" class="mt-4 block w-full text-center px-3 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-semibold hover:opacity-95">View Profile</a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-8">
      {{ $vendors->links() }}
    </div>
  @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
      <p class="text-gray-500">No vendors found.</p>
    </div>
  @endif
</div>
@endsection
