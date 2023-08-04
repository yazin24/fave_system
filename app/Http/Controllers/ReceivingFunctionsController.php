<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderSupplier;
use App\Models\ReceivedPartial;
use App\Models\ReceivedPurchaseOrder;
use App\Models\ReceivedPurchaseOrderCredentials;
use App\Models\ReceivedPurchaseOrderDetails;
use App\Models\SupplierItems;
use Illuminate\Http\Request;

class ReceivingFunctionsController extends Controller
{
    public function view_to_be_receive_po(PurchaseOrder $toReceivePurchaseOrder)
    {
        $totalAmount = $toReceivePurchaseOrder -> purchaseOrderItems -> sum('amount');

        return view('receiving.view_receive', ['toReceivePurchaseOrder' => $toReceivePurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function save_and_receive_po(Request $request, $id)
    {

        $purchaseOrder = PurchaseOrder::findOrFail($id);
    
        $action = $request->input('action');
    
        if ($action === 'complete') {
           
            $purchaseOrder->del_status = 1;

            $purchaseOrder->save();
    
        } elseif ($action === 'partial') {
           
            foreach ($purchaseOrder->purchaseOrderItems as $item) {

                $itemId = $item->id;

                $quantityReceived = $request->input("quantity.$itemId");
    
                ReceivedPartial::create([

                    'po_id' => $purchaseOrder->id,

                    'item_id' => $itemId,

                    'quantity' => $quantityReceived,

                ]);
            }
        }
    
    }

    public function receive_as_partial()
    {
        
    }

    public function view_received(PurchaseOrder $receivedPurchaseOrder)
    {
        $totalAmount = $receivedPurchaseOrder -> purchaseOrderItems() -> sum('amount');

        return view('receiving.view_received', ['receivedPurchaseOrder' => $receivedPurchaseOrder, 'totalAmount' => $totalAmount]);
    }
   
  
}

