<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderCredentials;
use App\Models\PurchaseOrderSupplier;
use App\Models\PurchaseOrderItems;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PurchaseOrderCreateController extends Controller
{

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
}
