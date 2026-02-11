<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Event;
use App\Models\Booking;
use App\Models\VendorProfile;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_events' => Event::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_users' => User::count(),
        ];

        // Get recent data
        $recent_events = Event::latest()->take(5)->get();
        $recent_bookings = Booking::with(['event', 'user'])->latest()->take(5)->get();
        $recent_users = User::with('role')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_events', 'recent_bookings', 'recent_users'));
    }
}