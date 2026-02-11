<!-- resources/views/partials/sidebars/vendor.blade.php -->
<li class="{{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
    <a href="{{ route('vendor.dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
    </a>
</li>
<li>
    <a href="#vendorServices" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-box-seam"></i>
        <span>My Services</span>
    </a>
    <ul class="collapse list-unstyled" id="vendorServices">
        <li><a href="#"><i class="bi bi-plus-circle"></i> Add Service</a></li>
        <li><a href="#"><i class="bi bi-list-ul"></i> All Services</a></li>
    </ul>
</li>
<li>
    <a href="#vendorBookings" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-calendar-check"></i>
        <span>Bookings</span>
    </a>
    <ul class="collapse list-unstyled" id="vendorBookings">
        <li><a href="#"><i class="bi bi-list-ul"></i> All Bookings</a></li>
        <li><a href="#"><i class="bi bi-check-circle"></i> Confirmed</a></li>
        <li><a href="#"><i class="bi bi-hourglass-split"></i> Pending</a></li>
    </ul>
</li>
<li>
    <a href="#vendorEarnings" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-cash-stack"></i>
        <span>Earnings</span>
    </a>
    <ul class="collapse list-unstyled" id="vendorEarnings">
        <li><a href="#"><i class="bi bi-graph-up"></i> Overview</a></li>
        <li><a href="#"><i class="bi bi-wallet2"></i> Payouts</a></li>
    </ul>
</li>