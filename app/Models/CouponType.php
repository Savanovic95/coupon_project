<?php

namespace App\Models;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function coupons()
    {
        return $this->belongsTo(Coupon::class);
    }
}
