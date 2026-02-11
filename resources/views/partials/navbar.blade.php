<!-- resources/views/partials/navbar.blade.php -->
@include('partials.role-navbar')
    <div class="container-fluid px-4">  <!-- Changed container to container-fluid and added px-4 -->
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-calendar-event me-2"></i>EventHub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
            <div class="d-flex align-items-center">
                @auth
                    <!-- Authenticated User Menu -->
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>{{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-gear me-2"></i>Profile Settings
                                </a>
                            </li>
                            <li>
                                @php
                                    $user = auth()->user();
                                    if ($user->roles->where('name', 'event_manager')->count()) {
                                        echo '<a class="dropdown-item" href="' . route('dashboard.event_manager') . '"><i class="bi bi-calendar-check me-2"></i>Event Manager Dashboard</a>';
                                    } elseif ($user->roles->where('name', 'venue_manager')->count()) {
                                        echo '<a class="dropdown-item" href="' . route('dashboard.venue_manager') . '"><i class="bi bi-building me-2"></i>Venue Manager Dashboard</a>';
                                    } elseif ($user->roles->where('name', 'vendor')->count()) {
                                        echo '<a class="dropdown-item" href="' . route('dashboard.vendor') . '"><i class="bi bi-briefcase me-2"></i>Vendor Dashboard</a>';
                                    } elseif ($user->roles->where('name', 'customer')->count()) {
                                        echo '<a class="dropdown-item" href="' . route('dashboard.customer') . '"><i class="bi bi-bag-heart me-2"></i>Customer Dashboard</a>';
                                    } elseif ($user->roles->where('name', 'admin')->count()) {
                                        echo '<a class="dropdown-item" href="' . route('dashboard.admin') . '"><i class="bi bi-shield-lock me-2"></i>Admin Dashboard</a>';
                                    }
                                @endphp
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
                    <!-- Guest User Menu -->
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>