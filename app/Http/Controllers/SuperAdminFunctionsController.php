<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LazadaOrders;
use App\Models\ManualPurchaseOrder;
use App\Models\ProductSku;
use App\Models\PurchaseOrder;
use App\Models\ShopeeOrders;
use App\Models\TiktokOrders;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function sales_tiktok_monitoring()
    {
        $allTiktokOrders = TiktokOrders::orderBy('created_at', 'desc') -> paginate(10);

        return view('superadmin.sales_tiktok_monitoring', ['allTiktokOrders' => $allTiktokOrders]);
    }

    public function tiktok_order_details_to_edit(TiktokOrders $tiktokOrder)
    {
        $totalOrderAmount = $tiktokOrder -> tiktokOrderProducts() -> sum('amount');

        return view('superadmin.tiktok_order_details_to_edit', ['tiktokOrder' => $tiktokOrder, 'totalOrderAmount' => $totalOrderAmount]);
    }

    public function view_details_purchasing_order(PurchaseOrder $purchase)
    {   
        $totalOrderAmount = $purchase -> purchaseOrderItems() -> sum('amount');

        return view('superadmin.view_details_purchasing_order', ['purchase' => $purchase, 'totalOrderAmount' => $totalOrderAmount]);
    }

    public function purchasing_order_delete(PurchaseOrder $purchase)
    {
        $deletePurchase = PurchaseOrder::findOrFail($purchase -> id);

        $deletePurchase -> delete();

        return redirect(route('purchasingmonitoring')) -> with('success', 'Purchase order has been deleted!');
    }

    public function superadmin_approve_po(PurchaseOrder $purchase)
    {
        $status = 1;

        $name = Auth::user() -> name;

        $purchase -> update([
            'status' => $status,
            'approved_by' => $name,
        ]);

        $purchase -> save();

        Session::flash('success', 'Purchase order has been approved!');
        return view('superadmin.purchasing_monitoring');
    }

    public function product_logs_view(ProductSku $allProduct)
    {
        $productLogs = [];

        $addStockQuantity = $allProduct -> addStockProductHistory()
         -> select('created_at', 'quantity')
         -> get();

         foreach($addStockQuantity as $addStock){
            $productLogs[] = [
                'date' => $addStock -> created_at,
                'action' => 'Added Stock',
                'quantity' => $addStock -> quantity,
            ];
         }

        // Retrieve Shopee order transaction details
        $shopeeOrderDetails = $allProduct->shopeeOrderProducts()
            ->select('created_at', 'quantity')
            ->get();
    
        foreach ($shopeeOrderDetails as $shopeeOrder) {
            $productLogs[] = [
                'date' => $shopeeOrder->created_at,
                'action' => 'Shopee Order',
                'quantity' => -$shopeeOrder->quantity, // Deduction
            ];
        }
    
        // Retrieve Lazada order transaction details
        $lazadaOrderDetails = $allProduct->lazadaOrderProducts()
            ->select('created_at', 'quantity')
            ->get();
    
        foreach ($lazadaOrderDetails as $lazadaOrder) {
            $productLogs[] = [
                'date' => $lazadaOrder->created_at,
                'action' => 'Lazada Order',
                'quantity' => -$lazadaOrder->quantity, // Deduction
            ];
        }
    
        // Retrieve manual purchase order transaction details
        $manualPurchaseOrderDetails = $allProduct->manualPurchaseOrderProducts()
            ->select('created_at', 'quantity', 'isBox')
            ->get();
    
        foreach ($manualPurchaseOrderDetails as $manualPurchaseOrder) {
            $quantity = $manualPurchaseOrder->quantity;
    
            if ($manualPurchaseOrder->isBox == 1) {
                
                if ($allProduct->sku_size == 3785.41) {
                    $quantity *= 4;
    
                } elseif ($allProduct->sku_size == 1000) {
                    $quantity *= 12;
    
                }elseif ($allProduct->sku_size == 900) { 
                    $quantity *= 40;
    
                }elseif ($allProduct->sku_size == 180) {   
                    $quantity *= 40;
                }
                
            }
            $productLogs[] = [
                'date' => $manualPurchaseOrder->created_at,
                'action' => 'Manual Purchase',
                'quantity' => -$quantity,
            ];
        }
    
        // Sort the productLogs by date in descending order
        usort($productLogs, function ($a, $b) {
            return $b['date'] <=> $a['date'];
        });
    
        $perPage = 10; // Set the number of items per page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($productLogs, ($currentPage - 1) * $perPage, $perPage);
        $productLogs = new LengthAwarePaginator($currentItems, count($productLogs), $perPage);
        $productLogs->setPath(route('viewproductlogs', ['allProduct' => $allProduct->id]));

        return view('superadmin.product_logs_view', ['allProduct' => $allProduct, 'productLogs' => $productLogs]);
    }

   
}
