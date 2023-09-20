<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EcomCustomers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredCustomerController extends Controller
{
    public function register_customer(Request $request)
    {
        $request -> validate([

            'full_name' => 'required',
            'email' => ['required', 'email', 'unique:'.EcomCustomers::class],
            'phone' => 'required',
            'password' =>['required', 'confirmed', Rules\Password::defaults()]

        ], [
            'full_name.required' => 'Full name is required',
            'email.required' => 'Email is Required',
            'phone.required' => 'Phone number is required',
            'password.required' => 'Password is required',
            'password.confirm' => 'Password do not match'
        ]);

        $customer = EcomCustomers::create([

            'name' => $request -> full_name,
            'email' => $request -> email,
            'phone_number' => $request -> phone,
            'password' => Hash::make($request -> password),

        ]);

        return view('ecommerce.login') -> with('success', 'Registered Successfully! You can now login.');
    }
}
