<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_profile_id', 'path', 'caption'];

    public function vendorProfile()
    {
        return $this->belongsTo(VendorProfile::class);
    }
}
