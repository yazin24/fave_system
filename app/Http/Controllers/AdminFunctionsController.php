<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\EcomCustomerOrders;
use App\Models\EcomCustomers;
use App\Models\ProductSku;
use App\Models\ProductVariants;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
use App\Models\ShopeeOrders;
use App\Models\ShopeeSales;
// use App\Models\ReceivedPurchaseOrder;
// use App\Models\ReceivedPurchaseOrderDetails;
use App\Models\SupplierCreditLimit;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

class AdminFunctionsController extends Controller
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

        return view('admin.admin_ecommerce_dashboard', ['ecommerceOrders' => $ecommerceOrders]);
        
    }

    public function admin_ecommerce_order_view(EcomCustomerOrders $ecommerceOrder)
    {
        return view('admin.admin_ecommerce_order_details', ['ecommerceOrder' => $ecommerceOrder]);
    }

    public function admin_ecommerce_order_complete(EcomCustomerOrders $ecommerceOrder)
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

    public function admin_ecommerce_order_cancel(EcomCustomerOrders $ecommerceOrder)
    {
        $theOrder = EcomCustomerOrders::findOrFail($ecommerceOrder -> id);

        $theOrder -> update([
            'status' => 8,
        ]);

        $theOrder -> save();

        return redirect() -> back();
    }

    public function admin_ecommerce_customers()
    {
        $allEcomCustomers = EcomCustomers::paginate(10);

        return view('admin.admin_ecommerce_customer_list', ['allEcomCustomers' => $allEcomCustomers]);
    }

    public function admin_ecommerce_customers_details(EcomCustomers $customer)
    {
        return view('admin.admin_ecommerce_customers_details', ['customer' => $customer]);
    }
    

    public function admin_purchase_order_delete(Request $request, $id)
    {
        $allPurchaseOrder = PurchaseOrder::findOrFail($id);

        $allPurchaseOrder -> delete();

        return redirect(route('adminpurchasingmonitoring')) -> with('success', 'Purchase Order has been deleted successfully!');
    }

    public function admin_search(Request $request)
    {
        $search = $request->input('search');

        $allPurchaseOrders = PurchaseOrder::query()
                            -> where('po_number', 'LIKE', '%' . $search . '%')
                            ->paginate(10);

                            return view('admin.admin_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
            // ->where('po_number', 'LIKE', "%$search%")
            // ->orWhereHas('purchaseOrderCredentials', function ($query) use ($search) {
            //     $query->where('requested_by', 'LIKE', "%$search%");
            // })  
            // ->orWhereHas('created_at', function ($query) use ($search) {
            //     $query->where('created_at', 'LIKE', "%$search%");
            // })
            // ->paginate(20);

            // return view('admin.admin_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
    }

    public function admin_view_purchase(PurchaseOrder $allPurchaseOrder) 
    {
        $totalAmount = $allPurchaseOrder -> purchaseOrderItems -> sum('amount');

        return view('admin.admin_view_purchase', ['allPurchaseOrder' => $allPurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function admin_show_suppliers_items(Request $request)
    {
        $supplierName = $request -> input('selected_id');

        $suppliers = Suppliers::all();

        $supplierItems = SupplierItems::with('suppliers')
                        -> where('supplier_id', $supplierName)
                        ->get();

        return view('admin.admin_supplier_list', ['supplierItems' => $supplierItems, 'suppliers' => $suppliers]);
    }

    public function admin_purchase_order_approval(PurchaseOrder $queuePurchase)
    {
        $totalAmount = $queuePurchase -> purchaseOrderItems -> sum('amount');

        return view('admin.admin_purchase_approval_view', ['totalAmount' => $totalAmount, 'queuePurchase' => $queuePurchase]);
        
    }

    public function admin_approve_purchase($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

            $userName = Auth::user() -> name;

            $purchaseOrder-> status = 1;

            $purchaseOrder -> approved_by = $userName;

            $itemTotalAmount = $purchaseOrder -> total_amount = $purchaseOrder -> purchaseOrderItems -> sum('amount');

            $delCharge = $purchaseOrder -> del_charge;

            $totalAmount = $itemTotalAmount + $delCharge;

            $purchaseOrder -> total_amount = $totalAmount;
            
            $purchaseOrder -> save();

            return redirect() -> route('adminpurchaseapproval') -> with('success', 'Purchase Order has been approved!');
        
    }

    public function admin_disapprove_purchase(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

            $purchaseOrder -> status = 2;

            $poAmount = $request -> input('poAmount');

            $supplierName = $purchaseOrder -> purchaseOrderSupplier -> supplier -> supplier_name;

            $supplierCreditLimit = SupplierCreditLimit::whereHas('suppliers', function($query) use ($supplierName){

                $query -> where('supplier_name', $supplierName);

            }) -> first();

            if($supplierCreditLimit) {
                
                $currentCreditLimit = (float) $supplierCreditLimit -> available_credit_limit;

                $newCreditLimit = $currentCreditLimit + (float) $poAmount;

                $supplierCreditLimit -> update(['available_credit_limit' => 

                $newCreditLimit]);
            }

            $purchaseOrder -> save();

            Session::flash('success', 'Purchase Order has been disapproved!');

            return view('admin.admin_home');

    }

    
    public function admin_generate_po_receipt(PurchaseOrder $allPurchaseOrder)
    {
        $templateReceiptPath = ('receipts/po_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        $templateReceipt -> setValue('PTERM', $allPurchaseOrder -> purchaseOrderTerms -> payment_term);

        $templateReceipt -> setValue('PO', $allPurchaseOrder -> po_number);

        $dateCreated = date('Y-m-d', strtotime($allPurchaseOrder -> created_at));

        $templateReceipt -> setValue('PO_DATE', $dateCreated);

        $templateReceipt -> setvalue('SUPPLIER', $allPurchaseOrder -> purchaseOrderSupplier -> supplier -> supplier_name);

        $templateReceipt -> setvalue('SUPPLIER_ADDRESS', $allPurchaseOrder -> purchaseOrderSupplier -> supplier -> supplier_address);

        $templateReceipt -> setvalue('SUPPLIER_NUMBER', $allPurchaseOrder -> purchaseOrderSupplier -> supplier -> contact_number);

        $templateReceipt -> setvalue('SUPPLIER_PERSON', $allPurchaseOrder -> purchaseOrderSupplier -> supplier -> contact_person);

        $templateReceipt -> setValue('REQUESTED_BY', $allPurchaseOrder -> requested_by);

        $templateReceipt -> setValue('PREPARED_BY', $allPurchaseOrder -> prepared_by);

        $templateReceipt -> setValue('APPROVED_BY', $allPurchaseOrder -> approved_by);

        $templateReceipt -> setValue('PO_AMOUNT', $allPurchaseOrder -> purchaseOrderItems -> sum('amount'));

        $templateReceipt -> setValue('DEL_CHARGE', $allPurchaseOrder -> del_charge);

        // $delCharge = $allPurchaseOrder -> del_charge;

        // $itemAmount = $allPurchaseOrder -> purchaseOrderItems -> sum('amount');

        // $totalAmount = $delCharge + $itemAmount;

        $templateReceipt -> setValue('TOTAL', $allPurchaseOrder -> total_amount);

        $items = $allPurchaseOrder -> purchaseOrderItems;

        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("ITEM_QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("UNIT{$itemIndex}", $item -> allItems -> item_unit);

            $templateReceipt -> setValue("ITEM_NAME{$itemIndex}", $item -> allItems -> item_name);

            $templateReceipt ->  setValue("UNIT_PRICE{$itemIndex}",  '₱'.$item -> unit_price);

            $templateReceipt -> setValue("AMOUNT{$itemIndex}", '₱'.$item -> amount);

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

        $savePath = public_path('P.O_' . $allPurchaseOrder -> po_number . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);

    }

    public function admin_input_products()
    {
        $allVariants = ProductVariants::all();

        return view('admin.admin_input_products', ['allVariants' => $allVariants]);
    }

    public function admin_add_products(Request $request)
    {
        $newProductSku = ProductSku::create([
            'variant_id' => $request -> variant_name,
            'barcode' => $request -> barcode,
            'sku_name' => $request -> sku_name,
            'sku_size' => $request -> sku_size,
            'sku_quantity' => $request -> sku_quantity,
        ]);

        Session::flash('success', 'Product has been added!');
        return view('admin.admin_home');
    }

    public function admin_view_product_logs(ProductSku $allProduct)
    {
    $productLogs = [];

    // Retrieve Shopee order transaction details
    $shopeeOrderDetails = $allProduct->shopeeOrderProducts()
        ->select('created_at', 'quantity')
        ->get();

    foreach ($shopeeOrderDetails as $shopeeOrder) {
        $productLogs[] = [
            'date' => $shopeeOrder->created_at,
            'action' => 'Shopee Order',
            'quantity' => -$shopeeOrder->quantity, // Deduction
        ];
    }

    // Retrieve Lazada order transaction details
    $lazadaOrderDetails = $allProduct->lazadaOrderProducts()
        ->select('created_at', 'quantity')
        ->get();

    foreach ($lazadaOrderDetails as $lazadaOrder) {
        $productLogs[] = [
            'date' => $lazadaOrder->created_at,
            'action' => 'Lazada Order',
            'quantity' => -$lazadaOrder->quantity, // Deduction
        ];
    }

    // Retrieve manual purchase order transaction details
    $manualPurchaseOrderDetails = $allProduct->manualPurchaseOrderProducts()
        ->select('created_at', 'quantity', 'isBox')
        ->get();

    foreach ($manualPurchaseOrderDetails as $manualPurchaseOrder) {
        $quantity = $manualPurchaseOrder->quantity;

        if ($manualPurchaseOrder->isBox == 1) {
            
            if ($allProduct->sku_size == 3785.41) {
                $quantity *= 4;

            } elseif ($allProduct->sku_size == 1000) {
                $quantity *= 12;

            }elseif ($allProduct->sku_size == 900) { 
                $quantity *= 40;

            }elseif ($allProduct->sku_size == 180) {   
                $quantity *= 40;
            }
            
        }
        $productLogs[] = [
            'date' => $manualPurchaseOrder->created_at,
            'action' => 'Manual Purchase',
            'quantity' => $quantity,
        ];
    }

    // Sort the productLogs by date in descending order
    usort($productLogs, function ($a, $b) {
        return $b['date'] <=> $a['date'];
    });

    $perPage = 10; // Set the number of items per page
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = array_slice($productLogs, ($currentPage - 1) * $perPage, $perPage);
    $productLogs = new LengthAwarePaginator($currentItems, count($productLogs), $perPage);
    $productLogs->setPath(route('viewproductlogs', ['allProduct' => $allProduct->id]));

    return view('admin.admin_view_product_logs', ['allProduct' => $allProduct, 'productLogs' => $productLogs]);
}

    public function admin_supplier_details(Suppliers $supplier)
    {
        return view('admin.admin_supplier_details', ['supplier' => $supplier]);
    }

    public function admin_delete_unpurchase($id)
    {
        $unPurchaseOrder = PurchaseOrder::findOrFail($id);

        $unPurchaseOrder -> delete();

        return view('admin.admin_home') -> with('success', 'Unpurchase Order has been deleted!');
    }

    public function view_stock_history(AllItems $stock)
    {
         
    $transactionDetails = [];

    // $purchaseOrderDetails = $stock->purchaseOrderItems()
    //     ->select('created_at', 'quantity')
    //     ->get();
    
    // foreach ($purchaseOrderDetails as $purchaseOrder) {
    //     $transactionDetails[] = [
    //         'DATE' => $purchaseOrder->created_at,
    //         'ACTION' => 'Purchasing',
    //         'QUANTITY' => $purchaseOrder->quantity,
    //     ];
    // }

    $pulloutDetails = $stock->pullOutItems()
        ->select('created_at', 'quantity')
        ->get();

    foreach ($pulloutDetails as $pullout) {
        $transactionDetails[] = [
            'DATE' => $pullout->created_at,
            'ACTION' => 'Subracted',
            'QUANTITY' => $pullout->quantity,
        ];
    }

    
    $receivingDetails = $stock->receivedItems()
        ->select('created_at', 'quantity_received')
        ->get();

    foreach ($receivingDetails as $receiving) {
        $transactionDetails[] = [
            'DATE' => $receiving->created_at,
            'ACTION' => 'Added',
            'QUANTITY' => $receiving->quantity_received,
        ];
    }

    
    usort($transactionDetails, function ($a, $b) {
        return $b['DATE'] <=> $a['DATE'];
    });

    $perPage = 14;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = array_slice($transactionDetails, ($currentPage - 1) * $perPage, $perPage);
    $transactionDetails = new LengthAwarePaginator($currentItems, count($transactionDetails), $perPage);
    $transactionDetails->setPath(route('viewstockhistory', ['stock' => $stock->id]));

        return view('admin.admin_view_stock_history', ['stock' => $stock, 'transactionDetails' => $transactionDetails,]);
    }

    public function admin_pull_out_items(PullOutItemsCredentials $pullOutItem)
    {

        return view('admin.admin_pull_out_items', ['pullOutItem' => $pullOutItem]);
    }
    
    public function shopee_sales_view_report()
    {
      
        return view('admin.admin_shopee_sales_view_report');
    }

    public function generate_shopee_sales_report(Request $request)
    {
        $dateStart = $request->input('start_date');
        $dateEnd = $request->input('end_date');
    
        // Query for records within or on the edge of the date range
        $allShopeeOrders = ShopeeSales::whereDate('created_at', '>=', $dateStart)
            ->whereDate('created_at', '<=', $dateEnd)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('admin.admin_shopee_sales_view_report', ['allShopeeOrders' => $allShopeeOrders]);
    }
}
