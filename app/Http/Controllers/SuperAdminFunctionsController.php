<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LazadaOrders;
use App\Models\ShopeeOrders;
use Illuminate\Http\Request;

class SuperAdminFunctionsController extends Controller
{
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
