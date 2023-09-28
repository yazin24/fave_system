<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SetAppointmentController extends Controller
{
    public function setAppointment(Request $request)
    {
        $request -> validate([

            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string',

        ]);

        
    }
}
