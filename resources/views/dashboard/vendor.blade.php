@extends('layouts.master')

@section('title', 'Vendor Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h2 class="text-2xl font-semibold">Vendor Dashboard</h2>
  <p class="text-gray-600 mt-2">Welcome, {{ auth()->user()->name }}.</p>
  <div class="mt-6 grid md:grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">Services: {{ $services_count ?? 0 }}</div>
    <div class="bg-white p-4 rounded shadow">Requests: {{ $booking_requests ?? 0 }}</div>
    <div class="bg-white p-4 rounded shadow">Profile: {{ optional($profile)->id ? 'Complete' : 'Incomplete' }}</div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('app-content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Vendor Dashboard</h1>
      <p class="text-gray-500 mt-1">Your services, bookings and profile</p>
    </div>
    <div>
      @if(Route::has('vendor.profile.edit'))
        <a href="{{ route('vendor.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg shadow">Edit Profile</a>
      @endif
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-5">
      <div class="text-sm text-gray-500">My Services</div>
      <div class="text-2xl font-bold text-gray-800">{{ $services_count ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
      <div class="text-sm text-gray-500">Booking Requests</div>
      <div class="text-2xl font-bold text-gray-800">{{ $booking_requests ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
      <div class="text-sm text-gray-500">Earnings (est.)</div>
      <div class="text-2xl font-bold text-gray-800">₹{{ number_format($earnings ?? 0) }}</div>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow p-5">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Completeness</h3>
    <div class="w-full bg-gray-100 rounded-full h-3">
      <div class="bg-gradient-to-r from-primary to-secondary h-3 rounded-full" style="width: {{ $profile_completeness ?? 40 }}%"></div>
    </div>
    <div class="mt-4 text-sm text-gray-600">Complete your profile to increase bookings.</div>
  </div>
</div>
@endsection