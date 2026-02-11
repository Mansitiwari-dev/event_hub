<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    /**
     * Role constants
     */
    public const ADMIN         = 'admin';
    public const CUSTOMER      = 'customer';
    public const EVENT_MANAGER = 'event_manager';
    public const VENDOR        = 'vendor';
    public const VENUE_MANAGER = 'venue_manager';

    /**
     * Mass assignable attributes
     */
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Enable timestamps
     */
    public $timestamps = true;

    /**
     * Many-to-Many relationship with User model
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all role names as an array
     */
    public static function getRoleNames()
    {
        return [
            self::ADMIN,
            self::CUSTOMER,
            self::EVENT_MANAGER,
            self::VENDOR,
            self::VENUE_MANAGER
        ];
    }
}