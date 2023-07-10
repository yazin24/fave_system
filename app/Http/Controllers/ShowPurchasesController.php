<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;


class ShowPurchasesController extends Controller
{
    public function show_purchases(Request $request)
    {
        //this code pick the date that the user choose
        $date = $request -> input('date', now() -> format('Y-m-d'));
        $purchaseOrders = PurchaseOrder::whereDate('created_at', $date)
                        ->orderBy('created_at', 'desc')
                        -> paginate(10);

        return view('purchasing.all_purchases', ['purchaseOrders' => $purchaseOrders]);
    }

    public function all_purchases()
    {
        $purchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('purchasing.all_purchases', ['purchaseOrders' => $purchaseOrders]);
    }
}
