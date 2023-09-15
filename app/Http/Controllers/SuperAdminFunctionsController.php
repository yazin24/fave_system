<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LazadaOrders;
use App\Models\ManualPurchaseOrder;
use App\Models\ShopeeOrders;
use Illuminate\Http\Request;

class SuperAdminFunctionsController extends Controller
{
    public function sales_manual_monitoring()
    {
        $allManualPurchaseOrders = ManualPurchaseOrder::orderBy('created_at', 'desc') -> paginate(10);

        return view('superadmin.sales_manual_monitoring', ['allManualPurchaseOrders' => $allManualPurchaseOrders]);
    }

    public function manual_order_details_to_edit(ManualPurchaseOrder $manualOrder)
    {
        $totalOrderAmount = $manualOrder -> manualPurchaseOrderProducts() -> sum('amount');

        return view('superadmin.manual_order_details_to_edit', ['manualOrder' => $manualOrder, 'totalOrderAmount' => $totalOrderAmount]);
    }

    public function manual_order_delete(ManualPurchaseOrder $manualOrder)
    {
        $deleteManualOrder = ManualPurchaseOrder::findOrFail($manualOrder -> id);

        if($deleteManualOrder){

            $deleteManualOrder -> manualPurchaseOrderSales() -> delete();

            $deleteManualOrder -> manualPurchaseOrderProducts() -> delete();

            $deleteManualOrder -> delete();

            return redirect() -> back() -> with('success', 'Manual purchase order has been deleted!');

        }else {
            return redirect() -> back() -> with('success', 'An error occured. Please try again.');
        }

       
    }

    public function sales_shopee_monitoring()
    {
        $allShopeeSales = ShopeeOrders::orderBy('created_at', 'desc') -> paginate(10);

        return view('superadmin.sales_shopee_monitoring', ['allShopeeSales' => $allShopeeSales]);
    }

    public function shopee_order_details_to_edit(ShopeeOrders $shopeeOrder)
    {
        $totalOrderAmount = $shopeeOrder -> shopeeOrderProducts() -> sum('amount');

        return view('superadmin.shopee_order_details_to_edit', ['shopeeOrder' => $shopeeOrder, 'totalOrderAmount' => $totalOrderAmount]);
    }

    public function shopee_order_delete(ShopeeOrders $shopeeOrder)
    {
        $deleteShopeeOrder = ShopeeOrders::findOrFail($shopeeOrder -> id);

        if($deleteShopeeOrder){

            $deleteShopeeOrder -> shopeeSales() -> delete();

            $deleteShopeeOrder -> shopeeOrderProducts() -> delete();

            $deleteShopeeOrder -> delete();

            return redirect() -> back() ->with('success', 'Shopee Order has been deleted!');

        }else {

            return redirect() -> back() ->with('success', 'An error occured. Please try again.');

        }

        
    }

    public function sales_lazada_monitoring()
    {
        $allLazadaSales = LazadaOrders::orderBy('created_at', 'desc') -> paginate(10);

        return view('superadmin.sales_lazada_monitoring', ['allLazadaSales' => $allLazadaSales]);
    }

    public function lazada_order_details_to_edit(LazadaOrders $lazadaOrder)
    {
        $totalOrderAmount = $lazadaOrder -> lazadaOrderProducts() -> sum('amount');

        return view('superadmin.lazada_order_details_to_edit', ['lazadaOrder' => $lazadaOrder, 'totalOrderAmount' => $totalOrderAmount]);
    }

    public function lazada_order_delete(LazadaOrders $lazadaOrder)
    {
     
        $deleteLazadaOrder = LazadaOrders::findOrFail($lazadaOrder -> id);

        if($deleteLazadaOrder){

            $deleteLazadaOrder -> lazadaSales() -> delete();

            $deleteLazadaOrder -> lazadaOrderProducts() -> delete();

            $deleteLazadaOrder -> delete();

            return redirect() -> back() -> with('success', 'Lazada Order has been deleted!');

        }else {
            return redirect() -> back() -> with('success', 'An error occured! Please try again.');
        }

    }
}
