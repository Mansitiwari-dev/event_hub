<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Service::query();

        if (auth()->user()->isServiceProvider()) {
            $query->where('provider_id', auth()->id());
        }

        $services = $query->with('provider')->paginate(10);

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Service::class);
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $service = Service::create(array_merge(
            $request->validated(),
            ['provider_id' => auth()->id(), 'is_available' => true]
        ));

        return redirect()->route('services.show', $service)
            ->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $this->authorize('view', $service);
        $bookings = $service->bookings()->with('customer', 'event')->paginate(10);

        return view('services.show', compact('service', 'bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $this->authorize('update', $service);
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('services.show', $service)
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully!');
    }

    /**
     * Search and filter services
     */
    public function search(Request $request)
    {
        $query = Service::query();

        if (auth()->user()->isServiceProvider()) {
            $query->where('provider_id', auth()->id());
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('available')) {
            $query->where('is_available', true);
        }

        $services = $query->with('provider')->paginate(10);

        return view('services.index', compact('services'));
    }
}
