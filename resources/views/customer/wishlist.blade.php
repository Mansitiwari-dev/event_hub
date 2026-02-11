@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Wishlist</h1>
    </div>

    <div class="row">
        <!-- Sample Wishlist Item -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Summer Music Festival</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">June 15, 2025</div>
                            <div class="mt-2">
                                <span class="badge bg-info text-white">Music</span>
                                <span class="badge bg-secondary text-white">Outdoor</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-music fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-primary">View Details</a>
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-heart-broken"></i> Remove
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sample Item -->
    </div>
</div>

@push('scripts')
<script>
    // Add any wishlist specific JavaScript here
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
@endsection
