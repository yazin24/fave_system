<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthentictedSessionController extends Controller
{
    public function login_customer(Request $request)
    {
       $credentials = $request -> only('email', 'password');

       if(Auth::guard('customers') -> attempt($credentials)){

        return redirect() -> route('homepage');
        
       }else{

        return redirect() -> back() -> with('success', 'Invalid login credentials');
       }
       
    }

    public function logout_customer()
    {
        Auth::guard('customers') -> logout();

        return redirect() -> route('homepage');
    }
}
