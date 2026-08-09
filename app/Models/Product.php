<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'summary',
        'material',
        'occasion',
        'category_id',
        'brand_id',
        'sku',
        'barcode',
        'price',
        'sale_price',
        'cost_price',
        'rating',
        'reviews_count',
        'is_active',
        'is_approved',
        'is_featured',
        'is_trending',
        'is_new_arrival',
        'is_best_seller',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'related_products',
        'upsell_products',
        'cross_sell_products',
        'gst_rate',
    ];

    protected $casts = [
        'related_products' => 'array',
        'upsell_products' => 'array',
        'cross_sell_products' => 'array',
        'is_active' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order', 'asc');
    }

    public function questions()
    {
        return $this->hasMany(ProductQuestion::class)->orderBy('created_at', 'desc');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
