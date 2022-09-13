<?php

namespace App\Models;

use App\Models\CouponEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_type', 'coupon_subtype', 'creator_email'];

    public function type()
    {
        return $this->hasOne(CouponType::class, 'id', 'coupon_type');
    }

    public function subtype()
    {
        return $this->hasOne(CouponSubtype::class, 'id', 'coupon_subtype');
    }

    public function emails()
    {
        return $this->belongsToMany(CouponEmail::class);
    }
}
