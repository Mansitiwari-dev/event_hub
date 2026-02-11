@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-white">
  <style>
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    @keyframes gradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .hero-title { animation: slideDown 0.8s ease-out; }
    .hero-subtitle { animation: slideDown 0.8s ease-out 0.2s both; }
    .hero-cta { animation: slideDown 0.8s ease-out 0.4s both; }
    .service-card-anim { animation: fadeInUp 0.6s ease-out 0.1s both; }
    .hero-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
      background-size: 200% 200%;
      animation: gradient 8s ease infinite;
    }
  </style>

  <!-- Hero -->
  <section class="hero-bg text-white py-28 overflow-hidden relative">
    <div class="absolute inset-0 opacity-20" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 600%22><circle cx=%22100%22 cy=%22100%22 r=%2280%22 fill=%22white%22/><circle cx=%221100%22 cy=%22500%22 r=%22120%22 fill=%22white%22/></svg>');"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
      <h1 class="hero-title text-6xl md:text-7xl font-bold mb-4 drop-shadow-lg">EventHub</h1>
      <p class="hero-subtitle text-2xl text-white/95 mb-8 max-w-3xl mx-auto font-light drop-shadow-md">Connect with trusted vendors, manage bookings, and create unforgettable moments with ease</p>
      <div class="hero-cta">
        <a href="#register" class="inline-block px-8 py-4 bg-white text-purple-600 font-bold rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">Get Started Free</a>
      </div>
    </div>
  </section>

  <!-- Register -->
  <section id="register" class="py-32 bg-gradient-to-b from-white via-gray-50 to-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16 animate-fadeInUp">
        <h2 class="text-5xl font-bold text-gray-800 mb-4">Join EventHub Today</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Choose your role and start connecting with professionals</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <!-- Customer Card -->
        <div class="service-card-anim group bg-white rounded-2xl shadow-lg p-10 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border-t-4 border-blue-500 cursor-pointer">
          <div class="text-6xl mb-6 transform group-hover:scale-125 transition-transform duration-300">👥</div>
          <h3 class="text-2xl font-bold text-gray-800 mb-3">Customer</h3>
          <p class="text-gray-600 mb-8 leading-relaxed">Discover and book professional vendors for your events with confidence.</p>
          <a href="{{ route('register', ['role' => 'customer']) }}" class="w-full block px-4 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">Register as Customer</a>
        </div>

        <!-- Organizer Card -->
        <div class="service-card-anim group bg-white rounded-2xl shadow-lg p-10 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border-t-4 border-purple-500 cursor-pointer" style="animation-delay: 0.1s;">
          <div class="text-6xl mb-6 transform group-hover:scale-125 transition-transform duration-300">🎯</div>
          <h3 class="text-2xl font-bold text-gray-800 mb-3">Organizer</h3>
          <p class="text-gray-600 mb-8 leading-relaxed">Plan and manage events with multiple vendor teams effortlessly.</p>
          <a href="{{ route('register', ['role' => 'organizer']) }}" class="w-full block px-4 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">Register as Organizer</a>
        </div>

        <!-- Vendor Card -->
        <div class="service-card-anim group bg-white rounded-2xl shadow-lg p-10 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border-t-4 border-amber-500 cursor-pointer" style="animation-delay: 0.2s;">
          <div class="text-6xl mb-6 transform group-hover:scale-125 transition-transform duration-300">⭐</div>
          <h3 class="text-2xl font-bold text-gray-800 mb-3">Vendor</h3>
          <p class="text-gray-600 mb-8 leading-relaxed">Showcase your services and grow your event business globally.</p>
          <a href="{{ route('register', ['role' => 'vendor']) }}" class="w-full block px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-lg font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">Register as Vendor</a>
        </div>
      </div>

      <div class="text-center animate-fadeInUp" style="animation-delay: 0.3s;">
        <p class="text-gray-600 text-lg">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:text-blue-700 transition">Sign in here</a></p>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section class="py-32 bg-gradient-to-br from-white to-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-5xl font-bold text-gray-800 mb-4">Why Choose EventHub?</h2>
        <p class="text-xl text-gray-600">Everything you need for perfect events</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Feature 1 -->
        <div class="group text-center p-8 rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-b-4 border-blue-500 cursor-pointer service-card-anim">
          <div class="text-6xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">⚡</div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Fast & Easy</h3>
          <p class="text-gray-600">Get started in minutes with simple registration and setup.</p>
        </div>
        <!-- Feature 2 -->
        <div class="group text-center p-8 rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-b-4 border-green-500 cursor-pointer service-card-anim" style="animation-delay: 0.1s;">
          <div class="text-6xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">🔒</div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Secure</h3>
          <p class="text-gray-600">Your data is protected with enterprise-grade security.</p>
        </div>
        <!-- Feature 3 -->
        <div class="group text-center p-8 rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-b-4 border-pink-500 cursor-pointer service-card-anim" style="animation-delay: 0.2s;">
          <div class="text-6xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">💬</div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Direct Chat</h3>
          <p class="text-gray-600">Communicate seamlessly with vendors or clients instantly.</p>
        </div>
        <!-- Feature 4 -->
        <div class="group text-center p-8 rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-b-4 border-purple-500 cursor-pointer service-card-anim" style="animation-delay: 0.3s;">
          <div class="text-6xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">📊</div>
          <h3 class="text-xl font-bold text-gray-800 mb-3">Real-time</h3>
          <p class="text-gray-600">Track events and bookings in real-time with updates.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 opacity-90"></div>
    <div class="absolute inset-0 opacity-30" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 600%22><circle cx=%2250%22 cy=%2250%22 r=%22100%22 fill=%22white%22/><circle cx=%221150%22 cy=%22550%22 r=%22150%22 fill=%22white%22/></svg>');"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
      <h2 class="text-5xl font-bold mb-6 drop-shadow-lg animate-slideDown text-white">Ready to Transform Your Events?</h2>
      <p class="text-2xl text-white/95 mb-10 max-w-2xl mx-auto drop-shadow-md" style="animation: slideDown 0.8s ease-out 0.2s both;">Join thousands of customers and vendors already creating amazing events with EventHub.</p>
      <a href="#register" class="inline-block px-10 py-4 bg-white text-purple-600 font-bold text-lg rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer" style="animation: slideDown 0.8s ease-out 0.4s both;">Get Started Now</a>
    </div>
  </section>
</div>
@endsection