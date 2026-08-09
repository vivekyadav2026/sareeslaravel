<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomDesignRequest extends Model
{
    protected $fillable = [
        'customer_id',
        'fabric_preference',
        'budget_range',
        'design_details',
        'image_path',
        'status',
        'estimated_price',
        'estimated_delivery_date',
        'admin_notes',
    ];

    protected $casts = [
        'estimated_delivery_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
