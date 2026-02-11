<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;

class ReviewPolicy
{
    public function create(User $user): bool
    {
        return $user->isCustomer();
    }

    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->customer_id;
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->customer_id || $user->isAdmin();
    }
}
