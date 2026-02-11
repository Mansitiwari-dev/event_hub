@extends('layouts.dashboard')

@section('title', 'All Bookings')
@section('page-title', 'All Bookings')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ optional($booking->event)->title ?? 'N/A' }}</td>
                    <td>{{ optional($booking->user)->name ?? 'N/A' }}</td>
                    <td><span style="background: #e1e8ed; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ ucfirst($booking->status) }}</span></td>
                    <td>${{ number_format($booking->amount, 2) }}</td>
                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center; color: #7f8c8d;">No bookings found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
