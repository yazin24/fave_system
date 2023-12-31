<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasingController extends Controller
{
    public function purchase_monitoring() {

        //this get the current date 
        $currentDate = Carbon::now() -> toDateString();

        //this count the number of P.O made in the day
        $totalPurchase = DB::table('purchase_orders')
                        -> whereDate('created_at', '=', $currentDate)
                        -> count('po_number');

        //this code get the sum of amount of the P.O of the current date
        $totalAmount = DB::table('purchase_order_items')
                        -> whereDate('created_at', '=', $currentDate)
                        -> sum('amount');

         // the purchase order has a status of queued. the id of queued is 3 hence i use the 3 in the query builder               
        $purchaseQueue = PurchaseOrder::where('status', '3')
                        ->count('po_number');

        $undeliveredPurchase = PurchaseOrder::where('del_status', 7)
                                ->count('del_status');

             //this code get all the data in the purchase_orders to be display in the table for the current date
        $purchases = PurchaseOrder::with('purchaseOrderSupplier', 'systemStatus')
                    ->where(function ($query) {
                    // Status = 3 (Queued) and Payment Status = 0 (Unpaid)
                    $query->where('status', 3)->where('payment_status', 0);
                })
                    ->orWhere(function ($query) {
                    // Status = 1 (Approved) and Payment Status = 0 (Unpaid)
                     $query->where('status', 1)->where('payment_status', 0);
                })
                    ->orWhere(function ($query) {
                    // Status = 3 (Queued) and Payment Status = 1 (Paid)
                    $query->where('status', 3)->where('payment_status', 1);
                })
                    ->orWhere(function ($query) {
                    // Status = 1 (Approved) and Payment Status = 1 (Paid)
                    $query->where('status', 1)->where('payment_status', 1);
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

                    $dateNow = Carbon::now();
                    foreach ($purchases as $purchase) {
                        $dueDate = Carbon::parse($purchase->purchaseOrderTerms->due_date);
                        $daysDiff = $dueDate->diffInDays($dateNow);
                            

                        $purchase->dueDateColorClass = '';
                    
                        $purchase->daysDiff = $daysDiff;
                    }
        
        return view('purchasing.purchase_monitoring', [
            'purchases' => $purchases, 
            'totalPurchase' => $totalPurchase, 
            'totalAmount' => $totalAmount,
            'purchaseQueue' => $purchaseQueue,
            'undeliveredPurchase' => $undeliveredPurchase,
        ]);
    }
    
    public function purchase()
    {
        $suppliers = Suppliers::all();
        return view('purchasing.purchase', ['suppliers' => $suppliers]);
    }

    public function all_purchases()
    {
        return view('purchasing.all_purchases');
    }

    public function purchasing_supplier_list()
    {
        $suppliers = Suppliers::all();

        return view('purchasing.purchasing_supplier_list', ['suppliers' => $suppliers]);
    }
}
