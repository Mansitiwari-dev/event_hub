<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\VendorProfile;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, VendorProfile $vendor)
    {
        $validated = $request->validated();
        $validated['customer_id'] = Auth::id();
        $validated['vendor_id'] = $vendor->id;

        Review::updateOrCreate(
            ['vendor_id' => $vendor->id, 'customer_id' => Auth::id()],
            $validated
        );

        $vendor->updateRating();

        return back()->with('success', 'Review submitted!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();
        $review->vendor->updateRating();
        return back()->with('success', 'Review deleted!');
    }
}
