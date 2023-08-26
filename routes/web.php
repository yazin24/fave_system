<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFunctionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\PurchasingFunctionsController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\ReceivingFunctionsController;
use App\Http\Controllers\SalesAgentController;
use App\Http\Controllers\SalesAgentFunctionsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesFunctionsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffFunctionsController;
use App\Http\Middleware\Sales;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


//----------------------------------------------------------INVENTORY-----------------------------------------------------------------
//----------------------------------------------------------INVENTORY-----------------------------------------------------------------


Route::middleware(['auth', 'inventory']) ->group(function(){

    //Inventory Routes Sidebar
Route::get('/stock-monitoring', [InventoryController::class, 'stock_monitoring'])->name('stockmonitoring');

Route::get('/add-item', [InventoryController::class, 'add_item'])->name('additem');

Route::get('/stocks', [InventoryController::class, 'stocks'])->name('stocks');

Route::get('/supplier', [InventoryController::class, 'supplier'])->name('supplier');

Route::get('inventory-history', [InventoryController::class, 'inventory_history'])->name('inventoryhistory');

});



//----------------------------------------------------------PURCHASING-----------------------------------------------------------------
//----------------------------------------------------------PURCHASING-----------------------------------------------------------------


Route::middleware(['auth', 'purchasing']) -> group(function(){

    //Purchasing Routes Sidebar

Route::get('/purchasing/purchase-monitoring', [PurchasingController::class, 'purchase_monitoring'])->name('purchasemonitoring');

Route::get('/purchasing/purchase', [PurchasingController::class, 'purchase'])->name('purchase');

Route::get('/purchasing/all-purchases', [PurchasingController::class, 'all_purchases'])->name('allpurchases');

Route::get('/purchasing/add-supplier', [PurchasingFunctionsController::class, 'add_supplier']) -> name('addsupplier');

Route::get('/purchasing/supplier-list', [PurchasingController::class, 'purchasing_supplier_list'])->name('purchasingsupplierlist');



//Purchasing Routes (Functionalities)


Route::post('/purchasing/purchase-form', [PurchasingFunctionsController::class, 'purchase_show_supplier_items']) -> name('purchaseshowsupplieritems');

Route::post('/purchasing/make-purchase/{id}', [PurchasingFunctionsController::class, 'purchase_order_store']) -> name('purchaseorderstore');

Route::get('/purchasing/view-purchase/{purchase}/view', [PurchasingFunctionsController::class, 'view_purchase_order']) -> name('viewpurchase');

Route::get('/purchasing/generate-receipt/{purchase}', [PurchasingFunctionsController::class, 'generate_po_receipt']) -> name('generatereceipt');

Route::post('/purchasing/all-purchases/show-purchases', [PurchasingFunctionsController::class, 'show_purchases'])-> name('showpurchases');

Route::get('/purchasing/all-purchases/all-purchase-order', [PurchasingFunctionsController::class, 'all_purchases']) -> name('allpurchaseorder');


Route::post('/purchasing/add-supplier/store', [PurchasingFunctionsController::class, 'add_supplier_store']) -> name('addsupplierstore');

Route::get('purchasing/purchase-monitoring/payment-details/{purchase}', [PurchasingFunctionsController::class, 'payment_details']) -> name('paymentdetails');

Route::post('purchasing/purchase-monitoring/payment-details/update-payment-status/{id}', [PurchasingFunctionsController::class, 'update_payment_status']) -> name('updatepaymentstatus');

// Route::get('/purchasing/supplier-list', [PurchasingFunctionsController::class, 'supplier_list']) -> name('supplierlist');

Route::get('purchasing/supplier-list/supplier-details/{supplier}', [PurchasingFunctionsController::class, 'show_supplier_details']) -> name('showsupplierdetails');

});



//----------------------------------------------------------STAFF-----------------------------------------------------------------
//----------------------------------------------------------STAFF-----------------------------------------------------------------


Route::middleware(['auth', 'staff']) -> group(function(){

    //Staff Routes (Sidebar)

Route::get('/staff/all-purchasing', [StaffController::class, 'staff_all_purchases']) -> name('staffallpurchases') -> middleware('staff');


//Staff Routes (Functionalities)

Route::post('staff/all-purchasing/view', [StaffFunctionsController::class, 'staff_show_specific_purchase']) -> name('staffshowspecificpurchase') -> middleware('staff');

Route::get('staff/all-purchasing/view/all', [StaffFunctionsController::class, 'staff_show_all_purchases']) -> name('staffshowallpurchases') -> middleware('staff');

});

//----------------------------------------------------------RECEIVING-----------------------------------------------------------------
//----------------------------------------------------------RECEIVING-----------------------------------------------------------------
Route::middleware(['auth', 'receiving']) -> group(function(){

    //Receiving Siebar

Route::get('receiving/all-products', [ReceivingController::class, 'all_products']) -> name('allproducts');

Route::get('/receiving/receiving-monitoring', [ReceivingController::class, 'received_po_monitoring']) -> name('receivedpomonitoring');

Route::get('receiving/receive-po', [ReceivingController::class, 'receive_po']) -> name('receivepo');

Route::get('receiving/pull-out-monitoring', [ReceivingController::class, 'pull_out_monitoring']) -> name('pulloutmonitoring');

Route::get('/receiving/pull-out-items', [ReceivingController::class, 'pull_out']) -> name('pullout');


//Receiving Functionalities

Route::get('receiving/all-products/input-products', [ReceivingFunctionsController::class, 'product_input']) -> name('productinput');

Route::post('/receiving/products/add-products', [ReceivingFunctionsController::class, 'add_product_sku']) -> name('addproductsku');

Route::get('receiving/all-products/update-stock/{allProduct}', [ReceivingFunctionsController::class, 'update_stock']) -> name('updatestock');

Route::put('receiving/all-products/update-stock/{allProduct}/add', [ReceivingFunctionsController::class, 'add_stock']) -> name('addstock');

Route::get('/receiving/view/purchase-order/{toReceivePurchaseOrder}', [ReceivingFunctionsController::class, 'view_to_be_receive_po']) -> name('viewtobereceivepo');

Route::get('/receiving/receive-po/purchase-order-form', [ReceivingFunctionsController::class, 'receive_po_form']) -> name('receivepoform');

Route::put('receiving/view/purchase-order/receive/save/{id}', [ReceivingFunctionsController::class, 'save_and_receive_po']) -> name('saveandreceivepo');

Route::put('receiving/view/purchase-order/receive/partial/{id}', [ReceivingFunctionsController::class, 'receive_as_partial']) -> name('receiveaspartial');

Route::get('receiving/pul-out-monitoring/pull-out-details/{pullOut}', [ReceivingFunctionsController::class, 'pull_out_details']) -> name('pulloutdetails');

Route::get('/receiving/receive-po/view-details-received/{receivedPurchaseOrder}', [ReceivingFunctionsController::class, 'view_received']) -> name('viewreceived');

Route::post('/receiving/pull-out-items/submit/form', [ReceivingFunctionsController::class, 'pull_out_items']) -> name('pulloutitems');

});


//----------------------------------------------------------SALES-----------------------------------------------------------------
//----------------------------------------------------------SALES-----------------------------------------------------------------

Route::middleware(['auth', 'sales']) -> group(function(){

//Sales Sidebar

Route::get('sales/sales-monitoring', [SalesController::class, 'sales_monitoring']) -> name('salesmonitoring');

Route::get('sales/shopee/lazada', [SalesController::class, 'shopee_lazada_sales']) -> name('shopeelazadasales');

Route::get('sales/purchase-orders', [SalesController::class, 'sales_purchase_orders']) -> name('salespurchaseorders');

Route::get('sales/manual_po', [SalesController::class, 'sales_manual_po']) -> name('salesmanualpo');

Route::get('sales/for-approval', [SalesController::class, 'for_approval']) -> name('forapproval');

Route::get('sales/agent-monitoring', [SalesController::class, 'agent_monitoring']) -> name('agentmonitoring');

//Sales Functionalities

Route::get('sales/agent-monitoring/new-agent', [SalesFunctionsController::class, 'new_agent']) -> name('newagent');

Route::post('sales/agent-monitoring/new-agent/add', [SalesFunctionsController::class, 'add_agent']) -> name('addagent');

Route::get('sales/shopee/lazada/shopee-form', [SalesFunctionsController::class, 'shopee_sales_form']) -> name('shopeesalesform');

Route::post('sales/shopee/lazada/shopee-form/add-shopee-sales', [SalesFunctionsController::class, 'add_shopee_sales']) -> name('addshopeesales');

Route::get('sales/shopee/lazada/view-shopee-order/{shopeeSale}', [SalesFunctionsController::class, 'shopee_order_details']) -> name('shopeeorderdetails');

Route::put('sales/shopee/lazada/view-shopee-order/{shopeeSale}/delivered-status', [SalesFunctionsController::class, 'delivered_shopee_status']) -> name('deliveredshopeestatus');

Route::get('sales/shopee/lazada/lazada-form', [SalesFunctionsController::class, 'lazada_sales_form']) -> name('lazadasalesform');

Route::post('sales/shopee/lazada/lazada-form/add-lazada-sales', [SalesFunctionsController::class, 'add_lazada_sales']) -> name('addlazadasales');

Route::get('sales/shopee/lazada/view-lazada-order/{lazadaSale}',[SalesFunctionsController::class, 'lazada_order_details']) -> name('lazadaorderdetails');

Route::get('sales/manual-po/new-purchase-order', [SalesFunctionsController::class, 'manual_purchase_order']) -> name('manualpurchaseorder');

Route::get('sales/manual-po/view-details/{manualPurchase}', [SalesFunctionsController::class, 'view_manual_po']) -> name('viewmanualpo');

Route::post('sales/manual-po/view-details/{manualPurchase}/approved', [SalesFunctionsController::class, 'approve_manual']) -> name('approvemanual');

Route::post('sales/manual-po/view-details/{manualPurchase}/disapproved', [SalesFunctionsController::class, 'disapprove_manual']) -> name('disapprovemanual');

Route::get('sales/manual/view-details/{manualPurchase}/generate-manual-receipt', [SalesFunctionsController::class, 'manual_receipt']) -> name('manualreceipt');

Route::post('sales/manual-po/new-purchase-order/create-new',[SalesFunctionsController::class, 'create_customer_po']) -> name('createcustomerpo');

Route::get('sales/purchase-orders/view-details/{purchaseOrder}', [SalesFunctionsController::class, 'view_purchase_details']) -> name('viewpurchasedetails');

Route::get('sales/for-approval/view-approve-details/{purchaseOrder}', [SalesFunctionsController::class, 'view_approve_po']) -> name('viewapprovepo');

Route::post('sales/for-approval/view-approve-details/{purchaseOrder}/approve',[SalesFunctionsController::class, 'approve_purchase_order']) -> name('approvepurchaseorder');

Route::post('sales/for-approval/view-approve-details/{purchaseOrder}/disapprove', [SalesFunctionsController::class, 'disapprove_purchase_order']) -> name('disapprovepurchaseorder');

Route::get('sales/purchase-orders/view-details/{purchaseOrder}/generate-receipt', [SalesFunctionsController::class, 'generate_po_receipt']) -> name('generatecsreceipt');

Route::get('sales/agent-monitoring/agent/{agent}', [SalesFunctionsController::class, 'agent_details']) -> name('agentdetails');

Route::get('sales/agent-monitoring/agent/{agent}/view/customer/{agentCustomer}', [SalesFunctionsController::class, 'agent_customer_details']) -> name('agentcustomerdetails');

});

//----------------------------------------------------------SALES AGENT-----------------------------------------------------------------
//----------------------------------------------------------SALES AGENT-----------------------------------------------------------------

Route::middleware(['auth', 'sales_agent']) -> group(function(){

//Sales Agent Sidebar

Route::get('sales-agent/sales-monitoring', [SalesAgentController::class, 'sales_agent_monitoring']) -> name('salesagentmonitoring');

Route::get('sales/agent-list', [SalesAgentController::class, 'agent_list']) -> name('agentlist');

//Sales Agent Functionalities

Route::get('sales-agent/agent-list/enter-password/{agent}', [SalesAgentFunctionsController::class, 'enter_password']) -> name('enterpassword');

Route::post('sales-agent/agent-list/password-verified/{agent}', [SalesAgentFunctionsController::class, 'verify_password']) -> name('verifypassword');

Route::get('sales-agent/agent-list/view-dashboard/{agent}', [SalesAgentFunctionsController::class, 'view_dashboard']) -> name('viewdashboard');

Route::get('sales-agent/agent-list/view-dashboard/{agent}/sales-monitoring', [SalesAgentFunctionsController::class, 'agent_sales_monitoring']) -> name('agentsalesmonitoring');

Route::get('sales-agent/agent-list/view-dashboard/{agent}/customer-list', [SalesAgentFunctionsController::class, 'customer_list']) -> name('customerlist');

Route::get('sales-agent/agent-list/viewdashboard/{agent}/new-customer', [SalesAgentFunctionsController::class, 'new_customer']) -> name('newcustomer');

Route::post('sales-agent/agent-list/view-dashboard/{agent}/new-customer/add', [SalesAgentFunctionsController::class, 'add_customer']) -> name('addcustomer');

Route::get('sales-agent/agent-list/view-dashboard/{agent}/request-po', [SalesAgentFunctionsController::class, 'request_po']) -> name('requestpo');

Route::post('sales-agent/agent-list/view-dashboard/{agent}/create-po', [SalesAgentFunctionsController::class, 'create_po']) -> name('createpo');

Route::get('sales-agent/agent-list/view-dashboard/{agent}/view/customer-stocks/{customer}', [SalesAgentFunctionsController::class, 'view_customers_stocks']) -> name('viewcustomersstocks');

});


//----------------------------------------------------------ADMIN-----------------------------------------------------------------
//----------------------------------------------------------ADMIN-----------------------------------------------------------------

Route::middleware(['auth', 'admin']) -> group(function(){

    //Admin Routes Sidebar

Route::get('/admin/sales-monitoring', [AdminController::class, 'admin_sales_monitoring']) -> name('adminsalesmonitoring');

Route::get('/admin/purchasing-monitoring', [AdminController::class, 'admin_purchasing_monitoring']) -> name('adminpurchasingmonitoring');

Route::get('admin/purchase-approval', [AdminController::class, 'admin_purchase_approval']) -> name('adminpurchaseapproval');

Route::get('admin/add-supplier', [AdminController::class, 'admin_add_supplier']) -> name('adminaddsupplier');

Route::get('admin/supplier-list', [AdminController::class, 'admin_supplier_list']) -> name('adminsupplierlist');

Route::get('admin/unpurchase-order', [AdminController::class, 'admin_unpurchase']) -> name('adminunpurchase');

Route::get('admin/products', [AdminController::class, 'admin_all_products']) -> name('adminallproducts');

Route::get('/admin/stock-monitoring', [AdminController::class, 'admin_stock_monitoring']) -> name('adminstockmonitoring');

Route::get('/admin/outgoing-stocks', [AdminController::class, 'admin_outgoing_stocks']) -> name('adminoutgoingstocks');

//Admin Routes (Functionalities)

//Route::get('/')

//Route::get('/admin/purchase-monitoring/edit', [AdminPurchasingMonitoringController::class, 'admin_purchase_order_edit']) -> name('adminpurchaseorderedit');

Route::get('admin/purchasing-monitoring/search', [AdminFunctionsController::class, 'admin_search']) -> name('adminsearch');

Route::delete('/admin/purchasing-monitoring/delete/{id}', [AdminFunctionsController::class, 'admin_purchase_order_delete']) -> name('adminpurchaseorderdelete');

Route::get('/admin/purchase-monitoring/view-purchase/{allPurchaseOrder}', [AdminFunctionsController::class, 'admin_view_purchase']) -> name('adminviewpurchase');

Route::post('admin/supplier-list/items', [AdminFunctionsController::class, 'admin_show_suppliers_items']) -> name('adminshowsuppliersitems');

Route::get('/admin/purchase-approval/view-details/{queuePurchase}', [AdminFunctionsController::class, 'admin_purchase_order_approval']) -> name('adminpurchaseorderapproval');

Route::get('admin/supplier-list/supplier-details/{supplier}', [AdminFunctionsController::class, 'admin_supplier_details']) -> name('adminsupplierdetails');

Route::post('admin/purchase-approval/view-details/approve/{id}', [AdminFunctionsController::class, 'admin_approve_purchase']) -> name('adminapprovepurchase');

Route::post('admin/purchase-approval/view-details/disapprove/{id}', [AdminFunctionsController::class, 'admin_disapprove_purchase']) -> name('admindisapprovepurchase');

Route::get('admin/products/input-products', [AdminFunctionsController::class, 'admin_input_products']) -> name('admininputproducts');

Route::post('admin/products/input-products/add-new', [AdminFunctionsController::class, 'admin_add_products']) -> name('adminaddproducts');

Route::get('/admin/purchasing-monitoring/generate-receipt/{allPurchaseOrder}', [AdminFunctionsController::class, 'admin_generate_po_receipt']) -> name('admingeneratereceipt');

Route::delete('admin/unpurchase-order/{id}', [AdminFunctionsController::class, 'admin_delete_unpurchase']) -> name('admindeleteunpurchase');

Route::get('admin/outgoing-stocks/pull-out-items/details/{pullOutItem}', [AdminFunctionsController::class, 'admin_pull_out_items']) -> name('adminpulloutitems');

});

Route::delete('admin/supplier-list/delete/{id}', [AdminFunctionsController::class, 'admin_delete_supplier']) -> name('admindeletesupplier');










