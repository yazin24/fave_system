<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Areas;
use App\Models\CustomersPurchaseOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

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

        FacadesSession::flash('success', 'New Agent has been added');
        return view('sales.sales_home');
    }

    public function view_approve_po(CustomersPurchaseOrders $purchaseOrder)
    {
            $totalAmount = 0;

            foreach($purchaseOrder -> productSku as $product){
                $totalAmount += $product -> pivot -> quantity * $product -> pivot -> price;
            }

        return view('sales.approve_po', ['purchaseOrder' => $purchaseOrder, 'totalAmount' => $totalAmount]);
    }
}
