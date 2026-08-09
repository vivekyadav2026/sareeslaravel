<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_id',
        'billing_address_id',
        'shipping_address_id',
        'status',
        'payment_status',
        'payment_method',
        'subtotal',
        'discount',
        'shipping_charge',
        'tax',
        'total',
        'coupon_code',
        'tracking_number',
        'courier_name',
        'shipping_status',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderNotes()
    {
        return $this->hasMany(OrderNote::class)->orderBy('created_at', 'desc');
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class)->orderBy('created_at', 'desc');
    }
}
