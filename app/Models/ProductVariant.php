<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'sale_price',
        'stock',
        'color',
        'size',
        'fabric',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
