<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function all()
    {
        $allCoupons = DB::table('emails')->select('emails.*')->orderByRaw('created_at DESC')->paginate(10);

        return view('email.email', compact('allCoupons'));
    }
}
