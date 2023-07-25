<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderSupplier;
use App\Models\ReceivedPurchaseOrder;
use App\Models\ReceivedPurchaseOrderCredentials;
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

        $quantities = $request -> input('quantity', []);


        if(is_array($quantities)){

            foreach($quantities as $itemId => $quantity){
                $item = PurchaseOrderItems::findOrFail($itemId);
                if($item){
                    $item -> quantity = $quantity;
                    $item -> save();
                }
    
                $toReceivePurchaseOrder -> del_status = 1;
    
                $toReceivePurchaseOrder -> save();

            }

        }

        return view('receiving.receiving_home') -> with('success', 'Purhase Order has been receive!');
    }
   
  
}

