<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class EditDeleteController extends Controller
{

    public function edit(Request $request)
    {

        $coupon = Coupon::where('id', $request->id)->first();

        return view('coupons.edit', compact('coupon'));
    }

    public function store(Request $request)
    {
        Coupon::where('id', $request->id)->update($request->except(['_token', '_method', 'id']));

        return redirect('/all')->with('message', "Coupon has been successfully updated");
    }

    public function destroy(Request $request)
    {

        Coupon::destroy($request->id);
        return back();
    }
}
