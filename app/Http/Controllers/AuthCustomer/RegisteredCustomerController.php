<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisteredCustomerController extends Controller
{
    public function register_customer(Request $request)
    {
        $request -> validate([

            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            

        ]);
    }
}
