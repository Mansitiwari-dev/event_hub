<!-- Sidebar -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <h3>EventHub</h3>
  </div>

  <nav class="sidebar-nav">
    @if(auth()->user()->isAdmin())
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="icon">📊</i> Dashboard
      </a>
      <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <i class="icon">👥</i> Users
      </a>
      <a href="{{ route('admin.events') }}" class="nav-item {{ request()->routeIs('admin.events') ? 'active' : '' }}">
        <i class="icon">📅</i> Events
      </a>
      <a href="{{ route('admin.bookings') }}" class="nav-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
        <i class="icon">📋</i> Bookings
      </a>
    @elseif(auth()->user()->isOrganizer())
      <a href="{{ route('organizer.dashboard') }}" class="nav-item {{ request()->routeIs('organizer.dashboard') ? 'active' : '' }}">
        <i class="icon">📊</i> Dashboard
      </a>
      <a href="{{ route('events.index') }}" class="nav-item {{ request()->routeIs('events.*') ? 'active' : '' }}">
        <i class="icon">📅</i> Events
      </a>
      <a href="{{ route('organizer.bookings') }}" class="nav-item {{ request()->routeIs('organizer.bookings') ? 'active' : '' }}">
