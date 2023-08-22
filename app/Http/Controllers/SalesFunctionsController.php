<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Areas;
use App\Models\CustomersPurchaseOrders;
use App\Models\ManualPurchaseOrder;
use App\Models\ProductSku;
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

    public function view_purchase_details(CustomersPurchaseOrders $purchaseOrder)
    {
        $totalAmount = 0;

            foreach($purchaseOrder -> productSku as $product){
                $totalAmount += $product -> pivot -> quantity * $product -> pivot -> price;
            }

        return view('sales.view_purchase_details', ['purchaseOrder' => $purchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function manual_purchase_order()
    {
        $allProducts = ProductSku::all();

        return view('sales.create_customer_po',['allProducts' => $allProducts]);
    }

    public function create_customer_po(Request $request)
    {
        $customerName = $request -> input('customers_name');

        $contactNumber = $request -> input('contact_number');

        $customerAddress = $request -> input('address');

        $purchaseType = $request -> input('purchase_type');

        $selectedSkus = $request -> input('selected_product', []);

        $chosenProducts = $request -> input('product_id', []);
        
        $inputPrice = $request -> input('price', []);

        $inputQuantity = $request -> input('quantity', []);

        $newManualPurchaseOrder = ManualPurchaseOrder::create([

            'customers_name' => $customerName,
            'contact_number' => $contactNumber,
            'address' => $customerAddress,
            'purchase_type' => $purchaseType,
            'isApproved' => 0,

        ]);

        $manualPoId = $newManualPurchaseOrder -> id;

        foreach($chosenProducts as $index){
            if(in_array($index, $selectedSkus)){
                $theQuantity = $inputQuantity[$index] ?? null;
                $thePrice = $inputPrice[$index] ?? null;

                if($theQuantity && $thePrice){
                    $totalAmount = $theQuantity * $thePrice;

                    $newManualPurchaseOrder -> manualPurchaseOrderProducts() -> create([

                            'manual_po_id' => $manualPoId,
                            'sku_id' => $index,
                            'quantity' => $theQuantity,
                            'price' => $thePrice,
                            'amount' => $totalAmount,

                    ]);
                }
            }

        }

        Session::flash('success', 'The Purchase Order has been created!');
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

    public function generate_po_receipt(CustomersPurchaseOrders $purchaseOrder)
    {
        $templateReceiptPath = ('receipts/cspo_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        // $templateReceipt -> setValue('PTERM', $purchaseOrder -> purchaseOrderTerms -> payment_term);

        // $templateReceipt -> setValue('PO', $allPurchaseOrder -> id);

        $createdDate = date('Y-m-d', strtotime($purchaseOrder -> created_at));

        $templateReceipt -> setValue('PO_DATE', $createdDate);

        $templateReceipt -> setvalue('CUSTOMER', $purchaseOrder -> customers -> store_name);

        $templateReceipt -> setvalue('ADDRESS', $purchaseOrder -> customers -> address);

        $templateReceipt -> setvalue('NUMBER', $purchaseOrder -> customers -> contact_number);

        $templateReceipt -> setvalue('PERSON', $purchaseOrder -> customers -> full_name);

        // $templateReceipt -> setValue('REQUESTED_BY', $purchaseOrder -> requested_by);

        // $templateReceipt -> setValue('PREPARED_BY', $purchaseOrder -> prepared_by);

        // $templateReceipt -> setValue('APPROVED_BY', $purchaseOrder -> approved_by);

        // $templateReceipt -> setValue('TOTAL', $purchaseOrder -> pivot -> sum('amount'));

        $items = $purchaseOrder -> productSku;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("PRODUCT{$itemIndex}", $item -> full_name);

            $templateReceipt -> setValue("VARIANT{$itemIndex}", $item -> productVariants -> variant_name);

            $size = '';

            if ($item->sku_size == 1000) {
                $size = '1 Liter';
            } elseif ($item->sku_size == 3785.41) {
                $size = '1 Gallon';
            } else {
                // Add more conditions if needed
            }

            $templateReceipt -> setValue("SIZE{$itemIndex}", $size);

            $templateReceipt ->  setValue("QUANTITY{$itemIndex}", $item -> pivot -> quantity);

            $templateReceipt -> setValue("PRICE{$itemIndex}", $item -> pivot -> price);

            $itemIndex++;

        }

         //     //this remove the placeholder for the remaining rows in the table thats empty
         for ($i = $itemIndex; $i <= $itemRows; $i++) {
            $templateReceipt->setValue("PRODUCT{$i}", '');
            $templateReceipt->setValue("VARIANT{$i}", '');
            $templateReceipt->setValue("SIZE{$i}", '');
            $templateReceipt->setValue("QUANTITY{$i}", '');
            $templateReceipt->setValue("PRICE{$i}", '');
        }

        $savePath = public_path('P.O_' . $purchaseOrder -> customers -> full_name . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);

    }
}
