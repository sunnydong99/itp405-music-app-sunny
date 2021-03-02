<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $loginWasSuccessful = Auth::attempt([ // attempt method will do the encryption with Hash then check against DB
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]); // returns boolean; it will also do the login (no need for Auth::login($user))
        
        if ($loginWasSuccessful){
            return redirect()->route('profile.index');
        } else {
            return redirect()->route('auth.loginForm')->with('error', 'Invalid credentials.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('invoice.index');
    }
}
