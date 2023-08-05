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

        
        $toReceivePurchaseOrder = PurchaseOrder::findOrFail($id);

        if ($request->has('action')) {

            $action = $request->input('action');

            if ($action === 'complete') {
              
                $toReceivePurchaseOrder->update(['del_status' => 4]);

                foreach ($toReceivePurchaseOrder->purchaseOrderItems as $item) {

                    $quantityReceived = $request->input('quantity.' . $item->id, 0);
                    
                    $item->receivedItems()->create([

                        'po_id' => $toReceivePurchaseOrder -> id,

                        'quantity_received' => $quantityReceived,

                        'received_at' => now(), 

                    ]);

                }

            } elseif ($action === 'partial') {
               
                $toReceivePurchaseOrder->update(['del_status' => 6]);

                foreach ($toReceivePurchaseOrder->purchaseOrderItems as $item) {

                    $quantityReceived = $request->input('quantity.' . $item->id, 0);
                    
                    if ($quantityReceived > 0) {

                        $item->receivedItems()->create([

                            'po_id' => $toReceivePurchaseOrder -> id,

                            'quantity_received' => $quantityReceived,

                            'received_at' => now(), 

                        ]);
                    }
                }
            }
        }

        return view('receiving.receiving_home') -> with('success', 'Purchase Order has been Delivered!');
    
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

