<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'event_id',
        'booking_date',
        'check_in_time',
        'check_out_time',
        'booking_amount',
        'status',
        'special_requirements',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_amount' => 'decimal:2',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeForVenue($query, $venueId)
    {
        return $query->where('venue_id', $venueId);
    }

    public function scopeOnDate($query, $date)
    {
        return $query->where('booking_date', $date);
    }
}
