@extends('layouts.app')

@section('title', 'Services — EventHub')

@section('content')
<style>
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
  }
  .service-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: fadeInUp 0.6s ease-out both;
  }
  .service-card:hover {
    transform: translateY(-12px) rotate(1deg);
  }
  .service-icon {
    transition: all 0.3s ease;
  }
  .service-card:hover .service-icon {
    transform: scale(1.2) rotate(-10deg);
  }
</style>
<div class="container mx-auto px-4 py-12">
  <!-- Header -->
  <div class="mb-16 text-center">
    <h1 class="text-5xl font-bold text-gray-800 mb-4 animate-fadeInUp">Our Services</h1>
    <p class="text-xl text-gray-600 max-w-2xl mx-auto animate-fadeInUp" style="animation-delay: 0.1s;">Explore the complete categories of services available on EventHub to make your event unforgettable</p>
  </div>

  <div class="grid md:grid-cols-3 gap-8">
    @php
      $services = [
        [
          'title' => 'Event Planning',
          'icon' => 'bi-briefcase-fill',
          'desc' => 'Full-service planning and coordination.',
          'color' => 'blue',
          'gradient' => 'from-blue-500 to-blue-600',
          'emoji' => '🎉'
        ],
        [
          'title' => 'Catering',
          'icon' => 'bi-basket-fill',
          'desc' => 'Catering options for any budget.',
          'color' => 'orange',
          'gradient' => 'from-orange-500 to-orange-600',
          'emoji' => '🍽️'
        ],
        [
          'title' => 'Decoration',
          'icon' => 'bi-brush-fill',
          'desc' => 'Beautiful decor and floral services.',
          'color' => 'pink',
          'gradient' => 'from-pink-500 to-pink-600',
          'emoji' => '🎨'
        ],
        [
          'title' => 'Photography',
          'icon' => 'bi-camera-fill',
          'desc' => 'Capture every memorable moment.',
          'color' => 'purple',
          'gradient' => 'from-purple-500 to-purple-600',
          'emoji' => '📸'
        ],
        [
          'title' => 'DJ & Sound',
          'icon' => 'bi-music-note-list',
          'desc' => 'Top DJs and full audio setups.',
          'color' => 'indigo',
          'gradient' => 'from-indigo-500 to-indigo-600',
          'emoji' => '🎵'
        ],
        [
          'title' => 'Venue Booking',
          'icon' => 'bi-building',
          'desc' => 'Find and book venues.',
          'color' => 'cyan',
          'gradient' => 'from-cyan-500 to-cyan-600',
          'emoji' => '🏢'
        ],
      ];
    @endphp

    @foreach($services as $index => $s)
      <div class="service-card group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl" style="animation-delay: {{ $index * 0.1 }}s;">
        <!-- Gradient Background -->
        <div class="absolute top-0 left-0 right-0 h-24 bg-gradient-to-r {{ $s['gradient'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Card Content -->
        <div class="relative z-10 p-8 h-full flex flex-col">
          <!-- Icon -->
          <div class="text-6xl mb-4 service-icon transform transition-transform duration-300">{{ $s['emoji'] }}</div>
          
          <!-- Title -->
          <h5 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-{{ $s['color'] }}-600 transition-colors">{{ $s['title'] }}</h5>
          
          <!-- Description -->
          <p class="text-gray-600 mb-6 flex-grow leading-relaxed">{{ $s['desc'] }}</p>
          
          <!-- Button -->
          <div class="mt-auto">
            <a href="#" class="inline-block px-6 py-3 bg-gradient-to-r {{ $s['gradient'] }} text-white rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
              Explore <i class="bi bi-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- CTA Section -->
  <section class="mt-20 py-16 px-8 bg-gradient-to-r from-purple-600 via-blue-600 to-cyan-600 rounded-3xl text-white text-center shadow-2xl overflow-hidden relative">
    <div class="absolute inset-0 opacity-20" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 400%22><circle cx=%22200%22 cy=%22100%22 r=%2280%22 fill=%22white%22/><circle cx=%221000%22 cy=%22300%22 r=%22120%22 fill=%22white%22/></svg>');"></div>
    <div class="relative z-10">
      <h2 class="text-4xl font-bold mb-4">Looking for the perfect service?</h2>
      <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Browse our vendor directory and find exactly what you need for your event</p>
      <a href="{{ route('services') }}" class="inline-block px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
        Browse All Vendors
      </a>
    </div>
  </section>
</div>
@endsection
