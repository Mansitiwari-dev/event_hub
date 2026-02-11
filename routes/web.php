<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');
Route::view('/contact', 'contact')->name('contact');

// Vendor Routes
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::get('/vendors/{vendor}', [VendorController::class, 'show'])->name('vendors.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');

// Password reset
Route::get('/password/reset', function() {
    return 'Password reset page coming soon.';
})->name('password.request');

/*
|--------------------------------------------------------------------------
| Image API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('api/images')->group(function () {
    Route::get('/search', [ImageController::class, 'search'])->name('images.search');
    Route::get('/random', [ImageController::class, 'random'])->name('images.random');
});

/*
|--------------------------------------------------------------------------
| Protected Dashboards (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard redirect
    Route::redirect('/dashboard', '/customer/dashboard')->name('dashboard');
    
    // Events routes - Modal-based editing only (no show/edit pages)
    Route::resource('events', \App\Http\Controllers\EventController::class)->only(['index', 'create', 'store', 'update', 'destroy']);
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Admin Dashboard
    Route::prefix('admin')->group(function () {
        Route::view('/dashboard', 'dashboards.admin')->name('dashboard.admin');
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');
    });

    // Event Manager Dashboard
    Route::prefix('event-manager')->group(function () {
        Route::view('/dashboard', 'dashboards.event_manager')->name('dashboard.event_manager');
        Route::get('/contracts', function () { return view('event_manager.contracts'); })->name('event_manager.contracts');
        Route::post('/contracts', function (\Illuminate\Http\Request $request) {
            // Store contract logic here
            $contract = \App\Models\EventVendorContract::create([
                'event_id' => $request->event_id,
                'vendor_id' => $request->vendor_id,
                'specialization_id' => $request->specialization_id,
                'event_manager_id' => auth()->id(),
                'agreed_rate' => $request->agreed_rate,
                'status' => 'pending',
            ]);
            return redirect()->back()->with('success', 'Vendor hired successfully!');
        })->name('event_manager.contracts.store');
        Route::get('/vendors', function () { return view('event_manager.vendors'); })->name('event_manager.vendors');
        Route::get('/vendors/{id}', function ($id) {
            $vendor = \App\Models\VendorProfile::find($id);
            return view('event_manager.vendor_details', compact('vendor'));
        })->name('event_manager.vendor.details');
    });

    // Manager Dashboard (Event Manager / Organizer) - Role-based routes
    Route::prefix('manager')->group(function () {
        Route::view('/dashboard', 'dashboards.event_manager')->name('dashboard.manager');
        Route::get('/attendees', function () { return view('manager.attendees'); })->name('manager.attendees.index');
        Route::get('/tickets', function () { return view('manager.tickets'); })->name('manager.tickets.index');
        Route::get('/payments', function () { return view('manager.payments'); })->name('manager.payments.index');
        Route::get('/reports', function () { return view('manager.reports'); })->name('manager.reports.index');
        Route::get('/calendar', function () { return view('manager.calendar'); })->name('manager.calendar.index');
        Route::get('/settings', function () { return view('manager.settings'); })->name('manager.settings.index');
    });

    // Venue Manager Dashboard
    Route::prefix('venue-manager')->group(function () {
        Route::view('/dashboard', 'dashboards.venue_manager')->name('dashboard.venue_manager');
        Route::get('/venues', function () { return view('venue_manager.venues'); })->name('venue_manager.venues');
        Route::get('/bookings', function () { return view('venue_manager.bookings'); })->name('venue_manager.bookings');
    });

    // Vendor Dashboard
    Route::prefix('vendor')->group(function () {
        Route::view('/dashboard', 'dashboards.vendor')->name('dashboard.vendor');
        Route::get('/contracts', function () { return view('vendor.contracts'); })->name('vendor.contracts');
        Route::get('/profile', function () { return view('vendor.profile'); })->name('vendor.profile');
    });

    // Customer Routes
    Route::prefix('customer')->group(function () {
        Route::view('/dashboard', 'dashboards.customer')->name('dashboard.customer');
        Route::get('/bookings', function () { return view('customer.bookings'); })->name('dashboard.customer.bookings');
        Route::get('/events', function () { return view('customer.events'); })->name('dashboard.customer.events');
        Route::get('/wishlist', function () { return view('customer.wishlist'); })->name('dashboard.customer.wishlist');
        Route::get('/messages', function () { return view('customer.messages'); })->name('dashboard.customer.messages');
        Route::get('/settings', function () { return view('customer.settings'); })->name('dashboard.customer.settings');
    });
});


// Forgot Password Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

/*
|--------------------------------------------------------------------------
| Events Routes
|--------------------------------------------------------------------------
*/

// Auth required
Route::middleware(['auth'])->group(function () {

    // -----------------------
    // NORMAL EVENTS ROUTES - using resource definition above
    // -----------------------
    // (removed - use Route::resource at line ~64 instead)

    // -----------------------
    // ORGANIZER EVENTS ROUTES
    // -----------------------
    Route::prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
        Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    });
});
