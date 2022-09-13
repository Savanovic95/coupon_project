<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Coupon;
use App\Models\CouponEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllCouponController extends Controller
{
    public function show_all()
    {

        $allCoupons = Coupon::all();

        $allCoupons = DB::table('coupons')
            ->join('coupon_types', 'coupon_types.id', '=', 'coupons.coupon_type')
            ->join('coupon_subtypes', 'coupon_subtypes.id', '=', 'coupons.coupon_subtype')
            ->select('coupon_types.type_name', 'coupon_subtypes.subtype_name',  'coupons.*')
            ->get();

        return view('coupons.all', compact('allCoupons'));
    }

    public function show_used()
    {
        $allCoupons = DB::table('coupon_emails')
            ->join('emails', 'emails.id', '=', 'coupon_emails.email_id')
            ->join('coupons', 'coupons.id', '=', 'coupon_emails.coupon_id')
            ->join('coupon_types', 'coupon_types.id', '=', 'coupons.coupon_type')
            ->join('coupon_subtypes', 'coupon_subtypes.id', '=', 'coupons.coupon_subtype')
            ->select('coupon_types.type_name', 'coupon_subtypes.subtype_name',  'coupons.*', 'emails.*', 'coupon_emails.*')
            ->get();


        //$usedCoupons = Coupon::all();

        return view('coupons.used', compact('allCoupons'));
    }

    public function show_active()
    {
        $allCoupons = DB::table('coupons')
            ->join('coupon_types', 'coupon_types.id', '=', 'coupons.coupon_type')
            ->join('coupon_subtypes', 'coupon_subtypes.id', '=', 'coupons.coupon_subtype')
            ->select('coupon_types.type_name', 'coupon_subtypes.subtype_name',  'coupons.*')
            ->where('coupons.status', '=', 'active')
            ->get();
        return view('coupons.active', compact('allCoupons'));
    }

    public function show_non_used()
    {

        $allCoupons = Coupon::with('type', 'subtype')
            ->where('used_times', '=', NULL)
            ->get();

        return view('coupons.non_used', compact('allCoupons'));
    }
}
