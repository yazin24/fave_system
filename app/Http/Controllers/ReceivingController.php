<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    public function received_po_monitoring()
    {
        $toReceivePurchaseOrders = PurchaseOrder::where('status', 2)
                                -> orderBy('created_at', 'desc')
                                -> get();

        return view('receiving.receiving_monitoring', ['toReceivePurchaseOrders' => $toReceivePurchaseOrders]);
    }

    public function receive_po()
    {
        $receivedPurchaseOrders = PurchaseOrder::where('del_status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
                                
        return view('receiving.receive_po', ['receivedPurchaseOrders' => $receivedPurchaseOrders]);
    }
}
