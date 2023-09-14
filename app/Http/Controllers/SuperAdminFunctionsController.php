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

    public function sales_lazada_monitoring()
    {
        $allLazadaSales = LazadaOrders::orderBy('created_at', 'desc') -> paginate(10);

        return view('superadmin.sales_lazada_monitoring', ['allLazadaSales' => $allLazadaSales]);
    }
}
