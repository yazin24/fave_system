<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductVariants;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
use App\Models\ReceivedPurchaseOrder;
use App\Models\SystemStatus;
use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    public function product_input()
    {
        $allVariants = ProductVariants::all();

        return view('receiving.product_input', ['allVariants' => $allVariants]);
    }

    public function received_po_monitoring()
    {
         $toReceivePurchaseOrders = PurchaseOrder::with(['systemStatus', 'purchaseOrderItems.allItems'])
        ->where('status', 1)
        ->where(function ($query) {
            $query->where('del_status', 7)
                  ->orWhere('del_status', 6);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('receiving.receiving_monitoring', ['toReceivePurchaseOrders' => $toReceivePurchaseOrders]);
    }

    public function receive_po()
    {
        $receivedPurchaseOrders = PurchaseOrder::where('del_status', 4)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('receiving.receive_po', ['receivedPurchaseOrders' => $receivedPurchaseOrders]);
    }

    public function pull_out_monitoring()
    {
        $pullOuts = PullOutItemsCredentials::all();

        return view('receiving.pull_out_monitoring', ['pullOuts' => $pullOuts]);
    }

    public function pull_out()
    {

        return view('receiving.pull_out');
    }
}
