<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales_monitoring()
    {
        return view('sales.sales_monitoring');
    }

    public function sales_purchase_orders()
    {
        return view('sales.sales_purchase_orders');
    }

    public function agent_monitoring()
    {
        $allAgents = Agents::all();

        return view('sales.agent_monitoring', ['allAgents' => $allAgents]);
    }
}
