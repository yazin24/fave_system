<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\ReceivedPurchaseOrder;
use App\Models\ReceivedPurchaseOrderDetails;
use App\Models\SupplierCreditLimit;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

            $userName = Auth::user() -> name;

            $purchaseOrder-> status = 1;

            $purchaseOrder -> approved_by = $userName;
        
            $purchaseOrder -> save();

            foreach($purchaseOrder -> purchaseOrderItems as $item){

                $toReceivePurchaseOrder = ReceivedPurchaseOrder::create([
                    'po_id' => $purchaseOrder -> id,
                    'item_id' => $item -> item_id,
                    'quantity' => 0,
                ]);
            }


                ReceivedPurchaseOrderDetails::create([
                    'po_id' => $toReceivePurchaseOrder -> po_id,
                    'status' => 1,
                    'supplier_name' => $purchaseOrder -> purchaseorderSupplier -> supplier_name,
                    'payment_status' => false,
                    'del_status' => 7,
                    'requested_by' => $purchaseOrder -> requested_by,
                    'prepared_by' => $purchaseOrder -> prepared_by,
                    'approved_by' => $purchaseOrder -> approved_by,
                ]);


            Session::flash('success', 'Purchase Order has been successfully approved!');

            return view('admin.admin_home');
        
    }

    public function admin_disapprove_purchase(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

            $purchaseOrder -> status = 2;

            $poAmount = $request -> input('poAmount');

            $supplierName = $purchaseOrder -> purchaseOrderSupplier -> supplier_name;

            $supplierCreditLimit = SupplierCreditLimit::whereHas('suppliers', function($query) use ($supplierName){

                $query -> where('supplier_name', $supplierName);

            }) -> first();

            if($supplierCreditLimit) {
                
                $currentCreditLimit = (float) $supplierCreditLimit -> available_credit_limit;

                $newCreditLimit = $currentCreditLimit + (float) $poAmount;

                $supplierCreditLimit -> update(['available_credit_limit' => 

                $newCreditLimit]);
            }

            $purchaseOrder -> save();

            Session::flash('success', 'Purchase Order has been disapproved!');

            return view('admin.admin_home');

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

    public function admin_delete_supplier(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);

        $supplier -> delete();

        return redirect(route('adminpurchasingmonitoring')) -> with('success', 'Purchase Order has been deleted successfully!');
    }
}
