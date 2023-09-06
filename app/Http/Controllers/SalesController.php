<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\CustomersPurchaseOrders;
use App\Models\LazadaOrderProducts;
use App\Models\LazadaOrders;
use App\Models\LazadaSales;
use App\Models\ManualPurchaseOrder;
use App\Models\ManualPurchaseOrderProducts;
use App\Models\ProductSku;
use App\Models\ShopeeOrderProducts;
use App\Models\ShopeeOrders;
use App\Models\ShopeeSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function sales_monitoring()
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

        $manualSalesData = ManualPurchaseOrderProducts::selectRaw('DATE(created_at) as date, SUM(amount) as total_amount')
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

    // Sort the best selling products data in descending order
    $sortedBestSellingProducts = $allSkuQuantities->sortDesc();

    // Prepare data for the line chart
    $bestSellingLabels = ProductSku::whereIn('id', $sortedBestSellingProducts -> keys()) -> pluck('full_name') -> toArray();
    $bestSellingData = $sortedBestSellingProducts->values()->toArray();
    
    return view('sales.sales_monitoring', [
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
    ]);
    }

    public function shopee_lazada_sales()
    {
        $allShopeeSales = ShopeeOrders::orderBy('created_at', 'desc') -> paginate(10);

        $allLazadaSales = LazadaOrders::orderBy('created_at', 'desc') -> paginate(10);

        return view('sales.shopee_lazada_sales', ['allShopeeSales' => $allShopeeSales, 'allLazadaSales' => $allLazadaSales]);
    }


    public function sales_purchase_orders()
    {
        $allPurchaseOrders = CustomersPurchaseOrders::where('status', 1) -> get();

        return view('sales.sales_purchase_orders',['allPurchaseOrders' => $allPurchaseOrders]);
    }

    public function sales_manual_po()
    {
        $allManualPurchaseOrders = ManualPurchaseOrder::orderBy('created_at', 'desc') -> paginate(10);

        return view('sales.manual_po', ['allManualPurchaseOrders' => $allManualPurchaseOrders]);
    }

    public function for_approval()
    {
        $purchaseOrders = CustomersPurchaseOrders::where('status', 3) -> get();

        return view('sales.for_approval', ['purchaseOrders' => $purchaseOrders]);
    }

    public function agent_monitoring()
    {
        $allAgents = Agents::all();

        return view('sales.agent_monitoring', ['allAgents' => $allAgents]);
    }
}
