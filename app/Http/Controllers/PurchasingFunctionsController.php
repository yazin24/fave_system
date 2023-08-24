<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\PurchaseOrder;
use App\Models\SupplierCreditLimit;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use App\Models\SystemStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;


class PurchasingFunctionsController extends Controller
{

    //purchase order create

    public function purchase_show_supplier_items(Request $request)
    {

        // $validId = $request -> validate([
        //     'supplier_id' => 'required| exists:suppliers, id',
        // ]);

        $supplierName = $request -> input('supplier_id');

        $suppliers = Suppliers::orderBy('created_at', 'desc') -> get();

        $supplierNameForPurchase = Suppliers::findOrFail($supplierName);

        $supplierCredit = SupplierCreditLimit::where('supplier_id', $supplierName) -> value('available_credit_limit');

        $supplierItems = $supplierNameForPurchase -> allItems;


        return view('purchasing.purchase', ['supplierItems' => $supplierItems, 'suppliers' => $suppliers, 'supplierNameForPurchase' => $supplierNameForPurchase, 'supplierCredit' => $supplierCredit]);
    }

    public function purchase_order_store(Request $request, $id)
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

        $itemNames = $request -> input('item_id', []);
        $quantity = $request -> input('quantity', []);
        // $quantityUnit = $request -> input('item_unit', []);
        $unitPrice = $request -> input('unit_price', []);

        $lastPurchaseOrder = PurchaseOrder::latest('id') -> first();
        $lastPoNumber = $lastPurchaseOrder ? $lastPurchaseOrder -> po_number : null;

        $prefix = 'FV';
        $poLength = 5;
       
        $counter = 0;
        if($lastPoNumber){
            $lastCounter = (int)substr($lastPoNumber, strlen($prefix));
            $counter = $lastCounter + 1;
        }

        
        $poPart = str_pad($counter, $poLength, '0', STR_PAD_LEFT);

        $realPoNumber = $prefix . $poPart;

        $userName = Auth::user() -> name;

        $defaultDelStatus = 7;

        // $delStatus = SystemStatus::where('status', 'undelivered') -> value('id');

        $newPurchaseOrder = PurchaseOrder::create([

            'po_number' => $realPoNumber,
            'del_status' => $defaultDelStatus,
            'requested_by' => $request -> requested_by,
            'prepared_by' => $userName,
        ]);

        $newPurchaseOrder -> purchaseOrderSupplier() -> create([
            'po_id' => $newPurchaseOrder -> id,
            'supplier_name' => $request -> supplier_name,
        ]);

        $paymentTerm = (int) $request -> payment_term;

        $todayDate = now();

        $dueDate = $todayDate -> addDays($paymentTerm);

        $newPurchaseOrder -> purchaseOrderTerms() -> create([
            'po_id' => $newPurchaseOrder -> id,
            'payment_term' => $request -> payment_term,
            'mode_of_payment' => $request -> mode_of_payment,
            'due_date' => $dueDate,
        ]);
        
        foreach ($itemNames as $itemId => $itemName) {
            if (in_array($itemId, $selectedItems)) {
                $quantityValue = $quantity[$itemId] ?? null;
                $unitPriceValue = $unitPrice[$itemId] ?? null;
        
                if ($itemId && $quantityValue && $unitPriceValue) {
                    $amount = $quantityValue * $unitPriceValue;
        
                    $newPurchaseOrder->purchaseOrderItems()->create([
                        'item_id' => $itemId,
                        'quantity' => $quantityValue,
                        'unit_price' => $unitPriceValue,
                        'amount' => $amount,
                    ]);
                }
            }
        }

        $supplierCreditLimit = SupplierCreditLimit::where('supplier_id', $id) -> value('available_credit_limit');

                    $totalAmount = 0;
                    foreach ($itemNames as $itemId => $itemName) {
                     if (in_array($itemId, $selectedItems)) {
                    $quantityValue = $quantity[$itemId] ?? null;
                     $unitPriceValue = $unitPrice[$itemId] ?? null;

                     if ($quantityValue && $unitPriceValue) {
                     $amount = $quantityValue * $unitPriceValue;
                     $totalAmount += $amount;
                 }
                }
            }

         $newCreditLimit = $supplierCreditLimit - $totalAmount;

         SupplierCreditLimit::where('supplier_id', $id) -> update(['available_credit_limit' => $newCreditLimit]);

        $newPurchaseOrder -> save();

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

        $templateReceipt -> setValue('PTERM', $purchase -> purchaseOrderTerms -> payment_term);

        $templateReceipt -> setValue('PO', $purchase -> po_number);

        $createdDate = date('Y-m-d', strtotime($purchase -> created_at));

        $templateReceipt -> setValue('PO_DATE', $createdDate);

        $templateReceipt -> setvalue('SUPPLIER', $purchase -> purchaseOrderSupplier -> supplier -> supplier_name);

        $templateReceipt -> setvalue('SUPPLIER_ADDRESS', $purchase -> purchaseOrderSupplier -> supplier -> supplier_address);

        $templateReceipt -> setvalue('SUPPLIER_NUMBER', $purchase -> purchaseOrderSupplier -> supplier -> contact_number);

        $templateReceipt -> setvalue('SUPPLIER_PERSON', $purchase -> purchaseOrderSupplier -> supplier -> contact_person);

        $templateReceipt -> setValue('REQUESTED_BY', $purchase -> requested_by);

        $templateReceipt -> setValue('PREPARED_BY', $purchase -> prepared_by);

        $templateReceipt -> setValue('APPROVED_BY', $purchase -> approved_by);

        $templateReceipt -> setValue('TOTAL', $purchase -> purchaseOrderItems -> sum('amount'));

        $items = $purchase -> purchaseOrderItems;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("ITEM_QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("UNIT{$itemIndex}", $item -> allItems -> item_unit);

            $templateReceipt -> setValue("ITEM_NAME{$itemIndex}", $item -> allItems -> item_name);

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

        $savePath = public_path('P.O_' . $purchase -> po_number . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);


    }

    //end of view purchase order details and generate receipt

    //update payment status from unpaid to paid

    public function payment_details(PurchaseOrder $purchase)
    {
        // $dateNow = Carbon::now();
        // foreach ($purchases as $purchase){
        //     $dueDate = Carbon::parse($purchase -> purchaseOrderTerms -> due_date);
        //     $daysDiff = $dueDate -> diffInDays($dateNow);

        //     $purchase -> daysDiff = $daysDiff;
        // };

        $totalAmount = $purchase -> purchaseOrderItems -> sum('amount');

        return view('purchasing.purchase_settle_payment', ['purchase' => $purchase, 'totalAmount' => $totalAmount]);
    }

    public function update_payment_status(Request $request, $id)
    {
        $amountPaid = $request -> input('amountPaid');

        $paymentStatus = PurchaseOrder::findOrFail($id);

        $paymentStatus -> payment_status = 1;
        
        $paymentStatus -> amount_paid = $amountPaid;

        $supplierName = $paymentStatus->purchaseOrderSupplier-> supplier -> supplier_name;

        // dd($supplierName);

        $supplierCreditLimit = SupplierCreditLimit::whereHas('suppliers', function ($query) 

        use ($supplierName) {

        $query -> where('supplier_name', $supplierName);

        }) -> first();
        

        if($supplierCreditLimit){

            $currentCreditLimit = (float) $supplierCreditLimit -> available_credit_limit;
    
            $newCreditLimit = $currentCreditLimit + $amountPaid;
           
    
            $supplierCreditLimit -> update(['available_credit_limit' => $newCreditLimit]);

        }

        $paymentStatus -> save();

        return redirect() -> back() -> with('success', 'Purchase Order has been paid!');
    }

    //end of update payment status from unpaid to paid

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
        $allItems = AllItems::all();

        return view('purchasing.purchasing_add_supplier', ['suppliers' => $suppliers, 'allItems' => $allItems]);
    }

    public function add_supplier_store(Request $request)
    {
        $newSupplier = Suppliers::create([

            'supplier_name' => $request -> supplier_name,
            'supplier_address' => $request -> supplier_address,
            'contact_number' => $request -> contact_number,
            'tel_number' => $request -> tel_number,
            'contact_person' => $request -> contact_person,
            'viber_account' => $request -> viber_account,
            'supplier_email' => $request -> supplier_email,

        ]);

        $newSupplier -> supplierCreditLimit() -> create([

            'supplier_id' => $newSupplier -> id,
            'credit_limit' => $request -> supplier_credit_limit,
            'available_credit_limit' => $request -> supplier_credit_limit,
        ]);

        $itemNames = $request -> item_name;
        $itemUnits = $request -> item_unit;
        $defaultPrice = $request -> default_price;

        $selectedItemIds = $request -> input('item_ids', []);

        $newSupplier -> allItems() -> attach($selectedItemIds);

        $itemIds = [];
        for ($i = 0; $i < count($itemNames); $i++){
            $item = AllItems::firstOrCreate([
                'item_name' => $itemNames[$i],
                'item_unit' => $itemUnits[$i],
                'default_price' => $defaultPrice[$i],
            ]);

            $itemIds[] = $item -> id;

        }

        $newSupplier -> allItems() -> syncWithoutDetaching($itemIds);

        Session::flash('success', 'Supplier and its item has been created successfully!');

        return view('purchasing.purchasing_home');
    }

    // public function supplier_list()
    // {
    //     $suppliers = Suppliers::all();

    //     return view('purchasing.purchasing_supplier_list', ['suppliers' => $suppliers]);
    // }

    public function show_supplier_details(Suppliers $supplier)
    {
        $supplier -> load('supplierItems.purchaseOrderItems.allItems');

        return view('purchasing.purchasing_show_supplier_details', ['supplier' => $supplier]);
    }

    // end of add supplier and supplier list

}
