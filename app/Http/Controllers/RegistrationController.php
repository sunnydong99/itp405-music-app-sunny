<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // bycrypt encryption

        // $user->role_id = Role::where('slug', '=', 'user')->first()->id;
        $userRole = Role::getUser(); // getUser() is created in Role model
        $user->role()->associate($userRole); // using role() as a method allows us to change it?
        // dd($userRole);
        $user->save();

        Auth::login($user); // log(s the user in
        return redirect()->route('profile.index');
    }
}
