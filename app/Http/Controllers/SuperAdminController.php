<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LazadaOrderProducts;
use App\Models\LazadaSales;
use App\Models\ManualPurchaseOrderProducts;
use App\Models\ManualPurchaseOrderSales;
use App\Models\ProductSku;
use App\Models\ShopeeOrderProducts;
use App\Models\ShopeeSales;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function superadmin_sales_monitoring()
    {
        $shopeeSalesData = ShopeeSales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount')
        ->groupByRaw('DATE(created_at)')
        ->paginate(10);

        $shopeeDates = $shopeeSalesData->pluck('date');
        $shopeeAmounts = $shopeeSalesData->pluck('total_amount');

        $lazadaSalesData = LazadaSales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount')
        ->groupByRaw('DATE(created_at)')
        ->paginate(10);

        $lazadaDates = $lazadaSalesData->pluck('date');
        $lazadaAmounts = $lazadaSalesData->pluck('total_amount');

        $manualSalesData = ManualPurchaseOrderSales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount')
        ->groupByRaw('DATE(created_at)')
        ->paginate(10);

        $manualDates = $manualSalesData->pluck('date');
        $manualAmounts = $manualSalesData->pluck('total_amount');

        $skuShopeeQuantities = ShopeeOrderProducts::groupBy('sku_id')
        ->selectRaw('sku_id, SUM(quantity) as total_quantity')
        ->get();
        

        $skuLazadaQuantities = LazadaOrderProducts::groupBy('sku_id')
        ->selectRaw('sku_id, SUM(quantity) as total_quantity')
        ->get();

        $skuManualQuantities = ManualPurchaseOrderProducts::groupBy('sku_id')
        ->selectRaw('sku_id, SUM(quantity) as total_quantity')
        ->get();

        $allSkuQuantities = $skuShopeeQuantities
        ->concat($skuLazadaQuantities)
        ->concat($skuManualQuantities)
        ->groupBy('sku_id')
        ->map(function ($group) {
            return $group->sum('total_quantity');
        });

    $sortedBestSellingProducts = $allSkuQuantities->sortDesc();

    $bestSellingLabels = ProductSku::whereIn('id', $sortedBestSellingProducts -> keys()) -> pluck('full_name') -> toArray();
    $bestSellingData = $sortedBestSellingProducts->values()->toArray();
    

        return view('superadmin.sales_monitoring',
        [
            'shopeeSalesData' => $shopeeSalesData,
            'shopeeDates' => $shopeeDates, 
            'shopeeAmounts' => $shopeeAmounts, 
            'lazadaDates' => $lazadaDates, 
            'lazadaAmounts' => $lazadaAmounts, 
            'manualDates' => $manualDates, 
            'manualAmounts' => $manualAmounts,
            'bestSellingLabels' => $bestSellingLabels,
            'bestSellingData' => $bestSellingData,
            'skuShopeeQuantities' => $skuShopeeQuantities,
            'skuLazadaQuantities' => $skuLazadaQuantities,
            'skuManualQuantities' => $skuManualQuantities,
        ]
    );
    }

    public function purchasing_monitoring()
    {
        return view('superadmin.purchasing_monitoring');
    }

    public function receiving_monitoring()
    {
        return view('superadmin.receiving_monitoring');
    }

    public function suppliers_monitoring()
    {
        return view('superadmin.suppliers_monitoring');
    }

    public function products_monitoring()
    {
        $allProducts = ProductSku::all();

        return view('superadmin.products_monitoring', ['allProducts' => $allProducts]);
    }

    public function raw_materials_monitoring()
    {
        return view('superadmin.raw_materials_monitoring');
    }

    public function manufacturing_storage_monitoring()
    {
        return view('superadmin.manufacturing_storage_monitoring');
    }

    public function agents_monitoring()
    {
        return view('superadmin.agents_monitoring');
    }

    public function agent_customer_monitoring()
    {
        return view('superadmin.agent_customer_monitoring');
    }
}
