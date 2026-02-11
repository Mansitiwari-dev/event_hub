<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'name', 'total_cost'];

    protected $casts = ['total_cost' => 'decimal:2'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(User::class, 'team_vendor', 'team_id', 'vendor_id');
    }
}
