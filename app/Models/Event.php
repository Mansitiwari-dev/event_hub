<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'event_manager_id', 'title', 'description', 'event_type', 'start_date', 'end_date', 'location', 'guest_count', 'budget', 'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'budget' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function eventManager()
    {
        return $this->belongsTo(User::class, 'event_manager_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function vendorContracts()
    {
        return $this->hasMany(EventVendorContract::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(User::class, 'event_vendor_contracts', 'event_id', 'vendor_id');
    }

    public function venueBookings()
    {
        return $this->hasMany(VenueBooking::class);
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class, 'venue_bookings');
    }

    public function scopeForCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeForEventManager($query, $managerId)
    {
        return $query->where('event_manager_id', $managerId);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }
}

