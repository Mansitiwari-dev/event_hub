<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Organizer dashboard with their event statistics
     */
    public function index()
    {
        $user = auth()->user();
        $now = now();
        $thirtyDaysAgo = now()->subDays(30);

        // Get total events count
        $totalEvents = Event::where('customer_id', $user->id)->count();
        
        // Get upcoming events (next 30 days)
        $upcomingEvents = Event::where('customer_id', $user->id)
            ->where('start_date', '>=', $now)
            ->where('start_date', '<=', $now->copy()->addDays(30))
            ->withCount('bookings')
            ->orderBy('start_date')
            ->paginate(5);

        // Get total attendees across all events
        $totalAttendees = Booking::whereHas('event', function($q) use ($user) {
                $q->where('customer_id', $user->id);
            })
            ->where('status', 'confirmed')
            ->count();

        // Calculate total revenue
        $totalRevenue = Booking::whereHas('event', function($q) use ($user) {
                $q->where('customer_id', $user->id);
            })
            ->where('status', 'confirmed')
            ->with('event')
            ->get()
            ->sum(function($booking) {
                return $booking->event ? $booking->event->price : 0;
            });

        // Get recent activities (last 10)
        $recentActivities = Activity::where('user_id', $user->id)
            ->with('subject')
            ->latest()
            ->take(10)
            ->get();

        // Get events data for the last 30 days for chart
        $eventsByDay = Event::where('customer_id', $user->id)
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Get bookings data for the last 30 days for chart
        $bookingsByDay = Booking::whereHas('event', function($q) use ($user, $thirtyDaysAgo) {
                $q->where('customer_id', $user->id);
            })
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Format data for the line chart
        $chartData = [];
        $currentDate = $thirtyDaysAgo->copy();
        
        while ($currentDate <= $now) {
            $dateStr = $currentDate->toDateString();
            $chartData['labels'][] = $currentDate->format('M j');
            $chartData['events'][] = $eventsByDay[$dateStr] ?? 0;
            $chartData['bookings'][] = $bookingsByDay[$dateStr] ?? 0;
            $currentDate->addDay();
        }

        return view('dashboards.organizer', [
            'totalEvents' => $totalEvents,
            'upcomingEvents' => $upcomingEvents,
            'totalAttendees' => $totalAttendees,
            'totalRevenue' => $totalRevenue,
            'recentActivities' => $recentActivities,
            'chartData' => $chartData
        ]);
    }

    /**
     * Show bookings for organizer's events
     */
    public function bookings()
    {
        $user = auth()->user();
        
        $bookings = Booking::whereHas('event', fn($q) => $q->where('customer_id', $user->id))
            ->with('event', 'user')
            ->latest()
            ->paginate(15);

        return view('bookings.index', compact('bookings'));
    }
}