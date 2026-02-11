<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\VenueBooking;
use Illuminate\Http\Request;

class VenueManagerController extends Controller
{
    /**
     * Display venue manager dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();
        $totalVenues = Venue::byManager($user->id)->count();
        $totalBookings = VenueBooking::whereHas('venue', function ($q) use ($user) {
            $q->where('venue_manager_id', $user->id);
        })->count();
        $pendingBookings = VenueBooking::whereHas('venue', function ($q) use ($user) {
            $q->where('venue_manager_id', $user->id);
        })->where('status', 'pending')->count();

        return view('dashboards.venue_manager', compact('totalVenues', 'totalBookings', 'pendingBookings'));
    }

    /**
     * Display all venues for the manager
     */
    public function venues()
    {
        $user = auth()->user();
        $venues = Venue::byManager($user->id)
            ->with('bookings')
            ->latest()
            ->paginate(12);

        return view('venue_manager.venues', compact('venues'));
    }

    /**
     * Create new venue
     */
    public function createVenue()
    {
        return view('venue_manager.create_venue');
    }

    /**
     * Store new venue
     */
    public function storeVenue(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'capacity' => 'nullable|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'amenities' => 'nullable|string',
        ]);

        $validated['venue_manager_id'] = auth()->id();
        if ($request->filled('amenities')) {
            $validated['amenities'] = json_encode(explode(',', $validated['amenities']));
        }

        Venue::create($validated);

        return redirect()->route('venue_manager.venues')->with('success', 'Venue created successfully.');
    }

    /**
     * Display bookings for all venues
     */
    public function bookings(Request $request)
    {
        $user = auth()->user();
        $query = VenueBooking::whereHas('venue', function ($q) use ($user) {
            $q->where('venue_manager_id', $user->id);
        })->with(['venue', 'event']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->where('booking_date', $request->date);
        }

        $bookings = $query->latest()->paginate(15);

        return view('venue_manager.bookings', compact('bookings'));
    }

    /**
     * Update booking status
     */
    public function updateBookingStatus(VenueBooking $booking, Request $request)
    {
        // Check authorization
        if ($booking->venue->venue_manager_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Booking status updated.');
    }
}
