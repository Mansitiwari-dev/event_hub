<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VendorProfile;

class VendorProfilePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, VendorProfile $vendor): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isServiceProvider();
    }

    public function update(User $user, VendorProfile $vendor): bool
    {
        return $user->id === $vendor->user_id;
    }

    public function delete(User $user, VendorProfile $vendor): bool
    {
        return $user->id === $vendor->user_id;
    }
}
