<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_value',
        'start_date',
        'end_date',
        'limit',
        'used_count',
        'is_active',
    ];
}
