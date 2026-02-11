<!-- resources/views/dashboards/customer.blade.php -->
@extends('layouts.dashboard')

@section('title', 'My Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Welcome back, {{ Auth::user()->name ?? 'Customer' }}!</h1>
    
    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-calendar-plus fs-3 text-primary"></i>
                    </div>
                    <h5>Book an Event</h5>
                    <p class="text-muted">Find and book your next event</p>
                    <a href="{{ route('events.index') }}" class="btn btn-primary">Browse Events</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-ticket-perforated fs-3 text-success"></i>
                    </div>
                    <h5>My Tickets</h5>
                    <p class="text-muted">View and manage your event tickets</p>
                    <a href="{{ route('dashboard.customer.tickets') }}" class="btn btn-success">View Tickets</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Upcoming Events</h5>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @foreach($upcomingEvents ?? [] as $event)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="{{ $event->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $event->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <p class="text-muted">
                                        <i class="bi bi-calendar-event me-2"></i>{{ $event->date->format('M d, Y') }}<br>
                                        <i class="bi bi-geo-alt me-2"></i>{{ $event->location }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">{{ $event->category }}</span>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection