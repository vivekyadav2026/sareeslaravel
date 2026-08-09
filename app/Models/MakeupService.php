<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakeupService extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_minutes',
        'is_active',
    ];

    public function bookings()
    {
        return $this->hasMany(MakeupBooking::class);
    }
}
