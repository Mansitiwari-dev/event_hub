<aside class="sidebar">
    <div class="d-flex flex-column h-100">
        <!-- Logo -->
        <div class="sidebar-logo text-center p-3">
            <a href="{{ route('home') }}" class="text-white text-decoration-none d-flex align-items-center justify-content-center">
                <i class="bi bi-calendar-event fs-4 me-2"></i>
                <span class="fs-5 fw-bold">EventHub</span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-grow-1">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <span class="nav-item-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events.index') }}" class="nav-link text-white">
                        <i class="bi bi-calendar-event me-2"></i>
                        <span class="nav-item-text">Events</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.customer.messages') }}" class="nav-link text-white">
                        <i class="bi bi-chat-dots me-2"></i>
                        <span class="nav-item-text">Messages</span>
                        <span class="position-absolute top-50 end-0 translate-middle-y badge rounded-pill bg-danger" style="font-size: 0.6rem; padding: 0.25rem 0.4rem;">
                            3
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </li>
                <!-- Add more navigation items as needed -->
            </ul>
        </nav>

        <!-- User Menu -->
        <div class="p-3 border-top">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-2"></i>
                  @auth
    <span class="nav-item-text">{{ auth()->user()->name }}</span>
@endauth

                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>