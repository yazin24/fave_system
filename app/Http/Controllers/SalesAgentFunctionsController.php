<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesAgentFunctionsController extends Controller
{
    public function new_customer()
    {
        return view('salesagent.new_customer');
    }
}
