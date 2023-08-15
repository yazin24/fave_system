<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesAgentFunctionsController extends Controller
{
    public function view_dashboard()
    {
        return view('salesagent.agent_dashboard');
    }

    public function enter_password()
    {
        return view('salesagent.agent_password');
    }
}
