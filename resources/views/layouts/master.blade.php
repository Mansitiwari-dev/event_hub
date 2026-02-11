<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'EventHub')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#667eea', secondary: '#764ba2' } } } }</script>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @stack('styles')
</head>
<body class="antialiased bg-gray-50 text-sm">

<nav class="bg-white shadow-sm">
  <div class="container mx-auto px-4 py-3 flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center space-x-3">
      <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold">EH</div>
      <div>
        <div class="font-semibold text-gray-800">EventHub</div>
        <div class="text-xs text-gray-500">Event Management</div>
      </div>
    </a>

    <div>
          @guest
        <ul class="flex items-center space-x-4 text-gray-700">
          <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
          <li><a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
          <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
          <li><a href="{{ route('login') }}" class="ml-2 px-3 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg shadow">Login</a></li>
        </ul>
      @else
        @php $user = auth()->user(); $role = optional($user->role)->name ?? ''; @endphp
        <ul class="flex items-center space-x-3 text-gray-700">
          @if(stripos($role, 'Admin') !== false)
            <li><a href="{{ route('dashboard.admin') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('dashboard.admin') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Dashboard</a></li>
            <li><a href="{{ route('admin.users') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('admin.users') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Users</a></li>
          @elseif(stripos($role, 'Organizer') !== false)
            <li><a href="{{ route('dashboard.organizer') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('dashboard.organizer') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Dashboard</a></li>
            @if(Route::has('events.index'))
              <li><a href="{{ route('events.index') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('events.*') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Events</a></li>
            @endif
          @elseif(stripos($role, 'Customer') !== false)
            <li><a href="{{ route('dashboard.customer') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('dashboard.customer') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Dashboard</a></li>
            @if(Route::has('vendors.index'))
              <li><a href="{{ route('vendors.index') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('vendors.*') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Vendors</a></li>
            @endif
          @else
            <li><a href="{{ route('dashboard.vendor') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('dashboard.vendor') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Dashboard</a></li>
            <li><a href="{{ route('dashboard.vendor') }}" class="px-3 py-2 rounded-md hover:text-primary">Profile</a></li>
          @endif

          @if(Route::has('chats.conversations'))
            <li><a href="{{ route('chats.conversations') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('chats.*') ? 'bg-gray-100 text-primary' : 'hover:text-primary' }}">Messages</a></li>
          @endif

          <li class="ml-2">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="px-3 py-1 rounded-md text-sm bg-gray-100 hover:bg-gray-200">Logout</button>
            </form>
          </li>
        </ul>
      @endguest
    </div>
  </div>
</nav>

<main class="py-6">
    @if(session('success'))
      <div class="container mx-auto px-4">
        <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
      </div>
    @endif

    @yield('content')
</main>

<footer class="mt-12 py-6 bg-white border-t">
  <div class="container mx-auto px-4 text-center text-sm text-gray-500">
    © {{ date('Y') }} EventHub — {{ date('Y') }}
  </div>
</footer>

@stack('scripts')
</body>
</html>