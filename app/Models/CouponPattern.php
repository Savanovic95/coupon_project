<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\CouponType;
use App\Models\CouponSubtype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponPattern extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function type()
    {
        return $this->belongsTo(CouponType::class);
    }

    public function subtype()
    {
        return $this->belongsTo(CouponSubtype::class);
    }
}
