<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'customer_id',
        'title',
        'bust',
        'waist',
        'hips',
        'shoulder',
        'chest',
        'sleeve_length',
        'lehenga_length',
        'blouse_length',
        'front_neck_depth',
        'back_neck_depth',
        'armhole',
        'wrist',
        'ankle_length',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
