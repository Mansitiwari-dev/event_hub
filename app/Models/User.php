<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role_id', // Keep this for backward compatibility
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // New: Many-to-many relationship with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'event_manager_id');
    }

    public function customerEvents()
    {
        return $this->hasMany(Event::class, 'customer_id');
    }

    public function vendorContracts()
    {
        return $this->hasMany(EventVendorContract::class, 'vendor_id');
    }

    public function managedContracts()
    {
        return $this->hasMany(EventVendorContract::class, 'event_manager_id');
    }

    public function managedVenues()
    {
        return $this->hasMany(Venue::class, 'venue_manager_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function bookingsAsProvider()
    {
        return $this->hasMany(Booking::class, 'provider_id');
    }

    public function vendorProfile()
    {
        return $this->hasOne(VendorProfile::class);
    }

    // Role Helpers
    public function hasRole($role)
    {
        // First check the many-to-many relationship
        if ($this->roles->contains('name', $role)) {
            return true;
        }
        
        // Fallback to the old role_id relationship for backward compatibility
        if ($this->role && strcasecmp($this->role->name, $role) === 0) {
            return true;
        }
        
        return false;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return $this->roles()->whereIn('name', $roles)->exists() || 
                   ($this->role && in_array(strtolower($this->role->name), array_map('strtolower', $roles)));
        }
        return $this->hasRole($roles);
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }
        $this->roles()->syncWithoutDetaching($role);
        
        // For backward compatibility, also set the role_id
        $this->role_id = $role->id;
        $this->save();
    }

    // Keep the old role checkers for backward compatibility
    public function isCustomer()
    {
        return $this->hasRole('customer');
    }

    public function isVendor()
    {
        return $this->hasRole('vendor');
    }

    public function isEventManager()
    {
        return $this->hasRole('event_manager');
    }

    public function isVenueManager()
    {
        return $this->hasRole('venue_manager');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
}