<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SupplierItems;
use Illuminate\Http\Request;

class ReceivingFunctionsController extends Controller
{
    public function view_to_be_receive_po(PurchaseOrder $toReceivePurchaseOrder)
    {
        $totalAmount = $toReceivePurchaseOrder -> purchaseOrderItems -> sum('amount');

        return view('receiving.view_receive', ['toReceivePurchaseOrder' => $toReceivePurchaseOrder, 'totalAmount' => $totalAmount]);
    }

    public function receive_po_form(Request $request)
    {

        $poNumber = $request -> input('search_po_number');

        $toReceivePo = PurchaseOrder::with('supplierItems')
                    ->where('po_number', $poNumber)
                    ->firstOrFail();

        $purchaseOrderItems = $toReceivePo -> supplierItems;

        return view('receiving.receive_po', ['toReceivePo' => $toReceivePo, 'purchaseOrderItems' => $purchaseOrderItems]);
    }
}

