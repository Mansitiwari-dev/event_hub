@extends('layouts.dashboard')

@section('title', 'My Tickets')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">My Tickets</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#downloadTicketModal">
            <i class="bi bi-download me-2"></i>Download All
        </button>
    </div>

    <!-- Upcoming Events -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0">Upcoming Events</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Ticket Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Ticket 1 -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60" alt="Event" class="rounded me-3" style="width: 60px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0">Summer Music Festival</h6>
                                        <small class="text-muted">Order #EVT-2023-001</small>
                                    </div>
                                </div>
                            </td>
                            <td>Jun 15, 2023<br><small class="text-muted">7:00 PM</small></td>
                            <td>Central Park, New York</td>
                            <td>VIP Pass</td>
                            <td><span class="badge bg-success">Confirmed</span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ticketDetailsModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Sample Ticket 2 -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60" alt="Event" class="rounded me-3" style="width: 60px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0">Tech Conference 2023</h6>
                                        <small class="text-muted">Order #EVT-2023-002</small>
                                    </div>
                                </div>
                            </td>
                            <td>Jul 22, 2023<br><small class="text-muted">9:00 AM</small></td>
                            <td>Convention Center, San Francisco</td>
                            <td>Standard Pass</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ticketDetailsModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                        <i class="bi bi-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Past Events -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0">Past Events</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Ticket Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Past Ticket 1 -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60" alt="Event" class="rounded me-3" style="width: 60px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0">Spring Jazz Night</h6>
                                        <small class="text-muted">Order #EVT-2023-000</small>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 10, 2023<br><small class="text-muted">8:00 PM</small></td>
                            <td>Downtown Club, Chicago</td>
                            <td>General Admission</td>
                            <td><span class="badge bg-secondary">Completed</span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Ticket Details Modal -->
<div class="modal fade" id="ticketDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ticket Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6>Event Information</h6>
                            <hr class="mt-2 mb-3">
                            <p class="mb-1"><strong>Event:</strong> Summer Music Festival</p>
                            <p class="mb-1"><strong>Date:</strong> June 15, 2023</p>
                            <p class="mb-1"><strong>Time:</strong> 7:00 PM - 11:00 PM</p>
                            <p class="mb-1"><strong>Location:</strong> Central Park, New York</p>
                        </div>
                        
                        <div class="mb-4">
                            <h6>Ticket Information</h6>
                            <hr class="mt-2 mb-3">
                            <p class="mb-1"><strong>Ticket Type:</strong> VIP Pass</p>
                            <p class="mb-1"><strong>Ticket Number:</strong> VIP-2023-001234</p>
                            <p class="mb-1"><strong>Order Number:</strong> EVT-2023-001</p>
                            <p class="mb-1"><strong>Purchase Date:</strong> May 10, 2023</p>
                            <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center mb-4">
                            <div class="bg-light p-4 rounded mb-3">
                                <img src="https://via.placeholder.com/200" alt="QR Code" class="img-fluid mb-2" style="max-width: 200px;">
                                <p class="text-muted small mb-0">Scan this code at the entrance</p>
                            </div>
                            <button class="btn btn-outline-primary me-2">
                                <i class="bi bi-download me-1"></i> Download Ticket
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-share me-1"></i> Share
                            </button>
                        </div>
                        
                        <div class="border rounded p-3">
                            <h6>Event Organizer</h6>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/50" alt="Organizer" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <p class="mb-0 fw-bold">Music Events Inc.</p>
                                    <p class="mb-0 small text-muted">contact@musicevents.com</p>
                                    <p class="mb-0 small text-muted">+1 (555) 123-4567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Contact Support</button>
            </div>
        </div>
    </div>
</div>

<!-- Download Ticket Modal -->
<div class="modal fade" id="downloadTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download Tickets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Select the format you'd like to download your tickets in:</p>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary text-start">
                        <i class="bi bi-filetype-pdf me-2"></i> Download as PDF
                    </button>
                    <button class="btn btn-outline-primary text-start">
                        <i class="bi bi-file-earmark-image me-2"></i> Download as Image
                    </button>
                    <button class="btn btn-outline-primary text-start">
                        <i class="bi bi-file-earmark-text me-2"></i> Download as Text
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .ticket-card {
        transition: transform 0.2s ease-in-out;
    }
    .ticket-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .qr-code {
        background: #fff;
        padding: 1rem;
        border-radius: 0.5rem;
        display: inline-block;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any ticket-related JavaScript here
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
