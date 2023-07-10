<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class SupplierListController extends Controller
{
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

        FacadesSession::flash('success', 'Supplier and its item has been created successfully!');

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
}
