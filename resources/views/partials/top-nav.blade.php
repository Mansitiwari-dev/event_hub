<!-- resources/views/partials/top-nav.blade.php -->
<nav class="top-navbar navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid px-4">
        <!-- Sidebar Toggle Button -->
        <button type="button" id="sidebarCollapse" class="btn btn-link text-dark p-0 me-3">
            <i class="bi bi-list fs-4"></i>
        </button>
        
        <!-- Brand/Logo - Hidden on mobile -->
        <a class="navbar-brand d-none d-md-block me-auto" href="{{ route('dashboard') }}">
            <span class="fw-bold text-primary">EventHub</span>
        </a>
        
        <div class="d-flex align-items-center">
            <!-- Notifications Dropdown -->
            <div class="dropdown me-3">
                <a href="#" class="position-relative text-dark" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; padding: 0.25rem 0.4rem;">
                        3
                        <span class="visually-hidden">unread notifications</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end shadow border-0" style="min-width: 300px;" aria-labelledby="notificationsDropdown">
                    <li class="px-3 py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">Notifications</h6>
                            <span class="badge bg-primary rounded-pill">3 New</span>
                        </div>
                    </li>
                    <li class="dropdown-notification">
                        <a class="dropdown-item d-flex align-items-center p-3" href="#">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                    <i class="bi bi-calendar-check text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">New Booking</h6>
                                    <small class="text-muted">2m ago</small>
                                </div>
                                <p class="mb-0 small text-muted">New booking received for "Summer Party"</p>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider my-1"></li>
                    <li class="text-center py-2">
                        <a href="#" class="text-decoration-none small">View all notifications</a>
                    </li>
                </ul>
            </div>
            
            <!-- User Dropdown -->
            @auth
<div class="dropdown">
    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
       id="userDropdown" data-bs-toggle="dropdown">

        <div class="position-relative">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff"
                 alt="{{ auth()->user()->name }}"
                 class="rounded-circle"
                 width="36"
                 height="36">

            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                  style="width: 10px; height: 10px;"></span>
        </div>

        <div class="ms-2 d-none d-md-block">
            <div class="fw-medium text-dark">{{ auth()->user()->name }}</div>
            <small class="text-muted">Admin</small>
        </div>
    </a>
</div>
@endauth

        </div>
    </div>
</nav>