<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function staff_all_purchases()
    {
        return view('staff.staff_purchasing_monitoring');
    }
}
