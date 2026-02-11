<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\VendorProfile;
use App\Models\VendorSpecialization;
use App\Models\EventVendorContract;
use Illuminate\Http\Request;

class EventManagerController extends Controller
{
    /**
     * Display event manager dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();
        $totalEvents = Event::forEventManager($user->id)->count();
        $pendingContracts = EventVendorContract::forEventManager($user->id)->pending()->count();
        $acceptedContracts = EventVendorContract::forEventManager($user->id)->accepted()->count();

        return view('dashboards.event_manager', compact('totalEvents', 'pendingContracts', 'acceptedContracts'));
    }

    /**
     * Display all contracts for the event manager
     */
    public function contracts()
    {
        $user = auth()->user();
        $contracts = EventVendorContract::forEventManager($user->id)
            ->with(['event', 'vendor', 'specialization'])
            ->latest()
            ->paginate(15);

        return view('event_manager.contracts', compact('contracts'));
    }

    /**
     * Show vendor search page
     */
    public function vendors(Request $request)
    {
        $specializations = VendorSpecialization::all();
        $selectedSpecialization = $request->get('specialization_id');
        
        $query = VendorProfile::query()
            ->with('specializations')
            ->where('user_id', '!=', auth()->id());

        if ($selectedSpecialization) {
            $query->bySpecialization($selectedSpecialization);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('company_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('rating')) {
            $query->withHighRating($request->rating);
        }

        $vendors = $query->paginate(12);

        return view('event_manager.vendors', compact('vendors', 'specializations', 'selectedSpecialization'));
    }

    /**
     * Show vendor details and contract creation form
     */
    public function vendorDetails($vendorId)
    {
        $vendor = VendorProfile::with('specializations')->findOrFail($vendorId);
        $events = Event::forEventManager(auth()->id())->get();
        $specializations = $vendor->specializations;

        return view('event_manager.vendor_details', compact('vendor', 'events', 'specializations'));
    }
}
