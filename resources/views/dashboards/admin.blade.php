<!-- resources/views/dashboards/admin.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .stat-card {
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard Overview</h1>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card bg-primary bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h3 class="mb-0">1,254</h3>
                        </div>
                        <div class="stat-icon text-primary">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-success bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Events</h6>
                            <h3 class="mb-0">324</h3>
                        </div>
                        <div class="stat-icon text-success">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-warning bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Active Vendors</h6>
                            <h3 class="mb-0">187</h3>
                        </div>
                        <div class="stat-icon text-warning">
                            <i class="bi bi-shop"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-info bg-opacity-10 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Bookings</h6>
                            <h3 class="mb-0">2,541</h3>
                        </div>
                        <div class="stat-icon text-info">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- resources/views/dashboards/admin.blade.php -->
<!-- Add this after the existing stats cards -->
<div class="row g-4 mb-4">
    <!-- Revenue Overview Card -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Revenue Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Recent Transactions -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Transactions</h5>
                <a href="#" class="btn btn-sm btn-link">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($recentTransactions ?? [] as $transaction)
                    <div class="list-group-item border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $transaction->description }}</h6>
                                <small class="text-muted">{{ $transaction->created_at->diffForHumans() }}</small>
                            </div>
                            <span class="badge bg-{{ $transaction->status === 'completed' ? 'success' : 'warning' }}">
                                ${{ number_format($transaction->amount, 2) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this before the closing @endsection -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [12000, 19000, 15000, 25000, 22000, 30000],
                borderColor: '#4e54c8',
                backgroundColor: 'rgba(78, 84, 200, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endpush 
    <!-- Recent Activities -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Activities</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>User</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>New user registration</td>
                                    <td>John Doe</td>
                                    <td>2 mins ago</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Event created</td>
                                    <td>Jane Smith</td>
                                    <td>1 hour ago</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>Booking confirmed</td>
                                    <td>Mike Johnson</td>
                                    <td>3 hours ago</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Vendor approved</td>
                                    <td>Sarah Wilson</td>
                                    <td>5 hours ago</td>
                                    <td><span class="badge bg-info">In Progress</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Quick Stats</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted">New Users This Month</h6>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted">75% increase from last month</small>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-muted">Event Completion Rate</h6>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted">85% of events completed successfully</small>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-muted">Vendor Approval Rate</h6>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted">65% approval rate this month</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle sidebar
    document.getElementById('sidebarCollapse').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
        document.querySelector('.content-wrapper').classList.toggle('active');
    });
</script>
@endpush