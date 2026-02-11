<!-- resources/views/dashboards/vendor.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Vendor Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Vendor Dashboard</h1>
    
    <!-- Vendor Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card bg-primary bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Bookings</h6>
                            <h3 class="mb-0">156</h3>
                        </div>
                        <div class="stat-icon text-primary">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more vendor-specific stat cards -->
    </div>

    <!-- Recent Bookings -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Bookings</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Event</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#BK-001</td>
                                    <td>Tech Conference 2023</td>
                                    <td>John Doe</td>
                                    <td>Dec 15, 2023</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                </tr>
                                <!-- More booking rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsections