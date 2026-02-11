<!-- resources/views/dashboards/manager.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Event Manager Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Event Manager Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card bg-primary bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Events</h6>
                            <h3 class="mb-0">24</h3>
                            <small class="text-success">+5 from last month</small>
                        </div>
                        <div class="stat-icon text-primary">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more stat cards for Manager -->
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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tech Conference 2023</td>
                                    <td>Dec 15, 2023</td>
                                    <td>Convention Center</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <!-- More event rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection