@extends('layouts.dashboard')

@section('title', 'My Messages')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">My Messages</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
            <i class="bi bi-plus-lg me-2"></i>New Message
        </button>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Search messages...">
                    </div>
                </div>
                <div class="list-group list-group-flush" style="max-height: 600px; overflow-y: auto;">
                    <!-- Conversation List -->
                    <a href="#" class="list-group-item list-group-item-action active">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">John Doe</h6>
                            <small>2 min ago</small>
                        </div>
                        <p class="mb-1">Hey! How are you doing?</p>
                        <small>Click to view conversation</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Event Organizers</h6>
                            <small>1 hour ago</small>
                        </div>
                        <p class="mb-1">Your event has been approved!</p>
                    </a>
                    <!-- More conversations... -->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">John Doe</h6>
                        <small class="text-muted">Online</small>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-telephone"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="height: 500px; overflow-y: auto;">
                    <!-- Messages -->
                    <div class="p-4">
                        <!-- Received Message -->
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 me-3">
                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
                            </div>
                            <div>
                                <div class="bg-light rounded p-3">
                                    <p class="mb-0">Hey there! How are you?</p>
                                    <small class="text-muted">10:30 AM</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sent Message -->
                        <div class="d-flex justify-content-end mb-4">
                            <div class="text-end">
                                <div class="bg-primary text-white rounded p-3">
                                    <p class="mb-0">I'm doing great, thanks for asking! How about you?</p>
                                    <small>10:32 AM</small>
                                </div>
                            </div>
                        </div>
                        <!-- More messages... -->
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type your message...">
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Message Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">To</label>
                        <input type="text" class="form-control" placeholder="Search users...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="4" placeholder="Type your message..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send Message</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .list-group-item.active {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #212529;
    }
    .list-group-item.active .text-muted {
        color: #6c757d !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize any message-related JavaScript here
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
