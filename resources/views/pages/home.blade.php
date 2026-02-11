@extends('layouts.master')

@section('title', 'Home - EventHub')

@section('content')
<div class="container mx-auto px-4">
  <section class="hero hero-gradient">
    <div class="hero-content">
      <h1 class="text-4xl font-extrabold">Plan memorable events with EventHub</h1>
      <p class="mt-4 text-lg">Connect with trusted vendors, manage bookings and delight your guests — all from one place.</p>
      <div class="hero-ctas">
        <a href="{{ route('services') }}" class="btn btn-primary btn-large">Browse Services</a>
        <a href="{{ route('contact') }}" class="btn btn-outline btn-large">Contact Us</a>
      </div>
    </div>
  </section>

  <section class="grid md:grid-cols-3 gap-6 mt-8">
    <div class="feature-card">
      <h3 class="font-semibold">Discover Vendors</h3>
      <p class="text-sm text-gray-500 mt-2">Search curated vendors for every event type.</p>
    </div>
    <div class="feature-card">
      <h3 class="font-semibold">Create Events</h3>
      <p class="text-sm text-gray-500 mt-2">Plan and manage your events with ease.</p>
    </div>
    <div class="feature-card">
      <h3 class="font-semibold">Secure Bookings</h3>
      <p class="text-sm text-gray-500 mt-2">Communicate and confirm bookings quickly.</p>
    </div>
  </section>
</div>
@endsection
