<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    /**
     * Determine if the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->customer_id || $user->id === $booking->provider_id;
    }

    /**
     * Determine if the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('customer');
    }

    /**
     * Determine if the user can update the model.
     */
    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->provider_id && $booking->status === 'pending';
    }

    /**
     * Determine if the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {
        return $user->id === $booking->customer_id && $booking->status === 'pending';
    }

    /**
     * Determine if the user can restore the model.
     */
    public function restore(User $user, Booking $booking): bool
    {
        return false;
    }

    /**
     * Determine if the user can permanently delete the model.
     */
    public function forceDelete(User $user, Booking $booking): bool
    {
        return false;
    }
}
