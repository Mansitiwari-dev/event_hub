<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
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
    /**
     * Determine if the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('customer') || $user->hasRole('event_manager');
    }

    /**
     * Determine if the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        // Allow if user is admin, the creator (customer), or the event manager
        return $user->hasRole('admin') || $user->id === $event->customer_id || $user->id === $event->event_manager_id;
    }

    /**
     * Determine if the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        // Allow if user is admin, the creator (customer), or the event manager
        return $user->hasRole('admin') || $user->id === $event->customer_id || $user->id === $event->event_manager_id;
    }

    /**
     * Determine if the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return $user->id === $event->customer_id;
    }

    /**
     * Determine if the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return $user->id === $event->customer_id;
    }
}
