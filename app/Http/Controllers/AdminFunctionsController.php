<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminFunctionsController extends Controller
{

    public function admin_purchase_order_edit(PurchaseOrder $allPurchaseOrder)
    {
        return view('admin.admin_view_purchase', ['allPurchaseOrder' => $allPurchaseOrder]);
    }


    public function admin_purchase_order_delete(Request $request, $id)
    {
        $allPurchaseOrder = PurchaseOrder::findOrFail($id);

        $allPurchaseOrder -> delete();

        return redirect(route('adminpurchasingmonitoring')) -> with('success', 'Purchase Order has been deleted successfully!');
    }

    public function admin_search(Request $request)
    {
        $search = $request->input('search');

        $allPurchaseOrders = PurchaseOrder::query()
                            -> where('po_number', 'LIKE', '%' . $search . '%')
                            ->paginate(10);

                            return view('admin.admin_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
            // ->where('po_number', 'LIKE', "%$search%")
            // ->orWhereHas('purchaseOrderCredentials', function ($query) use ($search) {
            //     $query->where('requested_by', 'LIKE', "%$search%");
            // })  
            // ->orWhereHas('created_at', function ($query) use ($search) {
            //     $query->where('created_at', 'LIKE', "%$search%");
            // })
            // ->paginate(20);

            // return view('admin.admin_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
    }

    public function admin_view_purchase(PurchaseOrder $allPurchaseOrder) 
    {
        return view('admin.admin_view_purchase', ['allPurchaseOrder' => $allPurchaseOrder]);
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

    public function admin_delete_unpurchase($id)
    {
        $unPurchaseOrder = PurchaseOrder::findOrFail($id);

        $unPurchaseOrder -> delete();

        return view('admin.admin_home') -> with('success', 'Unpurchase Order has been deleted!');
    }
}
