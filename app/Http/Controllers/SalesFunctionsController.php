<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Areas;
use App\Models\CustomersPurchaseOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SalesFunctionsController extends Controller
{
    public function new_agent()
    {
        $allAreas = Areas::all();

        return view('sales.new_agent', ['allAreas' => $allAreas]);
    }

    public function add_agent(Request $request)
    {
        $agentName = $request -> input('full_name');

        $agentArea = $request -> input('designated_area');

        $agentNumber = $request -> input('contact_number');
        
        $agentAddress = $request -> input('address');

        $agentFbMessenger = $request -> input('fb_messenger');

        $agentEmail = $request -> input('email_address');

        $agentPassword = $request -> input('password');

        $newAgent = Agents::create([

            'agent_name' => $agentName,
            'area_id' => $agentArea,
            'agent_number' => $agentNumber, 
            'agent_address' => $agentAddress,
            'fb_messenger' => $agentFbMessenger,
            'email_address' => $agentEmail,
            'agents_password' => Hash::make($agentPassword),

        ]);

        Session::flash('success', 'New Agent has been added');
        return view('sales.sales_home');
    }

    public function view_purchase_details(CustomersPurchaseOrders $allPurchaseOrder)
    {
        $totalAmount = 0;

            foreach($allPurchaseOrder -> productSku as $product){
                $totalAmount += $product -> pivot -> quantity * $product -> pivot -> price;
            }

        return view('sales.view_purchase_details', ['allPurchaseOrder' => $allPurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function view_approve_po(CustomersPurchaseOrders $purchaseOrder)
    {
            $totalAmount = 0;

            foreach($purchaseOrder -> productSku as $product){
                $totalAmount += $product -> pivot -> quantity * $product -> pivot -> price;
            }

        return view('sales.approve_po', ['purchaseOrder' => $purchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function approve_purchase_order(Request $request, $purchaseOrder)
    {
        $approvePurchaseOrder = CustomersPurchaseOrders::findOrFail($purchaseOrder);

        $approvePurchaseOrder -> status = 1;

        $approvePurchaseOrder -> save();

        $customer = $approvePurchaseOrder -> customers;

        foreach ($approvePurchaseOrder->productSku as $product) {
            $customerStock = $customer->customersStocks()->where('sku_id', $product->id)->first();
    
            if ($customerStock) {
                $customerStock->quantity += $product->pivot->quantity;
                $customerStock->save();
            } else {
                $customer->customersStocks()->create([
                    'cs_id' => $approvePurchaseOrder->cs_id,
                    'sku_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                ]);
            }
        }

        Session::flash('success', 'Purchase Order has been approved!');
        return view('sales.sales_home');

    }

    public function disapprove_purchase_order($purchaseOrder)
    {

        $disapprovePurchaseOrder = CustomersPurchaseOrders::findOrFail($purchaseOrder);

        $disapprovePurchaseOrder -> status = 2; 

        $disapprovePurchaseOrder -> save();


        Session::flash('success', 'Purchase Order has been approved!');
        return view('sales.sales_home');

    }
}
