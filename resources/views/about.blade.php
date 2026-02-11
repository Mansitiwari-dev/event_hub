@extends('layouts.app')

@section('title', 'About — EventHub')

@section('content')
<style>
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  .fade-up { animation: fadeInUp 0.8s ease-out; }
  .slide-left { animation: slideInLeft 0.8s ease-out; }
  .slide-right { animation: slideInRight 0.8s ease-out; }
  .about-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }
  .about-card:hover {
    transform: translateY(-10px);
  }
</style>
<div class="container mx-auto px-4 py-12">
  <!-- Hero Section -->
  <section class="relative mb-16 overflow-hidden rounded-3xl shadow-2xl">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 opacity-90"></div>
    <div class="absolute inset-0" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 600%22><path d=%22M0,300 Q300,200 600,300 T1200,300 L1200,600 L0,600 Z%22 fill=%22white%22 opacity=%220.1%22/></svg>'); background-size: cover;"></div>
    <div class="relative z-10 p-12 md:p-20 text-white text-center fade-up">
      <h1 class="text-6xl font-bold mb-4 drop-shadow-lg">About EventHub</h1>
      <p class="text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed drop-shadow-md">Connecting passionate event organizers with trusted vendors to create unforgettable experiences worldwide.</p>
    </div>
  </section>

  <!-- Main Content Grid -->
  <section class="grid md:grid-cols-2 gap-8 mb-16">
    <!-- Who We Are -->
    <div class="about-card group relative bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-500 hover:shadow-2xl overflow-hidden slide-left">
      <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full -mr-8 -mt-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      <div class="relative z-10">
        <div class="text-5xl mb-4">🎭</div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Who We Are</h3>
        <p class="text-gray-600 leading-relaxed">EventHub is a modern event marketplace built to simplify planning and vendor coordination. We're passionate about connecting amazing people and bringing events to life with excellence and innovation.</p>
      </div>
    </div>

    <!-- Our Mission -->
    <div class="about-card group relative bg-white rounded-2xl shadow-lg p-8 border-l-4 border-purple-500 hover:shadow-2xl overflow-hidden slide-right">
      <div class="absolute top-0 right-0 w-32 h-32 bg-purple-100 rounded-full -mr-8 -mt-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      <div class="relative z-10">
        <div class="text-5xl mb-4">🎯</div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
        <p class="text-gray-600 leading-relaxed">To empower people to create memorable events easily and affordably. We believe every event deserves professional coordination and we're here to make that accessible to everyone.</p>
      </div>
    </div>

    <!-- Our Vision -->
    <div class="about-card group relative bg-white rounded-2xl shadow-lg p-8 border-l-4 border-pink-500 hover:shadow-2xl overflow-hidden slide-left" style="animation-delay: 0.1s;">
      <div class="absolute top-0 right-0 w-32 h-32 bg-pink-100 rounded-full -mr-8 -mt-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      <div class="relative z-10">
        <div class="text-5xl mb-4">🌍</div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
        <p class="text-gray-600 leading-relaxed">To be the leading global marketplace for event services. We envision a world where organizing perfect events is simple, transparent, and within reach for everyone.</p>
      </div>
    </div>

    <!-- Why Choose Us -->
    <div class="about-card group relative bg-white rounded-2xl shadow-lg p-8 border-l-4 border-cyan-500 hover:shadow-2xl overflow-hidden slide-right" style="animation-delay: 0.1s;">
      <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-100 rounded-full -mr-8 -mt-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      <div class="relative z-10">
        <div class="text-5xl mb-4">⭐</div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Why Choose Us</h3>
        <p class="text-gray-600 leading-relaxed">Vetted vendors, secure bookings, 24/7 support, transparent pricing, and a community dedicated to making your event exceptional. Trust is our foundation.</p>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-16 px-8 bg-gradient-to-r from-gray-50 to-white rounded-3xl shadow-lg">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
      <div class="fade-up" style="animation-delay: 0s;">
        <div class="text-5xl font-bold text-blue-600 mb-2">500+</div>
        <p class="text-gray-600 text-lg">Verified Vendors</p>
      </div>
      <div class="fade-up" style="animation-delay: 0.1s;">
        <div class="text-5xl font-bold text-purple-600 mb-2">10K+</div>
        <p class="text-gray-600 text-lg">Happy Customers</p>
      </div>
      <div class="fade-up" style="animation-delay: 0.2s;">
        <div class="text-5xl font-bold text-pink-600 mb-2">5K+</div>
        <p class="text-gray-600 text-lg">Events Organized</p>
      </div>
      <div class="fade-up" style="animation-delay: 0.3s;">
        <div class="text-5xl font-bold text-cyan-600 mb-2">24/7</div>
        <p class="text-gray-600 text-lg">Customer Support</p>
      </div>
    </div>
  </section>
</div>
@endsection
