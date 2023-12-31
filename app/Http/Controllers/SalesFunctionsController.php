<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Areas;
use App\Models\Customers;
use App\Models\CustomersPurchaseOrders;
use App\Models\EcomCustomerOrders;
use App\Models\EcomCustomers;
use App\Models\LazadaOrders;
use App\Models\ManualPurchaseOrder;
use App\Models\ProductSku;
use App\Models\ShopeeOrders;
use App\Models\TiktokOrders;
use App\Models\TiktokSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

class SalesFunctionsController extends Controller
{
    public function search_field(Request $request)
    {
        //the orWhereHas indicates that it is in another table that is associated to the original table
        //using orWhereHas is a way to get or find the data that is in another table

        $search = $request -> input('search');

        $ecommerceOrders = EcomCustomerOrders::where(function($query) use ($search) {
            $query->where('tracking_number', 'LIKE', '%' . $search . '%')
                  ->orWhere('status', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('ecomCustomers', function($customerQuery) use ($search) {
                      $customerQuery->where('name', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('ecomCustomerPaymentTransactions', function($transactionQuery) use ($search) {
                      $transactionQuery->where('payment_method', 'LIKE', '%' . $search . '%');
                      $transactionQuery->orWhere('amount', 'LIKE', '%' . $search . '%');
                  });
        }) -> orderBy('created_at', 'desc') ->paginate(10);

        return view('sales.ecommerce_dashboard', ['ecommerceOrders' => $ecommerceOrders]);
        
    }

    public function ecommerce_customers()
    {
        $allEcomCustomers = EcomCustomers::paginate(10);

        return view('sales.ecommerce_customers', ['allEcomCustomers' => $allEcomCustomers]);
    }

    public function ecommerce_customers_details(EcomCustomers $customer)
    {
        $customer -> load([

            'ecomCustomerOrders.ecomCustomerOrderItems',
            'ecomCustomerOrders.ecomCustomerPaymentTransactions',
            'ecomCustomerOrders.ecomOrderSales',

        ]);

        return view('sales.ecommerce_customers_details', ['customer' => $customer]);
    }

    public function ecommerce_products()
    {
        $allProducts = ProductSku::paginate(10);

        return view('sales.ecommerce_products', ['allProducts' => $allProducts]);
    }

    public function ecommerce_order_view(EcomCustomerOrders $ecommerceOrder)
    {
        return view('sales.ecommerce_order_details', ['ecommerceOrder' => $ecommerceOrder]);
    }

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
        $request->validate([
        
            'customers_name' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'selected_product' => 'array',
            'selected_product.*' => 'exists:product_sku,id', // Validate selected products
        
            // Validation rules for price and quantity, but only for selected products
            'price.*' => 'required_if:selected_product.*,1|numeric', // Price is required if the product is selected
            'quantity.*' => [
                'nullable', // Quantity can be null if not selected
                'numeric',  // Quantity must be numeric if selected
                'required_if:selected_product.*,1', // Quantity is required if the product is selected
            ], // Quantity is required if the product is selected
        ],[
            'customers_name.required' => 'Customer Name is required',
            'contact_number.required' => 'Phone Number is required',
            'address.required' => 'Customer Address is required',
            'selected_product.required' => 'Please hit the checkbox to choose the product',
            'price.required_if' => 'Price is required for selected products',
            'price.numeric' => 'Price must be a number',
            'quantity.required_if' => 'Quantity is required for selected products',
            'quantity.numeric' => 'Quantity must be a number',
        ]);

        $customerName = $request -> input('customers_name');

        $contactNumber = $request -> input('contact_number');

        $customerAddress = $request -> input('address');

        $purchaseType = $request -> input('purchase_type');

        $selectedSkus = $request -> input('selected_product', []);

        $chosenProducts = $request -> input('product_id', []);
        
        $inputPrice = $request -> input('price', []);

        $inputQuantity = $request -> input('quantity', []);

        $lastPurchaseOrder = ManualPurchaseOrder::latest('id') -> first();

        $lastPoNumber = $lastPurchaseOrder ? $lastPurchaseOrder -> po_number : null;

        $prefix = 'MP';

        $poLength = 5;
       
        $counter = 0;

        if($lastPoNumber){

            $lastCounter = (int)substr($lastPoNumber, strlen($prefix));

            $counter = $lastCounter + 1;
        }
        
        $poPart = str_pad($counter, $poLength, '0', STR_PAD_LEFT);

        $realPoNumber = $prefix . $poPart;

        $encoderName = Auth::user() -> name;

        $newManualPurchaseOrder = ManualPurchaseOrder::create([

            'po_number' => $realPoNumber,
            'customers_name' => $customerName,
            'contact_number' => $contactNumber,
            'address' => $customerAddress,
            'purchase_type' => $purchaseType,
            'isApproved' => 3,
            'encoded_by' => $encoderName,

        ]);

        $manualPoId = $newManualPurchaseOrder -> id;

        foreach($chosenProducts as $index){
            if(in_array($index, $selectedSkus)){
                $theQuantity = $inputQuantity[$index] ?? null;
                $thePrice = $inputPrice[$index] ?? null;

                if($theQuantity && $thePrice){
                    $isBox = (int)($request -> input("product_size.$index") === '1') ? true : false;
                    $totalAmount = $theQuantity * $thePrice;

                    $newManualPurchaseOrder -> manualPurchaseOrderProducts() -> create([

                            'manual_po_id' => $manualPoId,
                            'sku_id' => $index,
                            'isBox' => $isBox,
                            'quantity' => $theQuantity,
                            'price' => $thePrice,
                            'amount' => $totalAmount,

                    ]);
                }
            }

        }

        return redirect() -> back() -> with('success', 'Manual Purchase Order has been created!');
    }

    public function update_del_status_cs_po(Request $request, CustomersPurchaseOrders $purchaseOrder) 
    {
        $del_status = $request -> input('del_status');

        $purchaseOrder -> update([

            'del_status' => $del_status,

        ]);

        $purchaseOrder -> save();

        if($del_status == 4){
             return redirect() -> back() -> with('success', 'Purchase Order has been Delivered!');
        }elseif($del_status == 8){
            return redirect() -> back() -> with('success', 'Purchase Order has been Cancelled!');
        }
       
    }

    public function view_manual_po(ManualPurchaseOrder $manualPurchase)
    {
        $totalAmount = $manualPurchase -> manualPurchaseOrderProducts() -> sum('amount');

        return view('sales.view_manual_po', ['manualPurchase' => $manualPurchase, 'totalAmount' => $totalAmount]);
    }

    public function approve_manual(ManualPurchaseOrder $manualPurchase)
    {

        $manualPo = ManualPurchaseOrder::findOrFail($manualPurchase -> id);

        $manualPo -> isApproved = 1;

        $manualPoProducts = $manualPo -> manualPurchaseOrderProducts;

        foreach($manualPoProducts as $manualPoProduct){

            $skuId = $manualPoProduct -> sku_id;

            $manualQuantity = $manualPoProduct -> quantity;

            $sku = ProductSku::findOrFail($skuId);

            $isBox = $manualPoProduct->isBox;

            if ($isBox) {
                // Adjust quantity based on the box size
                if ($sku->sku_size == 3785.41) {
                    // 1 Gallon Box = 12 individual units
                    $manualQuantity *= 4;
                } elseif ($sku->sku_size == 1000) {
                    // 1 Liter Box = 12 individual units
                    $manualQuantity *= 12;
                } else {
                    // Handle other sizes accordingly
                }
            }

            $newSkuQuantity = $sku -> sku_quantity - $manualQuantity;

            if($newSkuQuantity >= 0){

                $sku -> sku_quantity = $newSkuQuantity;

                $sku -> save();

            }else{

                $errorMessage = "Ordered quantity for SKU '{$sku -> full_name}' exceeds available stock!";

                Session::flash('error', $errorMessage);

                return view('sales.sales_home');

            }
        }

        $manualPo -> save();

        Session::flash('sucess', 'The Purchase Order has been Approved!');
        return view('sales.sales_home');
    }

    public function disapprove_manual(ManualPurchaseOrder $manualPurchase)
    {
        $manualPo = ManualPurchaseOrder::findOrFail($manualPurchase -> id);

        $manualPo -> isApproved = 2;

        $manualPo -> save();

        Session::flash('sucess', 'The Purchase Order has been Disapproved!');
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

    public function update_del_status_manual(Request $request, ManualPurchaseOrder $manualPurchase)
    {
    $manualPurchaseOrders = ManualPurchaseOrder::findOrFail($manualPurchase->id);

    $status = $request->input('del_status');

    $manualPurchaseOrders->update([
        'status' => $status,
    ]);

    if ($status == 4) {

        $manualPoTotalAmount = $manualPurchaseOrders -> manualPurchaseOrderProducts() -> sum('amount');

        $manualPurchaseOrders -> manualPurchaseOrderSales() -> create([

            'manual_order_id' => $manualPurchaseOrders -> id,
            'total_amount' => $manualPoTotalAmount,

        ]);
        
        $manualPurchaseOrders->save();

        return redirect()->back()->with('success', 'Purchase Order Has Been Completed!');

    } elseif ($status == 8) {

        foreach ($manualPurchaseOrders->manualPurchaseOrderProducts as $manualPoProduct) {

            $sku = ProductSku::findOrFail($manualPoProduct->sku_id);

            $manualQuantity = $manualPoProduct->quantity;

            $isBox = $manualPoProduct->isBox;

            if ($isBox) {
                // Adjust quantity based on the box size
                if ($sku->sku_size == 3785.41) {
                    // 1 Gallon Box = 4 individual units
                    $manualQuantity *= 4;
                } elseif ($sku->sku_size == 1000) {
                    // 1 Liter Box = 12 individual units
                    $manualQuantity *= 12;
                } else {
                    // Handle other sizes accordingly
                }
            }

            $updatedSku = ProductSku::findOrFail($manualPoProduct->sku_id);

            $updatedSku->sku_quantity += $manualQuantity;

            $updatedSku->save();
        }

        $manualPurchaseOrders->save();

        return redirect()->back()->with('success', 'Purchase Order Has Been Cancelled!');
        }
    }

    public function approve_purchase_order(Request $request, $purchaseOrder)
    {
    $approvePurchaseOrder = CustomersPurchaseOrders::findOrFail($purchaseOrder);

    $approvePurchaseOrder->status = 1;

    $approvePurchaseOrder->save();

    $customer = $approvePurchaseOrder->customers;

    foreach ($approvePurchaseOrder->productSku as $product) {
        $sku = $product->pivot->sku_id;
        $orderedQuantity = $product->pivot->quantity;

        $customerStock = $customer->customersStocks()->where('sku_id', $sku)->first();

        if ($customerStock) {
            $customerStock->quantity += $orderedQuantity;
            $customerStock->save();
        } else {
            $customer->customersStocks()->create([
                'cs_id' => $approvePurchaseOrder->cs_id,
                'sku_id' => $sku,
                'quantity' => $orderedQuantity,
            ]);
        }

        $sku = ProductSku::findOrFail($sku);
        if ($sku->sku_quantity >= $orderedQuantity) {
            $sku->sku_quantity -= $orderedQuantity;
            $sku->save();
        } else {
            
            $errorMessage = "Ordered quantity for SKU '{$sku->sku_name}' exceeds available stock!";
            return redirect()->back()->with('error', $errorMessage);
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

        return redirect() -> back() -> with('success', 'Purchase Order has been dissapproved!');

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

        $templateReceipt -> setValue('AGENT', $purchaseOrder -> agents -> agent_name);

        // $templateReceipt -> setValue('PREPARED_BY', $purchaseOrder -> prepared_by);

        // $templateReceipt -> setValue('APPROVED_BY', $purchaseOrder -> approved_by);

        // $templateReceipt -> setValue('TOTAL', $purchaseOrder -> pivot -> sum('amount'));

        $items = $purchaseOrder -> productSku;
        $itemRows = 16;

        $itemIndex = 1;

        $totalAmount = 0;

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

            $totalAmount += $item->pivot->price;

            $itemIndex++;

        }

        $templateReceipt ->  setValue("TOTAL", $totalAmount);

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

    public function manual_receipt(ManualPurchaseOrder $manualPurchase)
    {
        $templateReceiptPath = ('receipts/mpo_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        // $templateReceipt -> setValue('PTERM', $purchaseOrder -> purchaseOrderTerms -> payment_term);

        $templateReceipt -> setValue('PO', $manualPurchase -> po_number);

        $templateReceipt -> setValue('PTYPE', $manualPurchase -> purchase_type);

        $createdDate = date('Y-m-d', strtotime($manualPurchase -> created_at));

        $templateReceipt -> setValue('PO_DATE', $createdDate);

        $templateReceipt -> setvalue('FULLNAME', $manualPurchase -> customers_name);

        $templateReceipt -> setvalue('ADDRESS', $manualPurchase -> address);

        $templateReceipt -> setvalue('NUMBER', $manualPurchase -> contact_number);

        // $templateReceipt -> setvalue('PERSON', $manualPurchase -> full_name);

        // $templateReceipt -> setValue('REQUESTED_BY', $purchaseOrder -> requested_by);

        // $templateReceipt -> setValue('PREPARED_BY', $purchaseOrder -> prepared_by);

        // $templateReceipt -> setValue('APPROVED_BY', $purchaseOrder -> approved_by);

        // $templateReceipt -> setValue('TOTAL', $manualPurchase -> pivot -> sum('amount'));

        $items = $manualPurchase -> manualPurchaseOrderProducts;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("PRODUCT{$itemIndex}", $item -> productSku -> full_name);

            $templateReceipt -> setValue("VARIANT{$itemIndex}", $item -> productSku -> productVariants -> variant_name);

            $size = '';

            if ($item -> productSku -> sku_size == 1000) {
                $size = '1 Liter';
            } elseif ($item-> productSku -> sku_size == 3785.41) {
                $size = '1 Gallon';
            } else {
                // Add more conditions if needed
            }

            $templateReceipt -> setValue("SIZE{$itemIndex}", $size);

            $templateReceipt ->  setValue("QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("PRICE{$itemIndex}", $item -> price);

            $itemIndex++;

        }

        $totalAmount = $manualPurchase -> manualPurchaseOrderProducts() -> sum('amount');

        $templateReceipt -> setvalue('TOTAL', $totalAmount);

         //     //this remove the placeholder for the remaining rows in the table thats empty
         for ($i = $itemIndex; $i <= $itemRows; $i++) {
            $templateReceipt->setValue("PRODUCT{$i}", '');
            $templateReceipt->setValue("VARIANT{$i}", '');
            $templateReceipt->setValue("SIZE{$i}", '');
            $templateReceipt->setValue("QUANTITY{$i}", '');
            $templateReceipt->setValue("PRICE{$i}", '');
        }

        $savePath = public_path('P.O_' . $manualPurchase -> po_number . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);

    }

    public function agent_details(Agents $agent)
    {
        return view('sales.agent_details', ['agent' => $agent]);
    }

    public function agent_customer_details(Agents $agent, Customers $agentCustomer)
    {
        return view('sales.agent_customer_details', ['agent' => $agent, 'agentCustomer' => $agentCustomer]);
    }

    public function shopee_sales_form()
    {
        $allProducts = ProductSku::all();

        return view('sales.shopee_sales_form', ['allProducts' => $allProducts]);
    }

    public function lazada_sales_form()
    {
        $allProducts = ProductSku::all();

        return view('sales.lazada_sales_form', ['allProducts' => $allProducts]);
    }

    public function add_shopee_sales(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'full_name' => 'required',
            'customers_address' => 'required',
            // 'phone_number' => 'required',
            'charges_and_fees' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'voucher' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
        ], [
            'order_id.required' => 'Order ID is required',
            'full_name.required' => 'Customer Name is required',
            'customers_address.required' => 'Customer Address is required',
            // 'phone_number.required' => 'Phone Number is required',
            'charges_and_fees.required' => 'Please input the charges and fees total amount',
            'voucher.required' => "Please input voucher amount or put 0 if there's none",
        ]);
    
        $shopeeOrderId = $request->input('order_id');
        $shopeeCustomerName = $request->input('full_name');
        $shopeeCustomerAddress = $request->input('customers_address');
        // $shopeeCustomerNumber = $request->input('phone_number');
        $shopeeChargesAndFees = $request->input('charges_and_fees');
        $shopeeVouchers = $request->input('voucher');
        $shopeeCustomerStatus = $request->input('status');
        $shopeeCustomerChosenProducts = $request->input('selected_product', []);
        $shopeeCustomerProducts = $request->input('product_id', []);
        $shopeeProductPrice = $request->input('price', []);
        $shopeeProductQuantity = $request->input('quantity', []);
    
    
        foreach ($shopeeCustomerProducts as $index) {
            if (in_array($index, $shopeeCustomerChosenProducts)) {
                $theShopeePrice = $shopeeProductPrice[$index] ?? null;
                $theShopeeQuantity = $shopeeProductQuantity[$index] ?? null;
    
                if ($theShopeePrice && $theShopeeQuantity) {
                    $sku = ProductSku::findOrFail($index);
                    $quantityOfSku = $sku->sku_quantity;
    
                    if ($quantityOfSku < $theShopeeQuantity) {
                        $errorMessage = "Ordered quantity for SKU '{$sku->full_name}' exceeds available stock!";
                        return redirect()->back()->with('error', $errorMessage);
                    }
                }
            }
        }
    
       
        $newShopeeCustomerOrders = ShopeeOrders::create([
            'customers_name' => $shopeeCustomerName,
            'customers_address' => $shopeeCustomerAddress,
            'phone_number' => '',
            'charges_and_fees' => $shopeeChargesAndFees,
            'voucher' => $shopeeVouchers,
            'order_id' => $shopeeOrderId,
            'status' => $shopeeCustomerStatus,
            'encoded_by' => Auth::user()->name,
        ]);
    
        $shopeeId = $newShopeeCustomerOrders->id;
    
        foreach ($shopeeCustomerProducts as $index) {
            if (in_array($index, $shopeeCustomerChosenProducts)) {
                $theShopeePrice = $shopeeProductPrice[$index] ?? null;
                $theShopeeQuantity = $shopeeProductQuantity[$index] ?? null;
    
                if ($theShopeePrice && $theShopeeQuantity) {
                    $amount = $theShopeePrice * $theShopeeQuantity;
                    $sku = ProductSku::findOrFail($index);
                    $quantityOfSku = $sku->sku_quantity;
    
                    $newShopeeCustomerOrders->shopeeOrderProducts()->create([
                        'shopee_order_id' => $shopeeId,
                        'sku_id' => $index,
                        'quantity' => $theShopeeQuantity,
                        'price' => $theShopeePrice,
                        'amount' => $amount,
                    ]);
    
                    $newSkuQuantity = $quantityOfSku - $theShopeeQuantity;
                    $sku->sku_quantity = $newSkuQuantity;
                    $sku->save();
                }
            }
        }
    
        return redirect()->back()->with('success', 'Shopee sales Order(' . $shopeeOrderId . ') has been added!');
    }

    public function add_lazada_sales(Request $request)
{
    $request->validate([
        'order_number' => 'required',
        'full_name' => 'required',
        'customers_address' => 'required',
        'phone_number' => 'required',
        'charges_and_fees' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
        'voucher' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
    ], [
        'order_number.required' => 'Order Number is required',
        'full_name.required' => 'Customer Name is required',
        'customers_address.required' => 'Customer Address is required',
        'phone_number.required' => 'Phone Number is required',
        'charges_and_fees.required' => 'Please input the charges and fees total amount',
        'voucher.required' => "Please input voucher amount or put 0 if there's none",
    ]);

    $lazadaOrderId = $request->input('order_number');
    $lazadaCustomerName = $request->input('full_name');
    $lazadaCustomerAddress = $request->input('customers_address');
    $lazadaCustomerNumber = $request->input('phone_number');
    $lazadaChargesAndFees = $request->input('charges_and_fees');
    $lazadaVouchers = $request->input('voucher');
    $lazadaCustomerStatus = $request->input('status');
    $lazadaCustomerChosenProducts = $request->input('selected_product', []);
    $lazadaCustomerProducts = $request->input('product_id', []);
    $lazadaProductPrice = $request->input('price', []);
    $lazadaProductQuantity = $request->input('quantity', []);

    foreach ($lazadaCustomerProducts as $index) {
        if (in_array($index, $lazadaCustomerChosenProducts)) {
            $thelazadaPrice = $lazadaProductPrice[$index] ?? null;
            $thelazadaQuantity = $lazadaProductQuantity[$index] ?? null;

            if ($thelazadaPrice && $thelazadaQuantity) {
                $sku = ProductSku::findOrFail($index);
                $quantityOfSku = $sku->sku_quantity;

                if ($quantityOfSku < $thelazadaQuantity) {
                    $errorMessage = "Ordered quantity for SKU '{$sku->full_name}' exceeds available stock!";
                    return redirect()->back()->with('error', $errorMessage);
                }
            }
        }
    }

    $newlazadaCustomerOrders = LazadaOrders::create([
        'customers_name' => $lazadaCustomerName,
        'customers_address' => $lazadaCustomerAddress,
        'phone_number' => $lazadaCustomerNumber,
        'charges_and_fees' => $lazadaChargesAndFees,
        'voucher' => $lazadaVouchers,
        'order_number' => $lazadaOrderId,
        'status' => $lazadaCustomerStatus,
        'encoded_by' => Auth::user()->name,
    ]);

    $lazadaId = $newlazadaCustomerOrders->id;

    foreach ($lazadaCustomerProducts as $index) {
        if (in_array($index, $lazadaCustomerChosenProducts)) {
            $thelazadaPrice = $lazadaProductPrice[$index] ?? null;
            $thelazadaQuantity = $lazadaProductQuantity[$index] ?? null;

            if ($thelazadaPrice && $thelazadaQuantity) {
                $amount = $thelazadaPrice * $thelazadaQuantity;
                $sku = ProductSku::findOrFail($index);
                $quantityOfSku = $sku->sku_quantity;

                $newlazadaCustomerOrders->lazadaOrderProducts()->create([
                    'lazada_order_id' => $lazadaId,
                    'sku_id' => $index,
                    'quantity' => $thelazadaQuantity,
                    'price' => $thelazadaPrice,
                    'amount' => $amount,
                ]);

                $newSkuQuantity = $quantityOfSku - $thelazadaQuantity;

                if ($quantityOfSku > $thelazadaQuantity) {
                    $sku->sku_quantity = $newSkuQuantity;
                    $sku->save();
                } else {
                    $errorMessage = "Ordered quantity for SKU '{$sku->full_name}' exceeds available stock!";
                    return redirect()->back()->with('error', $errorMessage);
                }
            }
        }
    }

    return redirect()->back()->with('success', 'Lazada sales Order(' . $lazadaOrderId . ') has been added!');
}

    public function shopee_order_details(ShopeeOrders $shopeeSale)
    {

        $orderTotalAmount = $shopeeSale -> shopeeOrderProducts() -> sum('amount');

        return view('sales.shopee_order_details', ['shopeeSale' => $shopeeSale, 'orderTotalAmount' => $orderTotalAmount]);
    }

    public function lazada_order_details(LazadaOrders $lazadaSale)
    {
        $orderTotalAmount = $lazadaSale -> lazadaOrderProducts() -> sum('amount');

        return view('sales.lazada_order_details', ['lazadaSale' => $lazadaSale, 'orderTotalAmount' => $orderTotalAmount]);
    }

    public function delivered_shopee_status(Request $request, ShopeeOrders $shopeeSale)
    {
        $shopeeOrders = ShopeeOrders::findOrFail($shopeeSale -> id);

        $status = $request -> input('status');

        $shopeeOrders -> update([
            'status' => $status,
        ]);

        if($status == 4){

            $shopeeChargeAndFees = $shopeeOrders -> charges_and_fees;

            $shopeeVoucher = $shopeeOrders -> voucher;

            $totalShopeeDeduction = $shopeeChargeAndFees + $shopeeVoucher;

            $shopeeOrderTotalAmount = $shopeeOrders -> shopeeOrderProducts() -> sum('amount');

            $realTotalAmount = $shopeeOrderTotalAmount - $totalShopeeDeduction;

            $shopeeOrders -> shopeeSales() -> create([
                
                'shopee_order_id' => $shopeeOrders -> id,
                'total_amount' => $realTotalAmount,
    
            ]);

        $shopeeOrders -> save();
        
            return redirect() -> back() -> with('success', 'Shopee Order Has Been Completed!');

        }else{
            
            foreach($shopeeOrders -> shopeeOrderProducts as $shopeeProduct){

                $sku = ProductSku::findOrFail($shopeeProduct -> sku_id);

                    $sku -> sku_quantity += $shopeeProduct -> quantity;

                    $sku -> save();
            }
            return redirect() -> back() -> with('success', 'Shopee Order Has Been Cancelled!');
        }
    }

    public function delivered_lazada_status(Request $request, LazadaOrders $lazadaSale)
    {
        $lazadaOrders = LazadaOrders::findOrFail($lazadaSale -> id);

        $status = $request -> input('status');

        $lazadaOrders -> update([
            'status' => $status,
        ]);

        if($status == 4){

            $lazadaChargeAndFees = $lazadaOrders -> charges_and_fees;

            $lazadaVoucher = $lazadaOrders -> voucher;

            $totalLazadaDeduction = $lazadaChargeAndFees + $lazadaVoucher;

            $lazadaOrderTotalAmount = $lazadaOrders -> lazadaOrderProducts() -> sum('amount');

            $realTotalAmount = $lazadaOrderTotalAmount - $totalLazadaDeduction;

            $lazadaOrders -> lazadaSales() -> create([
                'lazada_order_id' => $lazadaOrders -> id,
                'total_amount' => $realTotalAmount,
    
            ]);
        
            $lazadaOrders -> save();
        
            return redirect() -> back() -> with('success', 'Purchase Order Has Been Completed!');

        }else{

            foreach($lazadaOrders -> lazadaOrderProducts as $lazadaProduct){

                $sku = ProductSku::findOrFail($lazadaProduct -> sku_id);

                    $sku -> sku_quantity += $lazadaProduct -> quantity;

                    $sku -> save();

            }

            return redirect() -> back() -> with('success', 'Purchase Order Has Been Cancelled!');
        }
        
    }

    public function tiktok_sales_form()
    {
        $allProducts = ProductSku::all();

        return view('sales.tiktok_sales_form', ['allProducts' => $allProducts]);
    }

    public function carousel_sales_form()
    {
        $allProducts = ProductSku::all();

        return view('sales.carousel_sales_form', ['allProducts' => $allProducts]);
    }

    public function add_tiktok_sales(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'full_name' => 'required',
            'customers_address' => 'required',
            'phone_number' => 'required',
            'charges_and_fees' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'voucher' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
        ], [
            'order_id.required' => 'Order ID is required',
            'full_name.required' => 'Customer Name is required',
            'customers_address.required' => 'Customer Address is required',
            'phone_number.required' => 'Phone Number is required',
            'charges_and_fees.required' => 'Please input the charges and fees total amount',
            'voucher.required' => "Please input voucher amount or put 0 if there's none",
        ]);
    
        $tiktokOrderId = $request->input('order_id');
        $tiktokCustomerName = $request->input('full_name');
        $tiktokCustomerAddress = $request->input('customers_address');
        $tiktokCustomerNumber = $request->input('phone_number');
        $tiktokChargesAndFees = $request->input('charges_and_fees');
        $tiktokVouchers = $request->input('voucher');
        $tiktokCustomerStatus = $request->input('status');
        $tiktokCustomerChosenProducts = $request->input('selected_product', []);
        $tiktokCustomerProducts = $request->input('product_id', []);
        $tiktokProductPrice = $request->input('price', []);
        $tiktokProductQuantity = $request->input('quantity', []);
    
    
        foreach ($tiktokCustomerProducts as $index) {
            if (in_array($index, $tiktokCustomerChosenProducts)) {
                $theTiktokPrice = $tiktokProductPrice[$index] ?? null;
                $theTiktokQuantity = $tiktokProductQuantity[$index] ?? null;
    
                if ($theTiktokPrice && $theTiktokQuantity) {
                    $sku = ProductSku::findOrFail($index);
                    $quantityOfSku = $sku->sku_quantity;
    
                    if ($quantityOfSku < $theTiktokQuantity) {
                        $errorMessage = "Ordered quantity for SKU '{$sku->full_name}' exceeds available stock!";
                        return redirect()->back()->with('error', $errorMessage);
                    }
                }
            }
        }
    
       
        $newTiktokCustomerOrders = TiktokOrders::create([
            'customers_name' => $tiktokCustomerName,
            'customers_address' => $tiktokCustomerAddress,
            'phone_number' => $tiktokCustomerNumber,
            'charges_and_fees' => $tiktokChargesAndFees,
            'voucher' => $tiktokVouchers,
            'order_id' => $tiktokOrderId,
            'status' => $tiktokCustomerStatus,
            'encoded_by' => Auth::user()->name,
        ]);
    
        $tiktokId = $newTiktokCustomerOrders->id;
    
        foreach ($tiktokCustomerProducts as $index) {
            if (in_array($index, $tiktokCustomerChosenProducts)) {
                $theTiktokPrice = $tiktokProductPrice[$index] ?? null;
                $theTiktokQuantity = $tiktokProductQuantity[$index] ?? null;
    
                if ($theTiktokPrice && $theTiktokQuantity) {
                    $amount = $theTiktokPrice * $theTiktokQuantity;
                    $sku = ProductSku::findOrFail($index);
                    $quantityOfSku = $sku->sku_quantity;
    
                    $newTiktokCustomerOrders->tiktokOrderProducts()->create([
                        'tiktok_order_id' => $tiktokId,
                        'sku_id' => $index,
                        'quantity' => $theTiktokQuantity,
                        'price' => $theTiktokPrice,
                        'amount' => $amount,
                    ]);
    
                    $newSkuQuantity = $quantityOfSku - $theTiktokQuantity;
                    $sku->sku_quantity = $newSkuQuantity;
                    $sku->save();
                }
            }
        }
    
        return redirect()->back()->with('success', 'Tiktok sales Order(' . $tiktokOrderId . ') has been added!');
    }

    public function tiktok_order_details(TiktokOrders $tiktokSale)
    {
        $orderTotalAmount = $tiktokSale -> tiktokOrderProducts() -> sum('amount');

        return view('sales.tiktok_order_details', ['tiktokSale' => $tiktokSale, 'orderTotalAmount' => $orderTotalAmount]);
    }

    public function delivered_tiktok_status(Request $request, TiktokOrders $tiktokSale)
    {
        $tiktokOrders = TiktokOrders::findOrFail($tiktokSale -> id);

        $status = $request -> input('status');

        $tiktokOrders -> update([

            'status' => $status,

        ]);

        if($status == 4){

            $tiktokChargesAndFees = $tiktokOrders -> charges_and_fees;

            $tiktokVoucher = $tiktokOrders -> voucher;

            $totalTiktokDeduction = $tiktokChargesAndFees + $tiktokVoucher;

            $tiktokOrderTotalAmount = $tiktokOrders -> tiktokOrderProducts() -> sum('amount');

            $realTotalAmount = $tiktokOrderTotalAmount - $totalTiktokDeduction;

            $tiktokOrders -> tiktokSales() -> create([

                'tiktok_order_id' => $tiktokOrders -> id,
                'total_amount' => $realTotalAmount,

            ]);

            $tiktokOrders -> save();

            return redirect() -> back() -> with('success', 'Tiktok Order has been Completed!');
    
        }else {
            foreach($tiktokOrders -> tiktokOrderProducts as $tiktokProduct){

                $sku = ProductSku::findOrFail($tiktokProduct -> sku_id);

                $sku -> sku_quantity += $tiktokProduct -> quantity;

                $sku -> save();
            }

            return redirect() -> back() -> with('success', 'Tiktok Order has been Cancelled!');
        }

    }

    public function ecommerce_order_complete(EcomCustomerOrders $ecommerceOrder)
    {
        $theOrder = EcomCustomerOrders::findOrFail($ecommerceOrder -> id);

        $totalAmount = 0;

        foreach($theOrder -> ecomCustomerOrderItems as $orderItems){

            $price = $orderItems -> price;

            $quantity = $orderItems -> quantity;

            $total = $price * $quantity;

            $totalAmount += $total;

            $sku = ProductSku::findOrFail($orderItems -> sku_id);

            $sku -> sku_quantity -= $orderItems ->  quantity;

            $sku -> save();

        }
              
        $theOrder -> update([
            'status' => 4,
        ]);

        $theOrder -> ecomOrderSales() -> create([
            'order_id' => $theOrder -> id,
            'total_amount' => $totalAmount,
        ]);

        $theOrder -> save();

        return redirect() -> back();
    }

    public function ecommerce_order_cancel(EcomCustomerOrders $ecommerceOrder)
    {
        $theOrder = EcomCustomerOrders::findOrFail($ecommerceOrder -> id);

        $theOrder -> update([
            'status' => 8,
        ]);

        $theOrder -> save();

        return redirect() -> back();
    }
    
    public function update_order_details(EcomCustomerOrders $ecommerceOrder)
    {
        // $updatedOrder = EcomCustomerOrders::findOrFail($ecommerceOrder -> id);
       return view('sales.ecommerce_update_order_details', ['ecommerceOrder' => $ecommerceOrder]);
    }

    public function order_details_update(Request $request, EcomCustomerOrders $ecommerceOrder)
    {
        $updateOrder = EcomCustomerOrders::findOrFail($ecommerceOrder -> id);

        $refNumber = $request -> input('ref_number');

        $updateOrder -> update([

            'status' => 9,

        ]);

        $updateOrder -> ecomCustomerPaymentTransactions() -> update([

            'ref_number' => $refNumber,

        ]);

        $updateOrder -> save();


        return redirect() -> route('ecommerceorderview', ['ecommerceOrder' => $ecommerceOrder]);
    }

}
