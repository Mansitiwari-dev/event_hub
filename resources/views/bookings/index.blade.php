@extends('layouts.dashboard')

@section('title', 'Bookings')
@section('page-title', 'My Bookings')

@section('content')

@if (session('success'))
    <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 14px; margin-bottom: 20px; border-radius: 4px; color: #065f46;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="background: #fee2e2; border-left: 4px solid #ef4444; padding: 14px; margin-bottom: 20px; border-radius: 4px; color: #7f1d1d;">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Bookings for Your Events</h2>
    </div>

    @if ($bookings->count())
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Customer</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>
                                <strong>{{ $booking->event->title ?? 'N/A' }}</strong>
                                <div style="font-size: 12px; color: #666;">{{ $booking->event->location ?? '' }}</div>
                            </td>
                            <td>{{ $booking->user->name ?? $booking->customer->name ?? 'N/A' }}</td>
                            <td>{{ $booking->created_at->format('M d, Y') }}</td>
                            <td>
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;
                                    background: {{ $booking->status == 'pending' ? '#fef3c7' : ($booking->status == 'confirmed' ? '#d1fae5' : '#fee2e2') }};
                                    color: {{ $booking->status == 'pending' ? '#92400e' : ($booking->status == 'confirmed' ? '#065f46' : '#7f1d1d') }};">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>${{ number_format($booking->amount ?? 0, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('bookings.update', $booking) }}" style="display: inline;">
                                    @csrf @method('PUT')
                                    @if ($booking->status != 'confirmed')
                                        <button type="submit" name="status" value="confirmed" class="btn btn-primary" style="padding: 6px 10px; font-size: 12px;">Confirm</button>
                                    @endif
                                </form>
                                <form method="POST" action="{{ route('bookings.destroy', $booking) }}" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 12px;">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $bookings->links() }}
        </div>
    @else
        <p style="text-align: center; color: #666; padding: 40px 20px;">No bookings yet. Once customers book your events, they'll appear here.</p>
    @endif
</div>
                        <a href="{{ route('bookings.show', $booking) }}" class="text-primary-blue hover:underline text-sm font-semibold block">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-600">No bookings found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
