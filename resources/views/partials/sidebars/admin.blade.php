<!-- resources/views/partials/sidebars/admin.blade.php -->
<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
    </a>
</li>
<li>
    <a href="#usersSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-people"></i>
        <span>Users</span>
    </a>
    <ul class="collapse list-unstyled" id="usersSubmenu">
        <li><a href="#"><i class="bi bi-person-plus"></i> Add New User</a></li>
        <li><a href="#"><i class="bi bi-list-ul"></i> All Users</a></li>
    </ul>
</li>
<li>
    <a href="#eventsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-calendar-event"></i>
        <span>Events</span>
    </a>
    <ul class="collapse list-unstyled" id="eventsSubmenu">
        <li><a href="#"><i class="bi bi-plus-circle"></i> Create Event</a></li>
        <li><a href="#"><i class="bi bi-list-ul"></i> All Events</a></li>
    </ul>
</li>
<li>
    <a href="#vendorsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-shop"></i>
        <span>Vendors</span>
    </a>
    <ul class="collapse list-unstyled" id="vendorsSubmenu">
        <li><a href="#"><i class="bi bi-person-plus"></i> Add Vendor</a></li>
        <li><a href="#"><i class="bi bi-list-ul"></i> All Vendors</a></li>
    </ul>
</li>
<li>
    <a href="#settingsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-gear"></i>
        <span>Settings</span>
    </a>
    <ul class="collapse list-unstyled" id="settingsSubmenu">
        <li><a href="#"><i class="bi bi-sliders"></i> General</a></li>
        <li><a href="#"><i class="bi bi-credit-card"></i> Payments</a></li>
        <li><a href="#"><i class="bi bi-bell"></i> Notifications</a></li>
    </ul>
</li>