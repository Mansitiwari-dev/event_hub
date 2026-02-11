<!-- resources/views/partials/sidebars/customer.blade.php -->
<li class="{{ request()->routeIs('dashboard.customer') ? 'active' : '' }}">
    <a href="{{ route('dashboard.customer') }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="{{ request()->routeIs('dashboard.customer.bookings') ? 'active' : '' }}">
    <a href="{{ route('dashboard.customer.bookings') }}">
        <i class="bi bi-ticket-perforated"></i>
        <span>My Bookings</span>
    </a>
</li>
<li class="{{ request()->routeIs('dashboard.customer.wishlist') ? 'active' : '' }}">
    <a href="{{ route('dashboard.customer.wishlist') }}">
        <i class="bi bi-heart"></i>
        <span>Wishlist</span>
    </a>
</li>
<li>
    <a href="{{ route('dashboard.customer.messages') }}">
        <i class="bi bi-chat-dots"></i>
        <span>Messages</span>
        <span class="badge bg-danger rounded-pill ms-2">3</span>
    </a>
</li>
<li>
    <a href="#accountSettings" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-gear"></i>
        <span>Account Settings</span>
    </a>
    <ul class="collapse list-unstyled" id="accountSettings">
        <li><a href="#"><i class="bi bi-person"></i> Profile</a></li>
        <li><a href="#"><i class="bi bi-credit-card"></i> Payment Methods</a></li>
        <li><a href="#"><i class="bi bi-shield-lock"></i> Security</a></li>
    </ul>
</li>