<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSpecialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    public function vendors()
    {
        return $this->belongsToMany(VendorProfile::class, 'vendor_profile_specializations');
    }

    public function contracts()
    {
        return $this->hasMany(EventVendorContract::class);
    }
}
