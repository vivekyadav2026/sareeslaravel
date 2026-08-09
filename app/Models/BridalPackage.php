<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BridalPackage extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'features',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
