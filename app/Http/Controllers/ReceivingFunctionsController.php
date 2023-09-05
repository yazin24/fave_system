<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\ProductSku;
use App\Models\ProductVariants;
use App\Models\PullOutItems;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
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

    public function add_stock(Request $request, $allProduct)
    {
        $theStock = ProductSku::findOrFail($allProduct);

        $quantityToAdd = $request -> input('quantity');

        $totalQuantity = $theStock -> sku_quantity + $quantityToAdd;

        $theStock -> update(['sku_quantity' => $totalQuantity]);

        return redirect()->back()->with('success', 'Stock added successfully.');

    }

    public function add_product_sku(Request $request)
    {
        $newProductSku = ProductSku::create([
            'variant_id' => $request -> variant_name,
            'barcode' => $request -> barcode,
            'full_name' => $request -> full_name,
            'sku_size' => $request -> sku_size,
            'sku_quantity' => $request -> sku_quantity,
        ]);

        $newProductSku -> manufacturingStorage() -> create([

            'sku_id' => $newProductSku -> id,
            
        ]);


        Session::flash('success', 'Product SKU has been added!');

        return view('receiving.receiving_home');
    }

    public function view_to_be_receive_po(PurchaseOrder $toReceivePurchaseOrder)
    {
        $totalAmount = $toReceivePurchaseOrder -> purchaseOrderItems -> sum('amount');

        return view('receiving.view_receive', ['toReceivePurchaseOrder' => $toReceivePurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function save_and_receive_po(Request $request, $id)
    {
        
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

    public function storage_input_form()
    {
        return view('receiving.storage_input_form');
    }

    public function storage_output_form()
    {
        return view('receiving.storage_output_form');
    }
  
}

