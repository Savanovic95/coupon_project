<?php

namespace App\Http\Controllers\Version_2;

use Carbon\Carbon;
use App\Models\Email;
use App\Models\Coupon;
use App\Models\CouponType;
use App\Models\CouponEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CouponSubtype;
use App\Http\Controllers\Controller;
use App\Http\Requests\Version_2\CouponRequest;

class ApiController extends Controller
{


    public function store(Coupon $newCoupon, CouponRequest $request)

    {
        if (isset($request->value)) {
            $request->value = intval($request->value);
        }
        if (isset($request->limit)) {
            $request->limit = intval($request->limit);
        }

        if ($request->coupon_subtype == 1 && !in_array($request->value, range(5, 100))) {
            return response()->json(['status' => false, 'message' => 'You must set value between 5 and 100.']);
        } elseif ($request->coupon_type != 2 && isset($request->limit)) {
            return response()->json(['status' => false, 'message' => 'You can set limit only with multi-limit type.']);
        } elseif ($request->coupon_type == 1 && !isset($request->email)) {
            return response()->json(['status' => false, 'message' => 'You can create single cupon only with email.']);
        } elseif (in_array($request->coupon_subtype, [1, 2]) && !isset($request->value)) {
            return response()->json(['status' => false, 'message' => 'You must set the value.']);
        } elseif (!in_array($request->coupon_type, [3, 4]) && isset($request->valid_until)) {
            return response()->json(['status' => false, 'message' => 'You can set date only with single-expires or multi-expires.']);
        } elseif ($request->coupon_subtype == 3 && isset($request->value)) {
            return response()->json(['status' => false, 'message' => 'You can not set a value with free coupons.']);
        } elseif (in_array($request->coupon_type, [3, 4]) && !isset($request->valid_until)) {
            return response()->json(['status' => false, 'message' => 'You must set date of expires coupons.']);
        } elseif ($request->coupon_type == 2 && !isset($request->limit)) {
            return response()->json(['status' => false, 'message' => 'You must set limit with multi-limit coupon.']);
        } elseif (!in_array($request->coupon_type, range(1, count(CouponType::all())))) {
            return response()->json(['status' => false, 'message' => 'You must insert valid coupon id']);
        } elseif ($request->value < 1 && $request->coupon_subtype != 3) {
            return response()->json(['status' => false, 'message' => 'Value must be 1 or bigger']);
        } elseif ($request->coupon_type == 3 && $request->valid_until < now()) {
            return response()->json(['status' => false, 'message' => 'Date is not valid']);
        } elseif ((isset($request->limit) && $request->limit < 1)) {
            return response()->json(['status' => false, 'message' => 'Limit must be 1 or bigger']);
        } elseif (!is_int($request->value) && $request->coupon_subtype != 3) {
            return response()->json(['status' => false, 'message' => 'Value must be an integer!']);
        } elseif ($request->coupon_type == 2 && !is_int($request->limit)) {
            return response()->json(['status' => false, 'message' => 'Value must be an integer!']);
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
        $expiration = ($request->input('valid_until'));
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
        }

        return response()->json([
            'status' => 'true',
            'code' => $newCoupon->coupon_code,
            'email' => $newCoupon->creator_email
        ]);
    }


    public function use(Request $request) //Method for using coupons over API
    {

        $coupons = Coupon::where('coupon_code', $request->code)->first();

        if ($request->email) { //Check if email is valid

            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

                return response()->json([

                    'status' => 'false',
                    'data_error' => 'Enter valid email address'

                ]);
            }
        }


        if ($coupons) { //Check if coupon exist

            if ($coupons->status == 'used') { //Check if coupon is used

                return response()->json([

                    'status' => 'false',
                    'data_error' => 'Coupon is already used!'
                ]);
            }

            if ($coupons->status == 'inactive') { //Check if coupon is active

                return response()->json([
                    'status' => 'false',
                    'data_error' => 'Coupon is not active!'

                ]);
            }

            if (!$request->email) { //Check if request has email address

                return response()->json([

                    'status' => 'false',
                    'data_error' => 'Enter email address'

                ]);
            }

            if ($coupons->coupon_type == 1) {


                if ($coupons->creator_email != $request->email) { //Check if single coupon has the same email as creator 


                    return response()->json([
                        'status' => 'false',
                        'data_error' => 'Wrong email address'

                    ]);
                }
            }

            if ($coupons->coupon_type == 2) { //Check if coupon limit has been reached 

                $count_used = CouponEmail::where('coupon_id', $coupons->id)->get();
                $count = count($count_used);

                if ($coupons->limit == $count) {

                    $coupons->status = 'used';
                    $coupons->update();

                    return response()->json([
                        'status' => 'false',
                        'data_error' => 'Coupon limit has been reached'

                    ]);
                }
            }

            if ($coupons->coupon_type == 2 or $coupons->coupon_type == 3) { //Check if coupon is already used by provided email address

                $email_id = Email::where('email', $request->email)->first();

                if ($email_id) {

                    $used_email = CouponEmail::where('email_id', $email_id->id)
                        ->where('coupon_id', $coupons->id)->first();

                    if ($used_email) {

                        return response()->json([

                            'status' => 'false',
                            'data_error' => 'Already used coupon with this email'
                        ]);
                    }
                }
            }

            if ($coupons->coupon_type == 3 or $coupons->coupon_type == 4) { // Check if coupon is expired

                $date = date('Y-m-d');


                if ($coupons->valid_until < $date) {

                    $coupons->status = 'inactive';
                    $coupons->update();

                    return response()->json([

                        'status' => 'false',
                        'data_error' => 'Coupon expired'
                    ]);
                }
            }

            $used_email = Email::where('email', $request->email)->first(); //Check if provided email address used any coupon before

            if (!$used_email) {

                $used_email = new Email();
                $used_email->email = $request->email;
                $used_email->first_coupon_use = now();
                $used_email->last_coupon_use = now();
                $used_email->coupons_used++;
                $used_email->save();
            } else {

                if (!$used_email->first_coupon_use) {

                    $used_email->first_coupon_use = now();
                }

                $used_email->last_coupon_use = now();
                $used_email->coupons_used++;
                $used_email->update();
            }


            $used = new CouponEmail;
            $used->coupon_id = $coupons->id;
            $used->email_id = $used_email->id;
            $used->used_at = date('Y-m-d');
            $used->save();

            if ($coupons->coupon_type == 1) {

                $coupons->status = "used";
            }

            $coupons->used_at = now();
            $coupons->used_times++;
            $coupons->update();
            return response()->json([

                'status' => 'true'

            ]);
        } else {

            return response()->json([

                'status' => 'false',
                'data_error' => 'There is no such coupon'
            ]);
        }
    }
}
