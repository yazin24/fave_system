<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class AdminPurchasingMonitoringController extends Controller
{

    public function admin_purchase_order_edit(PurchaseOrder $allPurchaseOrder)
    {
        return view('admin.admin_purchase_order_edit', ['allPurchaseOrder' => $allPurchaseOrder]);
    }


    public function admin_purchase_order_delete(Request $request, $id)
    {
        $allPurchaseOrder = PurchaseOrder::findOrFail($id);

        $allPurchaseOrder -> delete();

        return redirect(route('adminpurchasingmonitoring')) -> with('success', 'Purchase Order has been deleted successfully!');
    }
}
