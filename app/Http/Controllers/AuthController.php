<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller

{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt($login)) {
            $request->session()->regenerate();
            return redirect('home');
        }
        return back();
    }
    public function home()
    {
        return view('home');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
