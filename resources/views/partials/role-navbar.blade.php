<!-- Role-Based Navigation Bar -->
@php
    $user = auth()->user();
    // Check for Event Manager / Organizer role (multiple possible role names)
    $isEventManager = $user && (
        $user->hasRole('organizer') || 
        $user->hasRole('event_manager') || 
        $user->hasRole('manager') ||
        ($user->role && in_array(strtolower($user->role->name), ['organizer', 'event_manager', 'manager']))
    );
    $isVendor = $user && ($user->hasRole('vendor') || ($user->role && strtolower($user->role->name) === 'vendor'));
    $isCustomer = $user && ($user->hasRole('customer') || ($user->role && strtolower($user->role->name) === 'customer'));
    $isAdmin = $user && ($user->hasRole('admin') || ($user->role && strtolower($user->role->name) === 'admin'));
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary fixed-top shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-calendar-event me-2 fs-4"></i>
            <span class="fs-4">EventHub</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                @if($isEventManager)
                    <!-- Event Manager / Organizer Menu -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.manager') || request()->routeIs('dashboard.organizer') || request()->routeIs('dashboard.event_manager') ? 'active' : '' }}" 
                               href="{{ route('dashboard.manager') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.*') || request()->routeIs('organizer.events.*') ? 'active' : '' }}" 
                               href="{{ route('events.index') }}">
                                <i class="bi bi-calendar-event me-1"></i>Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('manager.attendees.*') ? 'active' : '' }}" 
                               href="{{ route('manager.attendees.index') }}">
                                <i class="bi bi-people me-1"></i>Attendees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('manager.tickets.*') ? 'active' : '' }}" 
                               href="{{ route('manager.tickets.index') }}">
                                <i class="bi bi-ticket-perforated me-1"></i>Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vendors.*') || request()->routeIs('event_manager.vendors') ? 'active' : '' }}" 
                               href="{{ route('vendors.index') }}">
                                <i class="bi bi-briefcase me-1"></i>Vendors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('manager.payments.*') ? 'active' : '' }}" 
                               href="{{ route('manager.payments.index') }}">
                                <i class="bi bi-credit-card me-1"></i>Payments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('manager.reports.*') ? 'active' : '' }}" 
                               href="{{ route('manager.reports.index') }}">
                                <i class="bi bi-graph-up me-1"></i>Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('manager.calendar.*') ? 'active' : '' }}" 
                               href="{{ route('manager.calendar.index') }}">
                                <i class="bi bi-calendar3 me-1"></i>Calendar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('manager.settings.*') ? 'active' : '' }}" 
                               href="{{ route('manager.settings.index') }}">
                                <i class="bi bi-gear me-1"></i>Settings
                            </a>
                        </li>
                    </ul>
                @elseif($isVendor)
                    <!-- Vendor Menu -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.vendor') ? 'active' : '' }}" 
                               href="{{ route('dashboard.vendor') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vendor.contracts.*') ? 'active' : '' }}" 
                               href="{{ route('vendor.contracts') }}">
                                <i class="bi bi-file-earmark-text me-1"></i>Contracts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vendor.profile.*') ? 'active' : '' }}" 
                               href="{{ route('vendor.profile') }}">
                                <i class="bi bi-person-circle me-1"></i>Profile
                            </a>
                        </li>
                    </ul>
                @elseif($isCustomer)
                    <!-- Customer Menu -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.customer') ? 'active' : '' }}" 
                               href="{{ route('dashboard.customer') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.customer.bookings') ? 'active' : '' }}" 
                               href="{{ route('dashboard.customer.bookings') }}">
                                <i class="bi bi-calendar-check me-1"></i>Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.customer.tickets') ? 'active' : '' }}" 
                               href="{{ route('dashboard.customer.tickets') }}">
                                <i class="bi bi-ticket-perforated me-1"></i>Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vendors.*') ? 'active' : '' }}" 
                               href="{{ route('vendors.index') }}">
                                <i class="bi bi-briefcase me-1"></i>Vendors
                            </a>
                        </li>
                    </ul>
                @elseif($isAdmin)
                    <!-- Admin Menu -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}" 
                               href="{{ route('dashboard.admin') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                               href="{{ route('admin.users') }}">
                                <i class="bi bi-people me-1"></i>Users
                            </a>
                        </li>
                    </ul>
                @else
                    <!-- Default Authenticated Menu -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                               href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" 
                               href="{{ route('events.index') }}">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vendors.*') ? 'active' : '' }}" 
                               href="{{ route('vendors.index') }}">Vendors</a>
                        </li>
                    </ul>
                @endif
            @else
                <!-- Guest Menu -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                           href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" 
                           href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" 
                           href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" 
                           href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            @endauth
            
            <!-- User Dropdown -->
            <div class="d-flex align-items-center">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            <span>{{ $user->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-gear me-2"></i>Profile Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-light">
                        <i class="bi bi-person-plus me-1"></i>Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar {
        padding: 0.75rem 0;
        transition: all 0.3s ease;
    }
    
    .navbar-brand {
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .navbar-brand:hover {
        transform: scale(1.05);
    }
    
    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }
    
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: 600;
    }
    
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 2px;
        background-color: white;
        border-radius: 2px;
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        border-radius: 0.75rem;
        padding: 0.5rem;
    }
    
    .dropdown-item {
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .btn-outline-light {
        border-width: 2px;
        transition: all 0.3s ease;
    }
    
    .btn-outline-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }
    
    @media (max-width: 991px) {
        .navbar-collapse {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .nav-link {
            margin: 0.25rem 0;
        }
    }
</style>
