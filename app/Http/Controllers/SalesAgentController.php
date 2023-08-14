<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesAgentController extends Controller
{
    public function sales_agent_monitoring()
    {
        return view('salesagent.sales_monitoring');
    }

    public function request_po()
    {
        return view('salesagent.request_po');
    }

    public function customer_monitoring()
    {
        return view('salesagent.customer_monitoring');
    }
}
