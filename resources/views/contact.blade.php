@extends('layouts.app')

@section('title', 'Contact — EventHub')

@section('content')
<style>
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
  }
  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
  }
  .fade-up { animation: fadeInUp 0.8s ease-out; }
  .slide-left { animation: slideInLeft 0.8s ease-out; }
  .slide-right { animation: slideInRight 0.8s ease-out; }
  .form-input {
    transition: all 0.3s ease;
  }
  .form-input:focus {
    transform: scale(1.02);
    border-color: #667eea;
  }
  .contact-card {
    transition: all 0.3s ease;
  }
  .contact-card:hover {
    transform: translateY(-8px);
  }
</style>
<div class="container mx-auto px-4 py-12">
  <!-- Header -->
  <div class="text-center mb-16">
    <h1 class="text-5xl font-bold text-gray-800 mb-4 fade-up">Get in Touch</h1>
    <p class="text-xl text-gray-600 max-w-2xl mx-auto fade-up" style="animation-delay: 0.1s;">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
  </div>

  <div class="grid md:grid-cols-3 gap-8 mb-16">
    <!-- Contact Info Cards -->
    <div class="contact-card bg-white rounded-2xl shadow-lg p-8 text-center border-t-4 border-blue-500 slide-left">
      <div class="text-5xl mb-4">📧</div>
      <h3 class="text-xl font-bold text-gray-800 mb-2">Email</h3>
      <p class="text-gray-600">info@eventhub.com</p>
      <p class="text-sm text-gray-500 mt-2">We typically respond within 2 hours</p>
    </div>

    <div class="contact-card bg-white rounded-2xl shadow-lg p-8 text-center border-t-4 border-purple-500 fade-up" style="animation-delay: 0.1s;">
      <div class="text-5xl mb-4">📱</div>
      <h3 class="text-xl font-bold text-gray-800 mb-2">Phone</h3>
      <p class="text-gray-600">+1 234 567 890</p>
      <p class="text-sm text-gray-500 mt-2">Available 24/7 for emergencies</p>
    </div>

    <div class="contact-card bg-white rounded-2xl shadow-lg p-8 text-center border-t-4 border-pink-500 slide-right" style="animation-delay: 0.2s;">
      <div class="text-5xl mb-4">📍</div>
      <h3 class="text-xl font-bold text-gray-800 mb-2">Address</h3>
      <p class="text-gray-600">123 Event Street</p>
      <p class="text-sm text-gray-500 mt-2">City, Country 12345</p>
    </div>
  </div>

  <!-- Contact Form -->
  <div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 slide-left">
      <h2 class="text-3xl font-bold text-gray-800 mb-8">Send us a Message</h2>
      <form id="contactForm" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
          <!-- Name Field -->
          <div class="fade-up" style="animation-delay: 0.1s;">
            <label class="block text-gray-700 font-semibold mb-3">Full Name</label>
            <input type="text" id="contactName" class="form-input w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all" placeholder="Your name" required>
          </div>

          <!-- Email Field -->
          <div class="fade-up" style="animation-delay: 0.15s;">
            <label class="block text-gray-700 font-semibold mb-3">Email Address</label>
            <input type="email" id="contactEmail" class="form-input w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all" placeholder="your@email.com" required>
          </div>
        </div>

        <!-- Subject Field -->
        <div class="fade-up" style="animation-delay: 0.2s;">
          <label class="block text-gray-700 font-semibold mb-3">Subject</label>
          <input type="text" id="contactSubject" class="form-input w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all" placeholder="How can we help?" required>
        </div>

        <!-- Message Field -->
        <div class="fade-up" style="animation-delay: 0.25s;">
          <label class="block text-gray-700 font-semibold mb-3">Message</label>
          <textarea id="contactMessage" class="form-input w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all" rows="6" placeholder="Tell us more about your inquiry..." required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="fade-up" style="animation-delay: 0.3s;">
          <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            Send Message
          </button>
          <span id="contactSuccess" class="block mt-4 text-center text-green-600 font-semibold d-none" style="display: none; color: #10b981;">✓ Message sent successfully!</span>
        </div>
      </form>
    </div>
  </div>

  <!-- FAQ Section -->
  <section class="mt-20 py-16 px-8 bg-gradient-to-r from-gray-50 to-white rounded-3xl border-2 border-gray-200">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Frequently Asked Questions</h2>
      <p class="text-gray-600">Find quick answers to common questions</p>
    </div>
    <div class="grid md:grid-cols-2 gap-8">
      <div class="group cursor-pointer">
        <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition">How quickly do you respond?</h3>
        <p class="text-gray-600 leading-relaxed">We respond to all inquiries within 2 business hours during working hours, and typically within 24 hours for all other times.</p>
      </div>
      <div class="group cursor-pointer">
        <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition">Is there a support fee?</h3>
        <p class="text-gray-600 leading-relaxed">No, our customer support is completely free for all EventHub users. We're always here to help!</p>
      </div>
      <div class="group cursor-pointer">
        <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition">Can I book a consultation?</h3>
        <p class="text-gray-600 leading-relaxed">Yes! You can schedule a free consultation with our team directly through the contact form or by calling us.</p>
      </div>
      <div class="group cursor-pointer">
        <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-cyan-600 transition">Do you have emergency support?</h3>
        <p class="text-gray-600 leading-relaxed">Absolutely! Our team is available 24/7 for event emergencies. Call us immediately for urgent assistance.</p>
      </div>
    </div>
  </section>
</div>
@endsection
