<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereHas('role', function ($q) {
            $q->where('name', 'like', '%Vendor%');
        });

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }

        $vendors = $query->paginate(12);

        return view('vendors.index', compact('vendors'));
    }

    public function show(User $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }
}
