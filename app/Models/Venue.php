<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_manager_id',
        'name',
        'description',
        'address',
        'city',
        'state',
        'postal_code',
        'latitude',
        'longitude',
        'capacity',
        'base_price',
        'amenities',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
        'amenities' => 'json',
    ];

    public function venueManager()
    {
        return $this->belongsTo(User::class, 'venue_manager_id');
    }

    public function bookings()
    {
        return $this->hasMany(VenueBooking::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'venue_bookings');
    }

    // Check if venue is available on a specific date
    public function isAvailableOnDate($date)
    {
        return !$this->bookings()
            ->where('booking_date', $date)
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByManager($query, $managerId)
    {
        return $query->where('venue_manager_id', $managerId);
    }
}
