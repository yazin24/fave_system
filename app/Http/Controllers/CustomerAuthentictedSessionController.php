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

       if(Auth::attempt($credentials)){

        return view('ecommerce.home_page');
       }else{
        return redirect() -> back() -> with('success', 'Invalid login credentials');
       }
       
    }
}
