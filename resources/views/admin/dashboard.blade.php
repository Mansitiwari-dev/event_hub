@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Events</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_events'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-event fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add other stat cards similarly -->
    </div>

    <!-- Recent Events Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Recent Events</h6>
            <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add Event
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_events ?? [] as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->start_date->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $event->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No events found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection