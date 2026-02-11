{{-- Role-Based Navigation Bar --}}
<nav class="bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 shadow-2xl sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-3 group cursor-pointer">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-purple-300 via-pink-300 to-purple-300 bg-clip-text text-transparent">EventHub</span>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                @php
                    $userRole = auth()->user()?->role?->name ?? 'guest';
                    $navItems = [];
                    
                    if (auth()->check()) {
                        if ($userRole === 'admin') {
                            $navItems = [
                                ['icon' => '📊', 'label' => 'Dashboard', 'route' => 'dashboard.admin'],
                                ['icon' => '👥', 'label' => 'Users', 'route' => 'admin.users'],
                                ['icon' => '📋', 'label' => 'Events', 'route' => 'events.index'],
                            ];
                        } elseif ($userRole === 'event_manager') {
                            $navItems = [
                                ['icon' => '📊', 'label' => 'Dashboard', 'route' => 'dashboard.event_manager'],
                                ['icon' => '📅', 'label' => 'Events', 'route' => 'events.index'],
                                ['icon' => '📋', 'label' => 'Contracts', 'route' => 'event_manager.contracts'],
                                ['icon' => '👥', 'label' => 'Vendors', 'route' => 'event_manager.vendors'],
                            ];
                        } elseif ($userRole === 'vendor') {
                            $navItems = [
                                ['icon' => '📊', 'label' => 'Dashboard', 'route' => 'dashboard.vendor'],
                                ['icon' => '🎨', 'label' => 'Portfolio', 'route' => 'vendor.profile'],
                                ['icon' => '📋', 'label' => 'Contracts', 'route' => 'vendor.contracts'],
                            ];
                        } elseif ($userRole === 'customer') {
                            $navItems = [
                                ['icon' => '🏠', 'label' => 'Dashboard', 'route' => 'dashboard.customer'],
                                ['icon' => '📅', 'label' => 'Events', 'route' => 'dashboard.customer.events'],
                                ['icon' => '🎫', 'label' => 'Bookings', 'route' => 'dashboard.customer.bookings'],
                                ['icon' => '❤️', 'label' => 'Wishlist', 'route' => 'dashboard.customer.wishlist'],
                            ];
                        } elseif ($userRole === 'venue_manager') {
                            $navItems = [
                                ['icon' => '📊', 'label' => 'Dashboard', 'route' => 'dashboard.venue_manager'],
                                ['icon' => '🏢', 'label' => 'Venues', 'route' => 'venue_manager.venues'],
                                ['icon' => '📋', 'label' => 'Bookings', 'route' => 'venue_manager.bookings'],
                            ];
                        }
                    }
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="relative px-4 py-2 text-white font-medium transition-all duration-300 group
                                {{ request()->routeIs($item['route']) ? 'text-pink-300' : 'text-purple-100 hover:text-white' }}">
                        <span class="text-sm">{{ $item['icon'] }} {{ $item['label'] }}</span>
                        <div class="absolute bottom-0 left-0 h-0.5 bg-gradient-to-r from-purple-400 to-pink-400 transition-all duration-300 {{ request()->routeIs($item['route']) ? 'w-full' : 'w-0 group-hover:w-full' }}"></div>
                    </a>
                @endforeach
            </div>

            <!-- Right Side: Profile -->
            <div class="flex items-center space-x-4">
                @if (auth()->check())
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-white px-4 py-2 rounded-lg hover:bg-purple-800 transition-colors">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=6B46C1&color=fff" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-8 h-8 rounded-full border-2 border-purple-300">
                            <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 w-48 mt-2 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-purple-500/20">
                            <div class="p-2 space-y-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-purple-200 hover:text-white hover:bg-purple-700/30 rounded-lg transition-colors text-sm">
                                    👤 Profile
                                </a>
                                <hr class="border-purple-500/20 my-1">
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-300 hover:text-red-200 hover:bg-red-500/10 rounded-lg transition-colors text-sm">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="text-purple-200 hover:text-white font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-lg">
                        Sign Up
                    </a>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white p-2" id="mobile-menu-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-purple-700/30">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" 
                   class="block px-4 py-3 text-purple-200 hover:text-white hover:bg-purple-800/30 rounded-lg transition-colors
                            {{ request()->routeIs($item['route']) ? 'text-pink-300 bg-purple-800/30' : '' }}">
                    {{ $item['icon'] }} {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
