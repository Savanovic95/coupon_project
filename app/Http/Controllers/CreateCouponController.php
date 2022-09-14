<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Multi;
use App\Models\Coupon;
use App\Models\CouponType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CouponPattern;
use App\Models\CouponSubtype;

class CreateCouponController extends Controller
{

    public function create_coupon_index()
    {
        if (!auth()->check()) { //check if user is loged in
            return view('login');
        }
        return view('coupons.create');
    }
    public function store(Request $request)
    {

        if (!auth()->check()) { //check if user is loged in
            return back();
        }

        if (isset($request->value)) {
            $request->value = intval($request->value);
        }
        if (isset($request->limit)) {
            $request->limit = intval($request->limit);
        }

        $this->validate($request, [ //validate input
            'email' => '',
            'coupon_type' => 'required',
            'coupon_subtype' => 'required',
            'value' => ''

        ]);

        if ($request->coupon_subtype == 1 && !in_array($request->value, range(5, 100))) {
            return back()->withErrors(['message' => 'You must set value between 5 and 100.']);
        } elseif ($request->coupon_type != 2 && isset($request->limit)) {
            return back()->withErrors(['message' => 'You can set limit only with multi-limit type.']);
        } elseif ($request->coupon_type == 1 && !isset($request->email)) {
            return back()->withErrors(['message' => 'You can create single cupon only with email.']);
        } elseif (in_array($request->coupon_subtype, [1, 2]) && !isset($request->value)) {
            return back()->withErrors(['message' => 'You must set the value.']);
        } elseif (!in_array($request->coupon_type, [3, 4]) && isset($request->valid_until)) {
            return back()->withErrors(['message' => 'You can set date only with single-expires or multi-expires.']);
        } elseif ($request->coupon_subtype == 3 && isset($request->value)) {
            return back()->withErrors(['message' => 'You can not set a value with free coupons.']);
        } elseif (in_array($request->coupon_type, [3, 4]) && !isset($request->valid_until)) {
            return back()->withErrors(['message' => 'You must set date of expires coupons.']);
        } elseif ($request->coupon_type == 2 && !isset($request->limit)) {
            return back()->withErrors(['message' => 'You must set limit with multi-limit coupon.']);
        } elseif (!in_array($request->coupon_type, range(1, count(CouponType::all())))) {
            return back()->withErrors(['message' => 'You must insert valid coupon id']);
        } elseif ($request->value < 1 && $request->coupon_subtype != 3) {
            return back()->withErrors(['message' => 'Value must be 1 or bigger']);
        } elseif ($request->coupon_type == 3 && $request->valid_until < now()) {
            return back()->withErrors(['message' => 'Date is not valid']);
        } elseif ((isset($request->limit) && $request->limit < 1)) {
            return back()->withErrors(['message' => 'Limit must be 1 or bigger']);
        } elseif (!is_int($request->value) && $request->coupon_subtype != 3) {
            return back()->withErrors(['message' => 'Value must be an integer!']);
        } elseif ($request->coupon_type == 2 && !is_int($request->limit)) {
            return back()->withErrors(['message' => 'Value must be an integer!']);
        }





        while (true) {
            $random = strtoupper(Str::random(6)); // generate random code
            $existing_code = Coupon::where('coupon_code', $random)->first(); // check if the same code exists
            if (!$existing_code) {
                break;
            }
        }


        $newCoupon = new Coupon;

        $value = ltrim($request->input('value'), '0');
        $limit = ltrim($request->input('limit'), '0');
        $expiration = ($request->input('expiration_date'));
        $type_id = $request->input('coupon_type');
        $subtype_id = $request->input('coupon_subtype');
        $email   = $request->input('email');

        if ($type_id == 1) {

            $newCoupon->creator_email = $email;
        }

        if ($type_id == 2) {

            $newCoupon->limit = $limit;
        }

        if ($type_id == 3 or $type_id == 4) {

            $newCoupon->valid_until = $expiration;
        }

        if ($subtype_id == 1 or $subtype_id == 2) {

            if ($value) {

                $newCoupon->value = $value;
            }
        }


        $newCoupon->fill($request->all());
        $newCoupon->coupon_code = $random;
        $newCoupon->save();

        if ($request->email && !Email::where('email', '=', $request->email)->first()) {

            $newEmail = new Email;
            $newEmail->email = $email;
            $newEmail->save();

            return redirect('/create')->with('message', ' New coupon has been created! ' . $email . ': ' . $newCoupon->coupon_code);
        }

        return redirect('/create')->with('message', ' New coupon has been created! ' . $newCoupon->coupon_code);
    }
}
