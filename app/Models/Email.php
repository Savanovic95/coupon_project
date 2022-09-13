<?php

namespace App\Models;

use App\Models\CouponEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;

class Email extends Model
{
    use HasFactory;
    protected $guarded = array('updated_at');
    public function coupons()
    {
        return $this->belongsToMany(CouponEmail::class);
    }
}
