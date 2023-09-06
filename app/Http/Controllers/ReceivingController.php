<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ManufacturingStorage;
use App\Models\ProductSku;
use App\Models\ProductVariants;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
use App\Models\ReceivedPurchaseOrder;
use App\Models\SystemStatus;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class ReceivingController extends Controller
{
    public function received_po_monitoring()
    {
         $toReceivePurchaseOrders = PurchaseOrder::with(['systemStatus', 'purchaseOrderItems.allItems'])
        ->where('status', 1)
        ->where(function ($query) {
            $query->where('del_status', 7)
                  ->orWhere('del_status', 6);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('receiving.receiving_monitoring', ['toReceivePurchaseOrders' => $toReceivePurchaseOrders]);
    }

    public function receive_po()
    {
        $receivedPurchaseOrders = PurchaseOrder::where('del_status', 4)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        return view('receiving.receive_po', ['receivedPurchaseOrders' => $receivedPurchaseOrders]);
    }

    public function pull_out_monitoring()
    {
        $pullOuts = PullOutItemsCredentials::orderBy('created_at', 'desc') -> paginate(10);

        return view('receiving.pull_out_monitoring', ['pullOuts' => $pullOuts]);
    }

    public function pull_out()
    {

        return view('receiving.pull_out');
    }

    public function manufacturing_storage()
    {
        $storageSkus = ManufacturingStorage::all();

        return view('receiving.product_storage', ['storageSkus' => $storageSkus]);
    }

    public function all_products()
    {
        $allProducts = ProductSku::all();

        return view('receiving.receiving_all_products', ['allProducts' => $allProducts]);
    }
}
