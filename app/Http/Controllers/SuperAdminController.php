<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllItems;
use App\Models\LazadaOrderProducts;
use App\Models\LazadaSales;
use App\Models\ManualPurchaseOrderProducts;
use App\Models\ManualPurchaseOrderSales;
use App\Models\ManufacturingStorage;
use App\Models\ProductSku;
use App\Models\PurchaseOrder;
use App\Models\ShopeeOrderProducts;
use App\Models\ShopeeSales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
          //this get the current date 
          $currentDate = Carbon::now() -> toDateString();

          //this count the number of P.O made in the day
          $totalPurchase = DB::table('purchase_orders')
                          -> whereDate('created_at', '=', $currentDate)
                          -> count('po_number');
  
          //this code get the sum of amount of the P.O of the current date
          $totalAmount = DB::table('purchase_order_items')
                          -> whereDate('created_at', '=', $currentDate)
                          -> sum('amount');
  
           // the purchase order has a status of queued. the id of queued is 3 hence i use the 3 in the query builder               
          $purchaseQueue = PurchaseOrder::where('status', '3')
                          ->count('po_number');
  
          $undeliveredPurchase = PurchaseOrder::where('del_status', 7)
                                  ->count('del_status');
  
               //this code get all the data in the purchase_orders to be display in the table for the current date
          $purchases = PurchaseOrder::with('purchaseOrderSupplier', 'systemStatus')
                      ->where(function ($query) {
                      // Status = 3 (Queued) and Payment Status = 0 (Unpaid)
                      $query->where('status', 3)->where('payment_status', 0);
                  })
                      ->orWhere(function ($query) {
                      // Status = 1 (Approved) and Payment Status = 0 (Unpaid)
                       $query->where('status', 1)->where('payment_status', 0);
                  })
                      ->orWhere(function ($query) {
                      // Status = 3 (Queued) and Payment Status = 1 (Paid)
                      $query->where('status', 3)->where('payment_status', 1);
                  })
                      ->orWhere(function ($query) {
                      // Status = 1 (Approved) and Payment Status = 1 (Paid)
                      $query->where('status', 1)->where('payment_status', 1);
                  })
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
  
                      $dateNow = Carbon::now();
                      foreach ($purchases as $purchase) {
                          $dueDate = Carbon::parse($purchase->purchaseOrderTerms->due_date);
                          $daysDiff = $dueDate->diffInDays($dateNow);
                              
  
                          $purchase->dueDateColorClass = '';
                      
                          $purchase->daysDiff = $daysDiff;
                      }
          
          return view('superadmin.purchasing_monitoring', [
              'purchases' => $purchases, 
              'totalPurchase' => $totalPurchase, 
              'totalAmount' => $totalAmount,
              'purchaseQueue' => $purchaseQueue,
              'undeliveredPurchase' => $undeliveredPurchase,
          ]);
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
        $rawMaterials = AllItems::paginate(10);

        return view('superadmin.raw_materials_monitoring', ['rawMaterials' => $rawMaterials]);
    }

    public function manufacturing_storage_monitoring()
    {
        $storageSkus = ManufacturingStorage::all();

        return view('superadmin.manufacturing_storage_monitoring', ['storageSkus' => $storageSkus]);
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
