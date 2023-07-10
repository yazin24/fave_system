<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class StaffFunctionsController extends Controller
{
    public function staff_show_specific_purchase(Request $request)
    {
        $date = $request -> input('date', now() -> format('Y-m-d'));

        $allPurchaseOrders = PurchaseOrder::whereDate('created_at', $date)
                                -> orderBy('created_at', 'desc')
                                -> paginate(10);

        return view('staff.staff_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
    }

    public function staff_show_all_purchases(Request $request)
    {
        $allPurchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')
                            -> paginate(10);

        return view('staff.staff_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
    }
}
