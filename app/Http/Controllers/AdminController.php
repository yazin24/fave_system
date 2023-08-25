<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\ProductSku;
use App\Models\PullOutItems;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function admin_sales_monitoring()
    {
        $stocksData = ProductSku::select('full_name', 'sku_quantity as stock_quantity') -> get();

        return view('admin.admin_sales_monitoring',['stocksData' => $stocksData]);
    }

    public function admin_purchasing_monitoring()
    {

        $allPurchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')
                            ->whereIn('status', [1, 3])
                            ->paginate(10);

        // $allPurchaseOrders = PurchaseOrder::query()
        //                     ->where('po_number', 'LIKE', '%' . $search . '%')
        //                     ->get()

        return view('admin.admin_purchasing_monitoring', ['allPurchaseOrders' => $allPurchaseOrders]);
    }

    public function admin_purchase_approval()
    {
        $queuePurchases = PurchaseOrder::where('status', 3)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('admin.admin_purchase_approval', ['queuePurchases' => $queuePurchases]);
    }

    public function admin_add_supplier()
    {
        return view('admin.admin_add_supplier');
    }

    public function admin_supplier_list()
    {
        $suppliers = Suppliers::all();

        return view('admin.admin_supplier_list', ['suppliers' => $suppliers]);
    }

    public function admin_unpurchase()
    {
        $unPurchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')
                        ->whereIn('status', [2, 4])
                        ->paginate(10);

        return view('admin.admin_unpurchase', ['unPurchaseOrders' => $unPurchaseOrders]);
    }

    public function admin_all_products()
    {
        $allProducts = ProductSku::all();

        return view('admin.admin_all_products', ['allProducts' => $allProducts]);
    }

    public function admin_stock_monitoring()
    {
        $allStocks = AllItems::all();

        return view('admin.admin_stock_monitoring', ['allStocks' => $allStocks]);
    }

    public function admin_outgoing_stocks()
    {
        $pullOutItems = PullOutItemsCredentials::all();

        return view('admin.admin_outgoing_stocks', ['pullOutItems' => $pullOutItems]);
    }
    
}
