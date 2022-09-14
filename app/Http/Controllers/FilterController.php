<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filters(Request $request)
    {


        if ($request->view == 'coupons.all') {


            $allCoupons = DB::table('coupons')
                ->join('coupon_types', 'coupon_types.id', '=', 'coupons.coupon_type')
                ->join('coupon_subtypes', 'coupon_subtypes.id', '=', 'coupons.coupon_subtype')
                ->select('coupon_types.type_name', 'coupon_subtypes.subtype_name',  'coupons.*');
        }

        if ($request->view == 'coupons.used') {

            $allCoupons = DB::table('coupon_emails')
                ->join('emails', 'emails.id', '=', 'coupon_emails.email_id')
                ->join('coupons', 'coupons.id', '=', 'coupon_emails.coupon_id')
                ->join('coupon_types', 'coupon_types.id', '=', 'coupons.coupon_type')
                ->join('coupon_subtypes', 'coupon_subtypes.id', '=', 'coupons.coupon_subtype')
                ->select('coupon_types.type_name', 'coupon_subtypes.subtype_name',  'coupons.*', 'emails.*', 'coupon_emails.*');
        }

        if ($request->view == 'email.email') {

            $allCoupons = DB::table('emails')
                ->select('emails.*');
        }


        $allCoupons->when(request('used_at', false), function ($q, $used_to) {
            return $q->where('coupon_emails.used_at', '>=', $used_to);
        });
        $allCoupons->when(request('used_to', false), function ($q, $used_to) {
            return $q->where('coupon_emails.used_at', '<=', $used_to);
        });
        $allCoupons->when(request('created_at', false), function ($q, $created_at) {
            return $q->where('created_at', '>=', $created_at);
        });
        $allCoupons->when(request('created_to', false), function ($q, $created_to) {
            return $q->where('created_at', '<=', $created_to);
        });
        $allCoupons->when(request('coupon_type', false), function ($q, $coupon_type) {
            return $q->where('coupon_type', $coupon_type);
        });
        $allCoupons->when(request('coupon_subtype', false), function ($q, $coupon_subtype) {
            return $q->where('coupon_subtype', $coupon_subtype);
        });
        $allCoupons->when(request('value', false), function ($q, $value) {
            return $q->where('value', $value);
        });
        $allCoupons->when(request('status', false), function ($q, $status) {
            return $q->where('status', $status);
        });
        $allCoupons->when(request('used_times', false), function ($q, $used_times) {
            return $q->where('used_times', $used_times);
        });
        $allCoupons->when(request('coupon_used', false), function ($q, $coupon_used) {
            return $q->where('coupons_used', $coupon_used);
        });
        $allCoupons->when(request('creator_email', false), function ($q, $creator_email) {
            return $q->where('creator_email', $creator_email);
        });
        $allCoupons->when(request('email', false), function ($q, $email) {
            return $q->where('email', $email);
        });


        $allCoupons = $allCoupons->get();

        return view($request->view, compact('allCoupons'));
    }
}
