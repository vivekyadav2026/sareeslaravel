<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakeupBooking extends Model
{
    protected $fillable = [
        'customer_id',
        'makeup_service_id',
        'artist_name',
        'booking_date',
        'status',
        'total_price',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(MakeupService::class, 'makeup_service_id');
    }
}
