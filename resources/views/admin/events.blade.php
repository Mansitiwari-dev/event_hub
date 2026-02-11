@extends('layouts.dashboard')

@section('title', 'All Events')
@section('page-title', 'All Events')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Organizer</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ optional($event->customer)->name ?? 'N/A' }}</td>
                    <td>{{ $event->start_date->format('M d, Y') }}</td>
                    <td>{{ $event->location }}</td>
                    <td><span style="background: #e1e8ed; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ ucfirst($event->status) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.deleteEvent', $event) }}" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center; color: #7f8c8d;">No events found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $events->links() }}
    </div>
</div>
@endsection
