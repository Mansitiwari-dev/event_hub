@extends('layouts.app')

@section('title', $vendor->name)

@section('app-content')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-primary to-secondary h-48"></div>
    <div class="p-8">
      <div class="flex items-start justify-between">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">{{ $vendor->name }}</h1>
          <p class="text-gray-600 mt-2">{{ ucfirst(optional($vendor->role)->name) }}</p>
          <div class="flex items-center mt-3 text-yellow-500">
            <span class="text-2xl">⭐</span>
            <span class="text-xl font-bold ml-2">4.8</span>
            <span class="text-gray-500 ml-2">(32 reviews)</span>
          </div>
        </div>
        <a href="{{ route('chats.conversations', ['u' => $vendor->id]) }}" class="px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-bold hover:opacity-95">Message</a>
      </div>

      <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-xl font-bold text-gray-800 mb-4">About</h3>
          <p class="text-gray-600">Professional event vendor with years of experience in creating memorable moments.</p>
        </div>
        <div>
          <h3 class="text-xl font-bold text-gray-800 mb-4">Services</h3>
          <ul class="text-gray-600 space-y-2">
            <li>✓ Event Planning</li>
            <li>✓ Vendor Coordination</li>
            <li>✓ Budget Management</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
