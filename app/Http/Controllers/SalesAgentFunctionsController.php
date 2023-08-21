<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Customers;
use App\Models\CustomersPurchaseOrders;
use App\Models\ProductSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SalesAgentFunctionsController extends Controller
{
    public function view_dashboard()
    {
        return view('salesagent.agent_dashboard');
    }

    public function enter_password(Agents $agent)
    {
        return view('salesagent.agent_password', ['agent' => $agent]);
    }

    public function verify_password(Request $request, $agent)
    {
        $realAgent = Agents::findOrFail($agent);

        if(!$realAgent){
            abort(404);
        }

        $password = $request -> input('password');

        if(Hash::check($password, $realAgent -> agents_password)){
            // dd($realAgent->agents_password);
            return view('salesagent.agent_dashboard', ['agent' => $realAgent]);

        }else {

            return back() -> withErrors(['password' => 'Invalid Password! Please try again.']);

        }
    }

    public function agent_sales_monitoring(Agents $agent)
    {
        return view('salesagent.sales_monitoring', ['agent' => $agent]);
    }

    public function customer_list(Agents $agent)
    {

        $allCustomers = Customers::where('agent_id', $agent -> id) -> get();

        return view('salesagent.customer_list', ['agent' => $agent, 'allCustomers' => $allCustomers]);
    }

    public function new_customer(Agents $agent)
    {
        return view('salesagent.new_customer', ['agent' => $agent]);
    }

    public function add_customer(Request $request, Agents $agent)
    {
        // $theAgent = Agents::findOrFail($agent);

        $customerAgent = $agent -> id;

        $customerName = $request -> input('full_name');
        
        $customerStore = $request -> input('store_name');

        $customerNumber = $request -> input('contact_number');

        $customerAddress = $request -> input('address');

        $newCustomer = Customers::create([
            'full_name' => $customerName,
            'store_name' => $customerStore,
            'agent_id' => $customerAgent,
            'contact_number' => $customerNumber,
            'address' => $customerAddress,
        ]);

        Session::flash('success', 'Customer has been added to your list!');
        return view('salesagent.agent_dashboard', ['agent' => $agent]);
    }

    public function request_po(Agents $agent)
    {
        $agentCustomers = Customers::where('agent_id', $agent -> id) -> get(); 

        $allProducts = ProductSku::all();

        // dd($allProducts);

        return view('salesagent.request_po', ['agent' => $agent, 'allProducts' => $allProducts, 'agentCustomers' => $agentCustomers]);
    }

    public function create_po(Request $request, $agent)
    {
        $customerName = $request -> input('customer_name');

        $agentId = Agents::findOrFail($agent);

        $selectedSkus = $request -> input('selected_product', []);

        $skuNames = $request -> input('product_id', []);

        $skuPrice = $request -> input('price', []);

        $skuQuantity = $request -> input('quantity', []);

        $newCustomerPurchaseOrder = CustomersPurchaseOrders::create([

        'cs_id' => $customerName,
        'agent_id' => $agentId -> id,
        'status' => 3,
        'del_status' => 7,
        ]);

        $csPurchaseOrderId = $newCustomerPurchaseOrder -> id;

        foreach($skuNames as $index => $skuName){
            if(in_array($index, $selectedSkus)){
                $theQuantity = $skuQuantity[$index] ?? null;
                $thePrice = $skuPrice[$index] ?? null;

                if($theQuantity && $thePrice){

                    $orderSku = [
                        'cs_po_id' => $csPurchaseOrderId,
                        'sku' => $index,
                        'quantity' => $theQuantity,
                        'price' => $thePrice,
                    ];

                    if($thePrice == 35 || $thePrice == 129){
                        $orderSku['isRetail'] = true;
                        $orderSku['isWholesale'] = false;
                    }elseif($thePrice ==29 || $thePrice == 115){
                        $orderSku['isRetail'] = false;
                        $orderSku['isWholesale'] = true;
                    }else {
                        $orderSku['isRetail'] = false;
                        $orderSku['isWholesale'] = false;
                    }

                 $newCustomerPurchaseOrder -> productSku() -> attach($index, $orderSku);

                }
            }
        }

        Session::flash('success', 'The Purchase Order has been created!');
        return view('salesagent.agent_dashboard', ['agent' => $agentId]);
    }

    public function view_customers_stocks(Agents $agent, $customer)
    {

        return view('salesagent.view_customers_stock', ['agent' => $agent, 'customer' => $customer]);
    }
}
