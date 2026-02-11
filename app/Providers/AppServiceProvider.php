<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Event;
use App\Models\Service;
use App\Models\Booking;
use App\Models\VendorProfile;
use App\Models\Review;
use App\Policies\EventPolicy;
use App\Policies\ServicePolicy;
use App\Policies\BookingPolicy;
use App\Policies\VendorProfilePolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Event::class, EventPolicy::class);
        Gate::policy(Service::class, ServicePolicy::class);
        Gate::policy(Booking::class, BookingPolicy::class);
        Gate::policy(VendorProfile::class, VendorProfilePolicy::class);
        Gate::policy(Review::class, ReviewPolicy::class);
    }
}
