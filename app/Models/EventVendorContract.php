<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVendorContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'vendor_id',
        'event_manager_id',
        'vendor_specialization_id',
        'contract_details',
        'contract_amount',
        'status',
        'service_date',
        'service_start_time',
        'service_end_time',
        'notes',
    ];

    protected $casts = [
        'service_date' => 'date',
        'contract_amount' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function eventManager()
    {
        return $this->belongsTo(User::class, 'event_manager_id');
    }

    public function specialization()
    {
        return $this->belongsTo(VendorSpecialization::class, 'vendor_specialization_id');
    }

    // Scopes for common queries
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeForVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    public function scopeForEventManager($query, $managerId)
    {
        return $query->where('event_manager_id', $managerId);
    }

    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }
}
