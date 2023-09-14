<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function sales_monitoring()
    {
        return view('superadmin.sales_monitoring');
    }

    public function purchasing_monitoring()
    {
        return view('superadmin.purchasing_monitoring');
    }
}
