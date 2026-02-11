<!-- resources/views/partials/sidebars/manager.blade.php -->
<li class="{{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
    <a href="{{ route('manager.dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
    </a>
</li>
<li>
    <a href="#eventsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-calendar-event"></i>
        <span>My Events</span>
    </a>
    <ul class="collapse list-unstyled" id="eventsSubmenu">
        <li><a href="#"><i class="bi bi-plus-circle"></i> Create Event</a></li>
        <li><a href="#"><i class="bi bi-list-ul"></i> All Events</a></li>
        <li><a href="#"><i class="bi bi-calendar-check"></i> Upcoming</a></li>
    </ul>
</li>
<li>
    <a href="#bookingsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-ticket-perforated"></i>
        <span>Bookings</span>
    </a>
    <ul class="collapse list-unstyled" id="bookingsSubmenu">
        <li><a href="#"><i class="bi bi-list-ul"></i> All Bookings</a></li>
        <li><a href="#"><i class="bi bi-check-circle"></i> Confirmed</a></li>
        <li><a href="#"><i class="bi bi-hourglass-split"></i> Pending</a></li>
    </ul>
</li>
<li>
    <a href="#reportsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-graph-up"></i>
        <span>Reports</span>
    </a>
    <ul class="collapse list-unstyled" id="reportsSubmenu">
        <li><a href="#"><i class="bi bi-currency-dollar"></i> Sales</a></li>
        <li><a href="#"><i class="bi bi-people"></i> Attendance</a></li>
    </ul>
</li>