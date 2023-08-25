<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\CustomersPurchaseOrders;
use App\Models\ManualPurchaseOrder;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales_monitoring()
    {
        return view('sales.sales_monitoring');
    }

    public function shopee_lazada_sales()
    {
        return view('sales.shopee_lazada_sales');
    }


    public function sales_purchase_orders()
    {
        $allPurchaseOrders = CustomersPurchaseOrders::where('status', 1) -> get();

        return view('sales.sales_purchase_orders',['allPurchaseOrders' => $allPurchaseOrders]);
    }

    public function sales_manual_po()
    {
        $allManualPurchaseOrders = ManualPurchaseOrder::all();

        return view('sales.manual_po', ['allManualPurchaseOrders' => $allManualPurchaseOrders]);
    }

    public function for_approval()
    {
        $purchaseOrders = CustomersPurchaseOrders::where('status', 3) -> get();

        return view('sales.for_approval', ['purchaseOrders' => $purchaseOrders]);
    }

    public function agent_monitoring()
    {
        $allAgents = Agents::all();

        return view('sales.agent_monitoring', ['allAgents' => $allAgents]);
    }
}
