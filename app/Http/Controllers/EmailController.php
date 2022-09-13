<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function all()
    {
        $allCoupons = Email::all();

        return view('email.email', compact('allCoupons'));
    }
}
