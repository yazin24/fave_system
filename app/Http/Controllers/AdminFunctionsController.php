<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class AdminFunctionsController extends Controller
{

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
        $totalAmount = $allPurchaseOrder -> purchaseOrderItems -> sum('amount');

        return view('admin.admin_view_purchase', ['allPurchaseOrder' => $allPurchaseOrder, 'totalAmount' => $totalAmount]);
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

            $purchaseOrder-> status = 2;
        
            $purchaseOrder -> save();

            return view('admin.admin_home') -> with('success', 'Purchase Order has been Approved!');
        
    }

    public function admin_disapprove_purchase($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

            $purchaseOrder -> status = 3;

            $purchaseOrder -> save();

            return view('admin.admin_home') -> with('success', 'Purchase Order has been Disapproved!');

    }

    
    public function admin_generate_po_receipt(PurchaseOrder $allPurchaseOrder)
    {
        $templateReceiptPath = ('receipts/po_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        $templateReceipt -> setValue('PO', $allPurchaseOrder -> po_number);

        $templateReceipt -> setValue('PO_DATE', $allPurchaseOrder -> created_at);

        $templateReceipt -> setvalue('SUPPLIER', $allPurchaseOrder -> purchaseOrderSupplier -> supplier_name);

        $templateReceipt -> setValue('REQUESTED_BY', $allPurchaseOrder -> purchaseOrderCredentials -> requested_by);

        $templateReceipt -> setValue('PREPARED_BY', $allPurchaseOrder -> purchaseOrderCredentials -> prepared_by);

        $templateReceipt -> setValue('APPROVED_BY', $allPurchaseOrder -> purchaseOrderCredentials -> approved_by);

        // $currentDate = Carbon::now() -> toDateString();

        // $totalAmount = DB::table('purchase_order_items')
        //             -> whereDate('created_at', '=', $currentDate)
        //             ->sum('amount');


        $templateReceipt -> setValue('TOTAL', $allPurchaseOrder -> purchaseOrderItems -> sum('amount'));

        $items = $allPurchaseOrder -> purchaseOrderItems;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("ITEM_QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("UNIT{$itemIndex}", $item -> quantity_unit);

            $templateReceipt -> setValue("ITEM_NAME{$itemIndex}", $item -> item_name);

            $templateReceipt ->  setValue("UNIT_PRICE{$itemIndex}", $item -> unit_price);

            $templateReceipt -> setValue("AMOUNT{$itemIndex}", $item -> amount);

            $itemIndex++;

        }

         //     //this remove the placeholder for the remaining rows in the table thats empty
         for ($i = $itemIndex; $i <= $itemRows; $i++) {
            $templateReceipt->setValue("ITEM_QUANTITY{$i}", '');
            $templateReceipt->setValue("UNIT{$i}", '');
            $templateReceipt->setValue("ITEM_NAME{$i}", '');
            $templateReceipt->setValue("UNIT_PRICE{$i}", '');
            $templateReceipt->setValue("AMOUNT{$i}", '');
        }

        $savePath = public_path('P.O_' . $allPurchaseOrder -> po_number . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);


    }

    public function admin_delete_unpurchase($id)
    {
        $unPurchaseOrder = PurchaseOrder::findOrFail($id);

        $unPurchaseOrder -> delete();

        return view('admin.admin_home') -> with('success', 'Unpurchase Order has been deleted!');
    }
}
