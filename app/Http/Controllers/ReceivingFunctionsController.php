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

       $purchaseOrders = PurchaseOrder::query()
                        ->where('po_number', 'LIKE', '%' . $poNumber . '%')
                        ->get();

        return view('receiving.receive_po', ['purchaseOrders' => $purchaseOrders]);
    }

    public function save_and_receive_po(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        

        return view('receiving.receiving_home');
    }
}

