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

    public function add_product_sku(Request $request)
    {
        $newProductSku = ProductSku::create([
            'variant_id' => $request -> variant_name,
            'barcode' => $request -> barcode,
            'sku_name' => $request -> sku_name,
            'sku_size' => $request -> sku_size,
            'sku_quantity' => $request -> sku_quantity,
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
        $lastPullOutNumber = PullOutItemsCredentials::latest('id') -> first();

        $lastNumber = $lastPullOutNumber ? (int) $lastPullOutNumber -> po_number: 0;

        $pullOutNoLength = 6;

            $counter = $lastNumber + 1;

        $realPoNumber =str_pad($counter, $pullOutNoLength, '0', STR_PAD_LEFT);
       
        $newPullOutOrderCredentials = PullOutItemsCredentials::create([
            'pull_out_number' => $realPoNumber,
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
  
}

