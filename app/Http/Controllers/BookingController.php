<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Service;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $query = Booking::query();

        if ($user->hasRole('customer')) {
            $query->where('customer_id', $user->id);
        } elseif ($user->isServiceProvider()) {
            $query->where('provider_id', $user->id);
        }

        $bookings = $query->with('event', 'service', 'customer', 'provider')->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        $this->authorize('create', Booking::class);
        $services = Service::where('is_available', true)->get();

        return view('bookings.create', compact('event', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $service = Service::findOrFail($request->service_id);
        $event = Event::findOrFail($request->event_id);

        if (!$service->isBookingAvailable()) {
            return back()->with('error', 'This service is no longer available for booking.');
        }

        $booking = Booking::create(array_merge(
            $request->validated(),
            [
                'customer_id' => auth()->id(),
                'provider_id' => $service->provider_id,
                'amount' => $service->price,
                'status' => 'pending',
            ]
        ));

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking request sent to service provider!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Confirm booking (for service provider)
     */
    public function confirm(Booking $booking)
    {
        if ($booking->provider_id !== auth()->id() || $booking->status !== 'pending') {
            return back()->with('error', 'Cannot confirm this booking.');
        }

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking confirmed successfully!');
    }

    /**
     * Reject booking (for service provider)
     */
    public function reject(Booking $booking)
    {
        if ($booking->provider_id !== auth()->id() || $booking->status !== 'pending') {
            return back()->with('error', 'Cannot reject this booking.');
        }

        $booking->update(['status' => 'rejected']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking rejected.');
    }

    /**
     * Cancel booking (for customer)
     */
    public function cancel(Booking $booking)
    {
        if ($booking->customer_id !== auth()->id() || in_array($booking->status, ['confirmed', 'completed', 'cancelled'])) {
            return back()->with('error', 'Cannot cancel this booking.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled.');
    }

    /**
     * Complete booking (for service provider)
     */
    public function complete(Booking $booking)
    {
        if ($booking->provider_id !== auth()->id() || $booking->status !== 'confirmed') {
            return back()->with('error', 'Cannot complete this booking.');
        }

        $booking->update(['status' => 'completed']);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking marked as completed!');
    }

    /**
     * Search bookings
     */
    public function search(Request $request)
    {
        $user = auth()->user();
        $query = Booking::query();

        if ($user->hasRole('customer')) {
            $query->where('customer_id', $user->id);
        } elseif ($user->isServiceProvider()) {
            $query->where('provider_id', $user->id);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('event', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->orWhereHas('service', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $bookings = $query->with('event', 'service', 'customer', 'provider')->paginate(10);

        return view('bookings.index', compact('bookings'));
    }
}
