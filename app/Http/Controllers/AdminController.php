<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\LazadaOrderProducts;
use App\Models\LazadaSales;
use App\Models\ManualPurchaseOrderProducts;
use App\Models\ProductSku;
use App\Models\PullOutItems;
use App\Models\PullOutItemsCredentials;
use App\Models\PurchaseOrder;
use App\Models\ShopeeOrderProducts;
use App\Models\ShopeeSales;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function admin_sales_monitoring()
    {   
        $shopeeSalesData = ShopeeSales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount')
        ->groupByRaw('DATE(created_at)')
        ->get();

        $shopeeDates = $shopeeSalesData->pluck('date');
        $shopeeAmounts = $shopeeSalesData->pluck('total_amount');

        $lazadaSalesData = LazadaSales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount')
        ->groupByRaw('DATE(created_at)')
        ->get();

        $lazadaDates = $lazadaSalesData->pluck('date');
        $lazadaAmounts = $lazadaSalesData->pluck('total_amount');

        $manualSalesData = ManualPurchaseOrderProducts::selectRaw('DATE(created_at) as date, SUM(amount) as total_amount')
        ->groupByRaw('DATE(created_at)')
        ->get();

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


    // Combine the data from all sales channels
    $allProductsData = $skuShopeeQuantities->concat($skuLazadaQuantities)->concat($skuManualQuantities);

    // Group the combined data by product name and sum the quantities
    $bestSellingProductsData = $allProductsData->groupBy('sku_id')->map(function ($group) {
        return $group->sum('total_quantity');
    });

    // Sort the best selling products data in descending order
    $sortedBestSellingProducts = $bestSellingProductsData->sortDesc();

    // Prepare data for the line chart
    $bestSellingLabels = ProductSku::whereIn('id', $sortedBestSellingProducts -> keys()) -> pluck('full_name') -> toArray();
    $bestSellingData = $sortedBestSellingProducts->values()->toArray();
    
    return view('admin.admin_sales_monitoring', [
        'shopeeDates' => $shopeeDates, 
        'shopeeAmounts' => $shopeeAmounts, 
        'lazadaDates' => $lazadaDates, 
        'lazadaAmounts' => $lazadaAmounts, 
        'manualDates' => $manualDates, 
        'manualAmounts' => $manualAmounts,
        'bestSellingLabels' => $bestSellingLabels,
        'bestSellingData' => $bestSellingData,
    ]);
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
