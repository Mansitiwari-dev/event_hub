<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'phone', 'address', 'website', 'company_name', 'description', 'experience', 'service_amount', 'availability', 'rating', 'review_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(VendorSpecialization::class, 'vendor_profile_specializations');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }

    public function portfolioImages()
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'vendor_id');
    }

    public function contracts()
    {
        return $this->hasManyThrough(EventVendorContract::class, User::class, 'id', 'vendor_id', 'user_id', 'id');
    }

    // Get specialization names
    public function getSpecializationNamesAttribute()
    {
        return $this->specializations()->pluck('name')->toArray();
    }

    // Check if vendor has a specific specialization
    public function hasSpecialization($specializationName)
    {
        return $this->specializations()
            ->where('name', $specializationName)
            ->exists();
    }

    public function scopeBySpecialization($query, $specializationId)
    {
        return $query->whereHas('specializations', function ($q) use ($specializationId) {
            $q->where('vendor_specializations.id', $specializationId);
        });
    }

    public function scopeWithHighRating($query, $minRating = 4)
    {
        return $query->where('rating', '>=', $minRating);
    }
}

