<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'wallet_balance',
        'reward_points',
        'referral_code',
        'referred_by',
        'status',
        'notes',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
