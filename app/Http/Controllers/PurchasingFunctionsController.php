<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

class PurchasingFunctionsController extends Controller
{

    //purchase order create

    public function purchase_show_supplier_items(Request $request)
    {


        $supplierName = $request -> input('supplier_id');

        $suppliers = Suppliers::all();

        $supplierNameForPurchase = Suppliers::findOrFail($supplierName);

        $supplierItems = SupplierItems::with('suppliers')
                        ->where('supplier_id', $supplierName)
                        ->get();


        return view('purchasing.purchase', ['supplierItems' => $supplierItems, 'suppliers' => $suppliers, 'supplierNameForPurchase' => $supplierNameForPurchase,]);
    }
    public function purchase_order_store(Request $request)
    {

        

        // $request->validate([
        //     'supplier_name' => 'required',
        //     'po_number' => 'required|unique:purchase_orders',
        //     'requested_by' => 'required',
        //     'prepared_by' => 'required',
        //     'approved_by' => 'required',
        //     'item_name.*' => 'required',
        //     'quantity.*' => 'required|numeric|min:1',
        //     'unit_price.*' => 'required|numeric|min:0',
        //     'amount.*' => 'required|numeric|min:0',
        // ]);

        $selectedItems = $request -> input('selected_items', []);

        $itemNames = $request -> input('item_name', []);
        $quantity = $request -> input('quantity', []);
        $unitPrice = $request -> input('unit_price', []);

        $characters = '1234567890';
        $prefix = 'FV';
        $poLength = 9 - strlen($prefix);
        $poPart = '';

        for($i = 0; $i < $poLength; $i++){
            $poPart .= $characters[rand(0, strlen($characters) -1)];
        }

        $realPoNumber = $prefix . $poPart;

        $newPurchaseOrder = PurchaseOrder::create([
            'po_number' => $realPoNumber,
        ]);

        $newPurchaseOrder -> purchaseOrderSupplier() -> create([
            'po_id' => $newPurchaseOrder -> id,
            'supplier_name' => $request -> supplier_name,
        ]);

        $newPurchaseOrder -> purchaseOrderCredentials() -> create([
            'po_id' => $newPurchaseOrder -> id,
            'requested_by' => $request -> requested_by,
            'prepared_by' => $request -> prepared_by,
            'approved_by' => $request-> approved_by,
        ]);

        
        foreach ($itemNames as $itemId => $itemName) {
            if (in_array($itemId, $selectedItems)) {
                $quantityValue = $quantity[$itemId] ?? null;
                $unitPriceValue = $unitPrice[$itemId] ?? null;
        
                if ($itemName && $quantityValue && $unitPriceValue) {
                    $amount = $quantityValue * $unitPriceValue;
        
                    $newPurchaseOrder->purchaseOrderItems()->create([
                        'item_name' => $itemName,
                        'quantity' => $quantityValue,
                        'unit_price' => $unitPriceValue,
                        'amount' => $amount,
                    ]);
                }
            }
        }


        Session::flash('success', 'Purchase Order has been successfully created!');

        return view('purchasing.purchasing_home');

        //dd($request->item_name);
    }

    //end of purchase order create

    //view purchase order details and generate receipt

    public function view_purchase_order(PurchaseOrder $purchase)
    {
       //$currentDate = Carbon::now() -> toDateString();

       $totalAmount = $purchase -> purchaseOrderItems -> sum('amount');


        return view('purchasing.view_purchase', ['purchase' => $purchase, 'totalAmount' => $totalAmount]);
    }

    public function generate_po_receipt(PurchaseOrder $purchase)
    {
        $templateReceiptPath = ('receipts/po_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        $templateReceipt -> setValue('PO', $purchase -> po_number);

        $templateReceipt -> setValue('PO_DATE', $purchase -> created_at);

        $templateReceipt -> setvalue('SUPPLIER', $purchase -> purchaseOrderSupplier -> supplier_name);

        $templateReceipt -> setValue('REQUESTED_BY', $purchase -> purchaseOrderCredentials -> requested_by);

        $templateReceipt -> setValue('PREPARED_BY', $purchase -> purchaseOrderCredentials -> prepared_by);

        $templateReceipt -> setValue('APPROVED_BY', $purchase -> purchaseOrderCredentials -> approved_by);

        // $currentDate = Carbon::now() -> toDateString();

        // $totalAmount = DB::table('purchase_order_items')
        //             -> whereDate('created_at', '=', $currentDate)
        //             ->sum('amount');


        $templateReceipt -> setValue('TOTAL', $purchase -> purchaseOrderItems -> sum('amount'));

        $items = $purchase -> purchaseOrderItems;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("ITEM_QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("ITEM_NAME{$itemIndex}", $item -> item_name);

            $templateReceipt ->  setValue("UNIT_PRICE{$itemIndex}", $item -> unit_price);

            $templateReceipt -> setValue("AMOUNT{$itemIndex}", $item -> amount);

            $itemIndex++;

        }

         //     //this remove the placeholder for the remaining rows in the table thats empty
         for ($i = $itemIndex; $i <= $itemRows; $i++) {
            $templateReceipt->setValue("ITEM_QUANTITY{$i}", '');
            $templateReceipt->setValue("ITEM_NAME{$i}", '');
            $templateReceipt->setValue("UNIT_PRICE{$i}", '');
            $templateReceipt->setValue("AMOUNT{$i}", '');
        }

        $savePath = public_path('P.O_' . $purchase -> po_number . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);


    }

    //end of view purchase order details and generate receipt

    //show all purchases

    public function show_purchases(Request $request)
    {
        //this code pick the date that the user choose
        $date = $request -> input('date', now() -> format('Y-m-d'));
        $purchaseOrders = PurchaseOrder::whereDate('created_at', $date)
                        ->orderBy('created_at', 'desc')
                        -> paginate(10);

        return view('purchasing.all_purchases', ['purchaseOrders' => $purchaseOrders, 'date' => $date]);
    }

    public function all_purchases()
    {
        $purchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('purchasing.all_purchases', ['purchaseOrders' => $purchaseOrders]);
    }

    //end of show all purchases

    //add supplie and supplier list

    public function add_supplier()
    {
        $suppliers = Suppliers::all();
        return view('purchasing.purchasing_add_supplier', ['suppliers' => $suppliers]);
    }

    public function add_supplier_store(Request $request)
    {
        $newSupplier = Suppliers::create([

            'supplier_name' => $request -> supplier_name,

        ]);

        for ($i = 0; $i < count($request -> item_name); $i++){
            $supplierItemData[] = [
                'item_name' => $request ->item_name[$i],
            ];
        }

        $newSupplier -> supplierItems() -> createMany($supplierItemData);

        Session::flash('success', 'Supplier and its item has been created successfully!');

        return redirect() -> back();
    }

    public function supplier_list()
    {
        $suppliers = Suppliers::all();

        return view('purchasing.purchasing_supplier_list', ['suppliers' => $suppliers]);
    }

    public function show_supplier_items(Request $request)
    {
        $supplierName = $request -> input('selected_id');

        $suppliers = Suppliers::all();

        $supplierItems = SupplierItems::with('suppliers')
                        ->where('supplier_id', $supplierName)
                        -> get();

        return view('purchasing.purchasing_supplier_list', ['supplierItems' => $supplierItems, 'suppliers' => $suppliers]);
    }

    //end of add supplier and supplier list


}