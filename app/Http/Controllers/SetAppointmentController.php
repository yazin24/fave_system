<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SetAppointmentController extends Controller
{
    public function set_appointment(Request $request)
    {
        $request -> validate([

            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string',

        ]);

        $message = $request->input('message');

        $mail = new AppointmentEmail(
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
           $message,
        );

        Mail::to('faveecommerce@gmail.com')->send($mail);

    return redirect()->route('homepage')->with('success', 'Appointment request sent successfully!');
    }
}
