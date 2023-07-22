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
        $purchaseQueue = PurchaseOrder::whereDate('created_at', $currentDate)
                        ->where('status', '3')
                        ->count('po_number');

        //this code get all the data in the purchase_orders to be display in the table for the current date
         $purchases = PurchaseOrder::with('purchaseOrderSupplier', 'purchaseOrderCredentials', 'systemStatus')
                    ->orderBy('created_at', 'desc')
                    -> get();

        $dateNow = Carbon::now();
        foreach ($purchases as $purchase){
            $dueDate = Carbon::parse($purchase -> purchaseOrderTerms -> due_date);
            $daysDiff = $dueDate -> diffInDays($dateNow);

            if($daysDiff < 0){
                $purchase -> circleReminder = 'bg-red-500 text-white font-bold';
            }elseif ($daysDiff < 2){
                $purchase -> circleReminder = 'bg-yellow-500 text-white font-bold rounded-lg';
            }else {
                $purchase -> circleReminder = '';
            }
        };
        

        return view('purchasing.purchase_monitoring', [
            'purchases' => $purchases, 
            'totalPurchase' => $totalPurchase, 
            'totalAmount' => $totalAmount,
            'purchaseQueue' => $purchaseQueue,
        ]);
    }
    
    public function purchase()
    {
        $suppliers = Suppliers::all();
        return view('purchasing.purchase', ['suppliers' => $suppliers]);
    }

    public function make_purchase()
    {
        
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
