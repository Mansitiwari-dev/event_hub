@extends('layouts.dashboard')

@section('title', 'Organizer Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

@php
    $stats = $stats ?? [
        'total_events' => 0,
        'total_bookings' => 0,
        'pending_bookings' => 0,
        'confirmed_bookings' => 0,
    ];

    $recent_events = $recent_events ?? collect([]);
    $recent_bookings = $recent_bookings ?? collect([]);
@endphp

<style>
    body {
        background: #f4f6f8;
        font-family: 'Segoe UI', sans-serif;
    }

    .welcome-message {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        text-align: center;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,.05);
        display: flex;
        gap: 15px;
        align-items: center;
        border-left: 5px solid #6366f1;
    }

    .stat-card .icon {
        font-size: 36px;
    }

    .stat-card h4 {
        margin: 0;
        font-size: 14px;
        color: #6b7280;
    }

    .stat-card .number {
        font-size: 30px;
        font-weight: bold;
    }

    .card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
    }

    th {
        background: #f1f5f9;
        text-align: left;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        text-decoration: none;
        color: #fff;
    }

    .btn-primary { background: #6366f1; }
    .btn-secondary { background: #64748b; }
    .btn-danger { background: #ef4444; }

    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }

    .active { background:#d1fae5;color:#065f46 }
    .pending { background:#fef3c7;color:#92400e }
    .confirmed { background:#dbeafe;color:#1e40af }
    .cancelled { background:#fee2e2;color:#991b1b }
</style>

<!-- Welcome -->
<div class="welcome-message">
    <h2>Welcome, {{ auth()->user()->name ?? 'Organizer' }} 👋</h2>
    <p>Manage your events easily from here</p>
</div>

<!-- Stats -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="icon">📅</div>
        <div>
            <h4>Total Events</h4>
            <div class="number">{{ $stats['total_events'] }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="icon">🎫</div>
        <div>
            <h4>Total Bookings</h4>
            <div class="number">{{ $stats['total_bookings'] }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="icon">⏳</div>
        <div>
            <h4>Pending</h4>
            <div class="number">{{ $stats['pending_bookings'] }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="icon">✅</div>
        <div>
            <h4>Confirmed</h4>
            <div class="number">{{ $stats['confirmed_bookings'] }}</div>
        </div>
    </div>
</div>

<!-- Events -->
<div class="card">
    <h3>My Events</h3>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->start_date ?? '-' }}</td>
                    <td>
                        <span class="status-badge {{ strtolower($event->status) }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-secondary">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">No events found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
