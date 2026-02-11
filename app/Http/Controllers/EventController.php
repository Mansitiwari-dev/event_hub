<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of events
     */
    public function index()
    {
        $user = auth()->user();
        $query = Event::query();

        // Role-based visibility
        if ($user) {
            // Get user role name (either from role_id or many-to-many)
            $userRole = null;
            if ($user->role) {
                $userRole = $user->role->name;
            } elseif ($user->roles()->exists()) {
                $userRole = $user->roles->first()->name;
            }

            // Show events based on role
            if ($userRole === 'admin') {
                // Admin sees all events
            } else {
                // All other roles see events they created (customer_id) or manage (event_manager_id)
                $query->where(function($q) use ($user) {
                    $q->where('customer_id', $user->id)
                      ->orWhere('event_manager_id', $user->id);
                });
            }
        }

        $events = $query
            ->with(['customer', 'bookings'])
            ->latest()
            ->paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
        $this->authorize('create', Event::class);

        return view('events.create');
    }

    /**
     * Store a newly created event
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create(array_merge($request->validated(), [
            'status' => 'pending',
            'customer_id' => auth()->id(),
        ]));

        return redirect()
            ->route('dashboard.event_manager')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event
     */
    public function show(Event $event)
{
    // $this->authorize('view', $event); // comment ya remove kar do

    $bookings = $event->bookings()
        ->with(['service', 'provider'])
        ->paginate(10);

    return view('events.show', compact('event', 'bookings'));
}


    /**
     * Show the form for editing the event
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $event->update($request->validated());

        return redirect()
            ->route('dashboard.event_manager')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()
            ->route('dashboard.event_manager')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Search & filter events
     */
    public function search(Request $request)
    {
        $query = Event::query();
        $user = auth()->user();

        if ($user && method_exists($user, 'hasRole') && $user->hasRole('customer')) {
            $query->where('customer_id', $user->id);
        }

        if ($user && method_exists($user, 'hasRole') && $user->hasRole('event_manager')) {
            $query->where('event_manager_id', $user->id);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('event_type', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('event_type', $request->type);
        }

        $events = $query
            ->with(['eventManager', 'bookings'])
            ->paginate(10);

        return view('events.index', compact('events'));
    }
}
