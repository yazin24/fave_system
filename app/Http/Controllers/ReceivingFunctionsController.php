<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\ManualPurchaseOrder;
use App\Models\ManufacturingStorage;
use App\Models\ProductSku;
use App\Models\ProductVariants;
use App\Models\PullOutItems;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReceivingFunctionsController extends Controller
{
    public function product_input()
    {
        $allVariants = ProductVariants::all();

        return view('receiving.product_input', ['allVariants' => $allVariants]);
    }

    public function update_stock(ProductSku $allProduct)
    {
        return view('receiving.update_product_stock', ['allProduct' => $allProduct]);
    }

    public function view_product_logs(ProductSku $allProduct)
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
            // Check the box size and convert the quantity accordingly
            if ($allProduct->sku_size == 3785.41) {
                // 1 Gallon Box = 12 individual units
                $quantity *= 4;
            } elseif ($allProduct->sku_size == 1000) {
                // 1 Liter Box = 4 individual units
                $quantity *= 12;
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

    return view('receiving.view_product_logs', ['allProduct' => $allProduct, 'productLogs' => $productLogs]);
}

    public function add_stock(Request $request, $allProduct)
    {
        $request -> validate([
            'quantity' => 'required|numeric',
        ],[
            'quantity.required' => 'Quantity must be number',
        ]);

        $theStock = ProductSku::findOrFail($allProduct);

        $quantityToAdd = $request -> input('quantity');

        $totalQuantity = $theStock -> sku_quantity + $quantityToAdd;

        $theStock -> update(['sku_quantity' => $totalQuantity]);

        return redirect()->back()->with('success', 'Stock added successfully.');

    }

    public function add_product_sku(Request $request)
    {
        $request->validate([
            'variant_name' => 'required|numeric',
            'barcode' => 'required',
            'full_name' => 'required',
            'sku_size' => 'required|in:180,900,1000,3785.41',
            'sku_quantity' => 'numeric',
        ], [
            'variant_name.required' => 'Variant is required.',
            'barcode.required' => 'Barcode is required.',
            'full_name.required' => 'Full name is required.',
            'sku_size.required' => 'SKU size is required.',
            'sku_quantity.numeric' => 'SKU quantity must be numbers.',
        ]);

        $newProductSku = ProductSku::create([
            'variant_id' => $request -> variant_name,
            'barcode' => $request -> barcode,
            'full_name' => $request -> full_name,
            'sku_size' => $request -> sku_size,
            'sku_quantity' => $request -> sku_quantity,
        ]);

        $newProductSku -> manufacturingStorage() -> create([

            'sku_id' => $newProductSku -> id,
            'quantity' => 0,

        ]);

        return redirect() -> back() -> with('success', 'Product Sku has been added!');
    }

    public function view_to_be_receive_po(PurchaseOrder $toReceivePurchaseOrder)
    {
        $totalAmount = $toReceivePurchaseOrder -> purchaseOrderItems -> sum('amount');

        return view('receiving.view_receive', ['toReceivePurchaseOrder' => $toReceivePurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function save_and_receive_po(Request $request, $id)
    {

        // $request -> validate([

        // ]);
        
        $toReceivePurchaseOrder = PurchaseOrder::findOrFail($id);

        if ($request->has('action')) {

            $action = $request->input('action');

            if ($action === 'complete' || $action === 'partial') {
              
                // $toReceivePurchaseOrder->update(['del_status' => 4]);

                if($action === 'complete') {
                    $toReceivePurchaseOrder -> update(['del_status' => 4]);
                }elseif($action === 'partial') {
                    $toReceivePurchaseOrder -> update(['del_status' => 6]);
                }

                foreach ($toReceivePurchaseOrder->purchaseOrderItems as $item) {

                    $quantityReceived = $request->input('quantity.' . $item->id, 0);

                    // dd($item -> item_id);
                    
                    $item-> receivedItems() ->create([

                        'po_id' => $toReceivePurchaseOrder -> id,

                        'item_id' => $item -> item_id,

                        'quantity_received' => $quantityReceived,

                        'received_at' => now(), 

                    ]);

                    $quantityCountReceived = $item -> receivedItems -> sum('quantity_received');
    
                    $allItem = AllItems::where('id', $item -> item_id) -> first();

                    if($allItem){
                        $allItem -> update(['quantity' => $quantityCountReceived]);
                    }else {
                        AllItems::create([
                            'id' => $item -> item_id,
                            'quantity' => $quantityCountReceived,
                        ]);
                    }

                }

            }
        }
        

        if($toReceivePurchaseOrder -> del_status == 4){

            return view('receiving.receiving_home') -> with('success', 'Purchase Order has been Delivered!');

        }elseif($toReceivePurchaseOrder -> del_status == 6) {

            return view('receiving.receiving_home') -> with('success', 'Purchase Order has been received as partial!');
        }
        
    }

    public function view_received(PurchaseOrder $receivedPurchaseOrder)
    {
        $totalAmount = $receivedPurchaseOrder -> purchaseOrderItems() -> sum('amount');

        return view('receiving.view_received', ['receivedPurchaseOrder' => $receivedPurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function pull_out_details(PullOutItemsCredentials $pullOut)
    {
        return view('receiving.pull_out_details', ['pullOut' => $pullOut]);
    }
   
    public function pull_out_items(Request $request)
    {
        $request -> validate([
            'prepared_by' => 'required',
            'requested_by' => 'required',
            'approved_by' => 'required',
        ],[
            'prepared_by.required' => 'Please put name in Prepared By',
            'requested_by.required' => 'Please put name in Requested By',
            'approved_by.required' => 'Please put name in Approved By',
        ]);

        $lastPullOut = PullOutItemsCredentials::latest('id') -> first();

        $lastPullOutNumber = $lastPullOut ? $lastPullOut -> pull_out_number : null;

        $prefix = '00';
        $poLength = 5;

        $counter = 0;
        if($lastPullOutNumber){
            $lastCounter = (int)substr($lastPullOutNumber, strlen($prefix));
            $counter = $lastCounter + 1;
        }

        
        $poPart = str_pad($counter, $poLength, '0', STR_PAD_LEFT);

        $realPullOutNumber = $prefix . $poPart;
       
        $newPullOutOrderCredentials = PullOutItemsCredentials::create([
            'pull_out_number' => $realPullOutNumber,
            'prepared_by' => $request -> prepared_by,
            'requested_by' => $request -> requested_by,
            'approved_by' => $request -> approved_by,
        ]);

        $pullOutItemNames = $request -> item_name;

        $pullOutItemsQuantities = $request -> quantity;

        foreach($pullOutItemNames as $index => $pullOutItemName){

            $item = AllItems::where('item_name', $pullOutItemName) -> first();

            if($item) {
                $newPullOutOrder = PullOutItems::create([
                    'pull_out_id' => $newPullOutOrderCredentials -> id,
                    'item_id' => $item -> id,
                    'item_unit' => $item -> item_unit,
                    'quantity' => $pullOutItemsQuantities[$index],
                    'price' => $item -> default_price,
                ]);

                $newPullOutOrder -> save();

                $newQuantity = $item -> quantity - $pullOutItemsQuantities[$index];

                $item -> update(['quantity' => $newQuantity]);
            }

        }

        return view('receiving.receiving_home') -> with('success', 'Pull Out Success!');
    }

    public function storage_sku_details(ManufacturingStorage $storageSku)
    {
        // $storageSku = ManufacturingStorage::findOrFail($storageSku -> id);

        return view('receiving.sku_storage_details', ['storageSku' => $storageSku]);
    }

    public function storage_output_form(ManufacturingStorage $storageSku)
    {
        return view('receiving.storage_output_form', ['storageSku' => $storageSku]);
    }

    public function storage_sku_log(ManufacturingStorage $storageSku)
    {
        // $storage = ManufacturingStorage::all();

        // $skuStorageLog = $storageSku -> storageLogHistory() -> where('sku_storage_id', $storageSku -> id) -> get();

        return view('receiving.storage_sku_log', ['storageSku' => $storageSku]);
    }
  
    public function storage_sku_update(Request $request, ManufacturingStorage $storageSku)
    {   
        $skuStorage = ManufacturingStorage::findOrFail($storageSku -> id);

        $skuStorageQuantity = $skuStorage -> quantity;

        $request -> validate([
            'action' => 'string|required',
            'quantity' => 'numeric|required',
        ],[
            'action.required' => 'Choosing Action is needed to proceed',
            'quantity.required' => 'Quantity must be number'
        ]);

        $action = $request -> input('action');

        $quantity = $request -> input('quantity');

        if($action === 'Add'){
            $theQuantity = $skuStorageQuantity + $quantity;

            $skuStorage  -> update([
                'quantity' => $theQuantity,
            ]);

            $skuStorage -> storageLogHistory() -> create([
                'sku_storage_id' => $skuStorage -> id,
                'quantity' => $quantity,
                'action' => $action,
            ]);
        }elseif($action === 'Subtract') {
            $theQuantity = $skuStorageQuantity - $quantity;

            $skuStorage  -> update([
                'quantity' => $theQuantity,
            ]);

            $skuStorage -> storageLogHistory() -> create([
                'sku_storage_id' => $skuStorage -> id,
                'quantity' => $quantity,
                'action' => $action,
            ]);
        }

        $skuStorage -> save();

        Session::flash('success', 'Sku Storage Quantity Has Been Updated Successfully!');
        return view('receiving.receiving_home');
    }

    public function raw_materials_view_details(AllItems $rawMaterial)
    {
        $rawMaterialsTransactions = [];

        // $purchaseOrderDetails = $rawMaterial -> purchaseOrderItems()
        //     -> select('created_at', 'quantity')
        //     -> get();

        // foreach($purchaseOrderDetails as $purchaseOrder){
        //     $rawMaterialsTransactions[] = [
        //         'date' => $purchaseOrder -> created_at,
        //         'action' => 'Purchasing',
        //         'quantity' => $purchaseOrder -> quantity,
        //     ];
        // }

        $pullOutDetails = $rawMaterial -> pullOutItems()
            -> select('created_at', 'quantity')
            -> get();

        foreach($pullOutDetails as $pullOut){
            $rawMaterialsTransactions[] = [
                'date' => $pullOut -> created_at,
                'action' => 'Pull-Out',
                'quantity' => $pullOut -> quantity,
            ];
        }

        $receivingDetails = $rawMaterial -> receivedItems()
            -> select('created_at', 'quantity_received')
            -> get();

        foreach($receivingDetails as $receiving){
            $rawMaterialsTransactions[] = [
                'date' => $receiving -> created_at,
                'action' => 'Receiving',
                'quantity' => $receiving -> quantity_received,
            ];
        }

        usort($rawMaterialsTransactions, function ($a, $b) {
            return $b['date'] <=> $a['date'];
        });
    
        $perPage = 14;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($rawMaterialsTransactions, ($currentPage - 1) * $perPage, $perPage);
        $rawMaterialsTransactions = new LengthAwarePaginator($currentItems, count($rawMaterialsTransactions), $perPage);
        $rawMaterialsTransactions -> setPath(route('rawmaterialsviewdetails', ['rawMaterial' => $rawMaterial->id]));

        return view('receiving.raw_materials_details', ['rawMaterial' => $rawMaterial, 'rawMaterialsTransactions' => $rawMaterialsTransactions]);
    }

}

