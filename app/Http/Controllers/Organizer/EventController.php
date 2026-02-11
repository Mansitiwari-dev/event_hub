<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index()
    {
        $events = auth()->user()->events()
            ->withCount('bookings')
            ->latest()
            ->paginate(10);
            
        return view('organizer.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('organizer.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_online' => 'boolean',
            'online_link' => 'nullable|required_if:is_online,true|url',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('event-images', 'public');
            $validated['image_path'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $validated['organizer_id'] = auth()->id();
        $validated['is_published'] = $request->has('is_published');

        $event = Event::create($validated);

        return redirect()->route('organizer.events.show', $event)
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        $this->authorize('view', $event);
        
        $event->load('bookings');
        
        return view('organizer.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        
        return view('organizer.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_online' => 'boolean',
            'online_link' => 'nullable|required_if:is_online,true|url',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $path = $request->file('image')->store('event-images', 'public');
            $validated['image_path'] = $path;
        }

        $validated['is_published'] = $request->has('is_published');
        
        $event->update($validated);

        return redirect()->route('organizer.events.show', $event)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        
        // Delete associated image if exists
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        
        $event->delete();
        
        return redirect()->route('organizer.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}
