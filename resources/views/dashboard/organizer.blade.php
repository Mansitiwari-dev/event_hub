@extends('layouts.master')

@section('title', 'Organizer Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h2 class="text-2xl font-semibold">Organizer Dashboard</h2>
  <p class="text-gray-600 mt-2">Welcome, {{ auth()->user()->name }}.</p>
  <div class="mt-6">
    <h3 class="font-medium">Your Events</h3>
    <div class="mt-3 bg-white p-4 rounded shadow">@foreach($events ?? [] as $ev) <div class="py-2 border-b">{{ $ev->title ?? 'Untitled' }}</div> @endforeach</div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('app-content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Organizer Dashboard</h1>
      <p class="text-gray-500 mt-1">Manage your events and bookings</p>
    </div>
    <div>
      @if(Route::has('events.create'))
        <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg shadow">Create Event</a>
      @endif
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-5">
      <div class="text-sm text-gray-500">My Events</div>
      <div class="text-2xl font-bold text-gray-800">{{ $events_count ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
      <div class="text-sm text-gray-500">Upcoming</div>
      <div class="text-2xl font-bold text-gray-800">{{ $upcoming_count ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
      <div class="text-sm text-gray-500">Booking Requests</div>
      <div class="text-2xl font-bold text-gray-800">{{ $booking_requests ?? 0 }}</div>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow p-5">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">My Events</h3>
    @if(!empty($events) && $events->count())
      <div class="space-y-4">
        @foreach($events as $event)
          <div class="flex items-center justify-between p-3 border rounded hover:shadow-md transition">
            <div>
              <div class="font-semibold text-gray-800">{{ $event->name }}</div>
              <div class="text-xs text-gray-500">{{ $event->event_type ?? '' }} • {{ optional($event->date)->format('d M Y') ?? '' }}</div>
            </div>
            <div class="text-right">
              <div class="text-sm {{ $event->status == 'confirmed' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($event->status ?? 'pending') }}</div>
              <a href="{{ route('events.show', $event) }}" class="mt-2 inline-block text-indigo-600 text-sm">View</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-4">
        {{ $events->links() }}
      </div>
    @else
      <div class="text-gray-500">No events found. Create your first event.</div>
    @endif
  </div>
</div>
@endsection