@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Bookings</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="bookingsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Booking Row -->
                        <tr>
                            <td>#BK-001</td>
                            <td>Summer Music Festival</td>
                            <td>June 15, 2025</td>
                            <td><span class="badge bg-success text-white">Confirmed</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">View</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Download</a>
                            </td>
                        </tr>
                        <!-- End Sample Row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#bookingsTable').DataTable({
            responsive: true,
            order: [[2, 'desc']] // Sort by date by default
        });
    });
</script>
@endpush
@endsection
