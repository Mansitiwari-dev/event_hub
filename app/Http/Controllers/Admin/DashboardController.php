<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;

class DashboardController extends Controller
{
    /**
     * Admin dashboard with system-wide statistics
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
        ];

        $recent_users = User::latest()->take(5)->get();
        $recent_events = Event::latest()->take(5)->get();
        $recent_bookings = Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_events', 'recent_bookings'));
    }

    /**
     * List all users (admin only)
     */
    public function users()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * List all events (admin view)
     */
    public function events()
    {
        $events = Event::with('customer', 'bookings')->paginate(10);
        return view('admin.events', compact('events'));
    }

    /**
     * List all bookings (admin view)
     */
    public function bookings()
    {
        $bookings = Booking::with('user', 'event')->paginate(10);
        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Delete a user (admin only)
     */
    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }

    /**
     * Delete an event (admin only)
     */
    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Event deleted.');
    }
}
