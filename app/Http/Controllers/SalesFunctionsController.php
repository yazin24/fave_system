<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Areas;
use App\Models\CustomersPurchaseOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

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

    public function generate_po_receipt(CustomersPurchaseOrders $allPurchaseOrder)
    {
        $templateReceiptPath = ('receipts/cspo_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        // $templateReceipt -> setValue('PTERM', $allPurchaseOrder -> purchaseOrderTerms -> payment_term);

        // $templateReceipt -> setValue('PO', $allPurchaseOrder -> productSku -> barcode);

        $createdDate = date('Y-m-d', strtotime($allPurchaseOrder -> created_at));

        $templateReceipt -> setValue('PO_DATE', $createdDate);

        $templateReceipt -> setvalue('CUSTOMER', $allPurchaseOrder -> customers -> store_name);

        $templateReceipt -> setvalue('CUSTOMER_ADDRESS', $allPurchaseOrder -> customers -> address);

        $templateReceipt -> setvalue('CUSTOMER_NUMBER', $allPurchaseOrder -> customers -> contact_number);

        $templateReceipt -> setvalue('CUSTOMER_PERSON', $allPurchaseOrder -> customers -> full_name);

        // $templateReceipt -> setValue('REQUESTED_BY', $allPurchaseOrder -> requested_by);

        // $templateReceipt -> setValue('PREPARED_BY', $allPurchaseOrder -> prepared_by);

        // $templateReceipt -> setValue('APPROVED_BY', $allPurchaseOrder -> approved_by);

        // $templateReceipt -> setValue('TOTAL', $allPurchaseOrder -> pivot -> sum('amount'));

        $items = $allPurchaseOrder -> productSku;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("ITEM_QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("UNIT{$itemIndex}", $item -> allItems -> item_unit);

            $templateReceipt -> setValue("ITEM_NAME{$itemIndex}", $item -> allItems -> item_name);

            $templateReceipt ->  setValue("UNIT_PRICE{$itemIndex}", $item -> unit_price);

            $templateReceipt -> setValue("AMOUNT{$itemIndex}", $item -> amount);

            $itemIndex++;

        }

         //     //this remove the placeholder for the remaining rows in the table thats empty
         for ($i = $itemIndex; $i <= $itemRows; $i++) {
            $templateReceipt->setValue("ITEM_QUANTITY{$i}", '');
            $templateReceipt->setValue("UNIT{$i}", '');
            $templateReceipt->setValue("ITEM_NAME{$i}", '');
            $templateReceipt->setValue("UNIT_PRICE{$i}", '');
            $templateReceipt->setValue("AMOUNT{$i}", '');
        }

        $savePath = public_path('P.O_' . $allPurchaseOrder -> customers -> full_name . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);

    }
}
