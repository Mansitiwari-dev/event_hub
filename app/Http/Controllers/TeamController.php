<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\VendorProfile;
use App\Http\Requests\StoreTeamRequest;

class TeamController extends Controller
{
    public function create(Event $event)
    {
        $this->authorize('update', $event);
        $vendors = VendorProfile::with('user')->get();
        return view('teams.create', compact('event', 'vendors'));
    }

    public function store(StoreTeamRequest $request, Event $event)
    {
        $this->authorize('update', $event);
        $validated = $request->validated();

        $team = $event->teams()->create($validated);

        if ($request->has('vendor_ids')) {
            $team->vendors()->sync($request->vendor_ids);
        }

        return redirect()->route('events.show', $event)->with('success', 'Team created!');
    }

    public function edit(Team $team)
    {
        $this->authorize('update', $team->event);
        $vendors = VendorProfile::with('user')->get();
        return view('teams.edit', compact('team', 'vendors'));
    }

    public function update(StoreTeamRequest $request, Team $team)
    {
        $this->authorize('update', $team->event);
        $team->update($request->validated());

        if ($request->has('vendor_ids')) {
            $team->vendors()->sync($request->vendor_ids);
        }

        return redirect()->route('events.show', $team->event)->with('success', 'Team updated!');
    }

    public function destroy(Team $team)
    {
        $this->authorize('delete', $team->event);
        $team->delete();
        return back()->with('success', 'Team deleted!');
    }
}
