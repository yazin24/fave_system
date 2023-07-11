<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class AdminFunctionsController extends Controller
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

    public function admin_show_suppliers_items(Request $request)
    {
        $supplierName = $request -> input('selected_id');

        $suppliers = Suppliers::all();

        $supplierItems = SupplierItems::with('suppliers')
                        -> where('supplier_id', $supplierName)
                        ->get();

        return view('admin.admin_supplier_list', ['supplierItems' => $supplierItems, 'suppliers' => $suppliers]);
    }

    public function admin_purchase_order_approval(PurchaseOrder $queuePurchase)
    {
        $totalAmount = $queuePurchase -> purchaseOrderItems -> sum('amount');

        return view('admin.admin_purchase_approval_view', ['totalAmount' => $totalAmount, 'queuePurchase' => $queuePurchase]);
        
    }

    public function admin_approve_purchase($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $purchaseOrder-> status = 1;
        
        $purchaseOrder -> save();

        return view('admin.admin_home') -> with('success', 'Purchase Order has been Approved!');
    }

    public function admin_disapprove_purchase($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $purchaseOrder -> status = 2;

        $purchaseOrder -> save();

        return view('admin.admin_home') -> with('success', 'Purchase Order has been Disapproved!');


    }
}
