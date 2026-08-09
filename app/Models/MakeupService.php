<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakeupService extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'price',
        'duration_minutes',
        'is_active',
        'is_popular',
    ];

    public function bookings()
    {
        return $this->hasMany(MakeupBooking::class);
    }
}
