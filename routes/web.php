<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFunctionsController;
use App\Http\Controllers\EcommerceController;
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
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminFunctionsController;
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


//----------------------------------------------------------ECOMMERCE-----------------------------------------------------------------
//----------------------------------------------------------ECOMMERCE-----------------------------------------------------------------


Route::get('/home', [EcommerceController::class, 'home_page']) -> name('homepage');

Route::get('/products', [EcommerceController::class, 'product_page']) -> name('productpage');

Route::get('/services', [EcommerceController::class, 'service_page']) -> name('servicepage');

Route::get('/about-us', [EcommerceController::class, 'about_us_page']) -> name('aboutuspage');

Route::get('/login', [EcommerceController::class, 'login_page']) -> name('loginpage');


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

Route::get('/receiving/receiving-monitoring', [ReceivingController::class, 'received_po_monitoring']) -> name('receivedpomonitoring');

Route::get('receiving/receive-po', [ReceivingController::class, 'receive_po']) -> name('receivepo');

Route::get('receiving/pull-out-monitoring', [ReceivingController::class, 'pull_out_monitoring']) -> name('pulloutmonitoring');

Route::get('/receiving/pull-out-items', [ReceivingController::class, 'pull_out']) -> name('pullout');

Route::get('receiving/manufacturing-storage', [ReceivingController::class, 'manufacturing_storage']) -> name('manufacturingstorage');

Route::get('receiving/all-products', [ReceivingController::class, 'all_products']) -> name('allproducts');

Route::get('receiving/raw-materials', [ReceivingController::class, 'raw_materials']) -> name('rawmaterials');


//Receiving Functionalities

Route::get('receiving/all-products/input-products', [ReceivingFunctionsController::class, 'product_input']) -> name('productinput');

Route::post('/receiving/products/add-products', [ReceivingFunctionsController::class, 'add_product_sku']) -> name('addproductsku');

Route::get('receiving/raw-materials/add-new-raw', [ReceivingFunctionsController::class, 'new_raw_materials']) -> name('newrawmaterials');

Route::post('receiving/raw-materials/add-new-raw/add', [ReceivingFunctionsController::class, 'add_new_raw_materials']) -> name('addnewrawmaterials');

Route::get('receiving/all-products/view/log/history/{allProduct}', [ReceivingFunctionsController::class, 'view_product_logs']) -> name('viewproductlogs');

Route::get('receiving/all-products/update-stock/{allProduct}', [ReceivingFunctionsController::class, 'update_stock']) -> name('updatestock');

Route::put('receiving/all-products/update-stock/{allProduct}/add', [ReceivingFunctionsController::class, 'add_stock']) -> name('addstock');

Route::get('/receiving/view/purchase-order/{toReceivePurchaseOrder}', [ReceivingFunctionsController::class, 'view_to_be_receive_po']) -> name('viewtobereceivepo');

Route::get('/receiving/receive-po/purchase-order-form', [ReceivingFunctionsController::class, 'receive_po_form']) -> name('receivepoform');

Route::put('receiving/view/purchase-order/receive/save/{id}', [ReceivingFunctionsController::class, 'save_and_receive_po']) -> name('saveandreceivepo');

Route::put('receiving/view/purchase-order/receive/partial/{id}', [ReceivingFunctionsController::class, 'receive_as_partial']) -> name('receiveaspartial');

Route::get('receiving/pul-out-monitoring/pull-out-details/{pullOut}', [ReceivingFunctionsController::class, 'pull_out_details']) -> name('pulloutdetails');

Route::get('/receiving/receive-po/view-details-received/{receivedPurchaseOrder}', [ReceivingFunctionsController::class, 'view_received']) -> name('viewreceived');

Route::post('/receiving/pull-out-items/submit/form', [ReceivingFunctionsController::class, 'pull_out_items']) -> name('pulloutitems');

Route::get('/receiving/manufacturing-storage/view-sku-storage-details/{storageSku}', [ReceivingFunctionsController::class, 'storage_sku_details']) -> name('storageskudetails');

Route::get('/receiving/manufacturing-storage/output-form/view/{storageSku}', [ReceivingFunctionsController::class, 'storage_output_form']) -> name('storageoutputform');

Route::put('/receiving/manufacturing-storage/output-form/view/{storageSku}/update-quantity', [ReceivingFunctionsController::class, 'storage_sku_update']) -> name('storageskuupdate');

Route::get('/receiving/manufacturing-storage/view-storage-details/view-log-history/{storageSku}', [ReceivingFunctionsController::class, 'storage_sku_log']) -> name('storageskulog');

Route::get('receiving/raw-materials/view/history/{rawMaterial}', [ReceivingFunctionsController::class, 'raw_materials_view_details']) -> name('rawmaterialsviewdetails');

});


//----------------------------------------------------------SALES-----------------------------------------------------------------
//----------------------------------------------------------SALES-----------------------------------------------------------------

Route::middleware(['auth', 'sales']) -> group(function(){

//Sales Sidebar

Route::get('sales/sales-monitoring', [SalesController::class, 'sales_monitoring']) -> name('salesmonitoring');

Route::get('sales/shopee/lazada', [SalesController::class, 'shopee_lazada_sales']) -> name('shopeelazadasales');

Route::get('sales/tiktok/carousel', [SalesController::class, 'tiktok_carousel_sales']) -> name('tiktokcarouselsales');

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

Route::put('sales/shopee/lazada/view-lazada-order/{lazadaSale}/delivered-status', [SalesFunctionsController::class, 'delivered_lazada_status']) -> name('deliveredlazadastatus');

Route::get('sales/tiktok/carousel/carousel-form', [SalesFunctionsController::class, 'carousel_sales_form']) -> name('carouselsalesform');

Route::get('sales/tiktok/carousel/tiktok-form', [SalesFunctionsController::class, 'tiktok_sales_form']) -> name('tiktoksalesform');

Route::post('sales/tiktok/carousel/tiktok-form/add-tiktok-sales', [SalesFunctionsController::class, 'add_tiktok_sales']) -> name('addtiktoksales');

Route::get('sales/tiktok/carousel/view-tiktok-order/{tiktokSale}', [SalesFunctionsController::class, 'tiktok_order_details']) -> name('tiktokorderdetails');

Route::put('sales/tiktok/carousel/view-tiktok-order/{tiktokSale}/delivered-status', [SalesFunctionsController::class, 'delivered_tiktok_status']) -> name('deliveredtiktokstatus');

Route::get('sales/manual-po/new-purchase-order', [SalesFunctionsController::class, 'manual_purchase_order']) -> name('manualpurchaseorder');

Route::get('sales/manual-po/view-details/{manualPurchase}', [SalesFunctionsController::class, 'view_manual_po']) -> name('viewmanualpo');

Route::post('sales/manual-po/view-details/{manualPurchase}/approved', [SalesFunctionsController::class, 'approve_manual']) -> name('approvemanual');

Route::post('sales/manual-po/view-details/{manualPurchase}/disapproved', [SalesFunctionsController::class, 'disapprove_manual']) -> name('disapprovemanual');

Route::put('sales/manual-po/view-details/{manualPurchase}/update-del-status', [SalesFunctionsController::class, 'update_del_status_manual']) -> name('updatedelstatusmanual');

Route::get('sales/manual/view-details/{manualPurchase}/generate-manual-receipt', [SalesFunctionsController::class, 'manual_receipt']) -> name('manualreceipt');

Route::post('sales/manual-po/new-purchase-order/create-new',[SalesFunctionsController::class, 'create_customer_po']) -> name('createcustomerpo');

Route::get('sales/purchase-orders/view-details/{purchaseOrder}', [SalesFunctionsController::class, 'view_purchase_details']) -> name('viewpurchasedetails');

Route::get('sales/for-approval/view-approve-details/{purchaseOrder}', [SalesFunctionsController::class, 'view_approve_po']) -> name('viewapprovepo');

Route::put('sales/purchase-orders/view-details/{purchaseOrder}/update-del-status', [SalesFunctionsController::class, 'update_del_status_cs_po']) -> name('updatedelstatuscspo');

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

Route::get('admin/products/view/log/history/{allProduct}', [AdminFunctionsController::class, 'admin_view_product_logs']) -> name('adminviewproductlogs');

Route::post('admin/products/input-products/add-new', [AdminFunctionsController::class, 'admin_add_products']) -> name('adminaddproducts');

Route::get('/admin/purchasing-monitoring/generate-receipt/{allPurchaseOrder}', [AdminFunctionsController::class, 'admin_generate_po_receipt']) -> name('admingeneratereceipt');

Route::delete('admin/unpurchase-order/{id}', [AdminFunctionsController::class, 'admin_delete_unpurchase']) -> name('admindeleteunpurchase');

Route::get('/admin/stock-monitoring/view/log/history/{stock}', [AdminFunctionsController::class, 'view_stock_history']) -> name('viewstockhistory');

Route::get('admin/outgoing-stocks/pull-out-items/details/{pullOutItem}', [AdminFunctionsController::class, 'admin_pull_out_items']) -> name('adminpulloutitems');

});


//----------------------------------------------------------SUPER ADMIN-----------------------------------------------------------------
//----------------------------------------------------------SUPER ADMIN-----------------------------------------------------------------

Route::middleware(['auth', 'superadmin']) -> group(function(){


    //Super Admin Routes Sidebar

    Route::get('super-admin/sales-monitoring', [SuperAdminController::class, 'superadmin_sales_monitoring']) -> name('superadminsalesmonitoring');

    Route::get('super-admin/purchasing-monitoring', [SuperAdminController::class, 'purchasing_monitoring']) -> name('purchasingmonitoring');

    Route::get('super-admin/receiving-monitoring', [SuperAdminController::class, 'receiving_monitoring']) -> name('receivingmonitoring');

    Route::get('super-admin/suppliers-monitoring', [SuperAdminController::class, 'suppliers_monitoring']) -> name('suppliersmonitoring');

    Route::get('super-admin/products-monitoring', [SuperAdminController::class, 'products_monitoring']) -> name('productsmonitoring');

    Route::get('super-admin/raw-materials-monitoring', [SuperAdminController::class, 'raw_materials_monitoring']) -> name('rawmaterialsmonitoring');

    Route::get('super-admin/manufacturing-storage-monitoring', [SuperAdminController::class, 'manufacturing_storage_monitoring']) -> name('manufacturingstoragemonitoring');

    Route::get('super-admin/agents-monitoring', [SuperAdminController::class, 'agents_monitoring']) -> name('agentsmonitoring');

    Route::get('super-admin/agent-customer-monitoring', [SuperAdminController::class, 'agent_customer_monitoring']) -> name('agentcustomermonitoring');



    //Super Admin Functionalities

    Route::get('super-admin/sales-monitoring/manual-monitoring', [SuperAdminFunctionsController::class, 'sales_manual_monitoring']) -> name('salesmanualmonitoring');

    Route::get('super-admin/sales-monitoring/manual-monitoring/{manualOrder}', [SuperAdminFunctionsController::class, 'manual_order_details_to_edit']) -> name('manualorderdetailstoedit');

    Route::delete('super-admin/sales-monitoring/manual-monitoring/delete/{manualOrder}', [SuperAdminFunctionsController::class, 'manual_order_delete']) -> name('manualorderdelete');

    Route::get('super-admin/sales-monitoring/shopee-monitoring', [SuperAdminFunctionsController::class, 'sales_shopee_monitoring']) -> name('salesshopeemonitoring');

    Route::get('super-admin/sales-monitoring/shopee-monitoring/{shopeeOrder}', [SuperAdminFunctionsController::class, 'shopee_order_details_to_edit']) -> name('shopeeorderdetailstoedit');

    Route::delete('super-admin/sales-monitoring/shopee-monitoring/delete/{shopeeOrder}', [SuperAdminFunctionsController::class, 'shopee_order_delete']) -> name('shopeeorderdelete');

    Route::get('super-admin/sales-monitoring/lazada-monitoring', [SuperAdminFunctionsController::class, 'sales_lazada_monitoring']) -> name('saleslazadamonitoring');

    Route::get('super-admin/sales-monitoring/lazada-monitoring/{lazadaOrder}', [SuperAdminFunctionsController::class, 'lazada_order_details_to_edit']) -> name('lazadaorderdetailstoedit');

    Route::delete('super-admin/sales-monitoring/lazada-monitoring/delete/{lazadaOrder}', [SuperAdminFunctionsController::class, 'lazada_order_delete']) -> name('lazadaorderdelete');

    Route::get('super-admin/sales-monitoring/tiktok-monitoring', [SuperAdminFunctionsController::class, 'sales_tiktok_monitoring']) -> name('salestiktokmonitoring');

    Route::get('super-admin/sales-monitoring/tiktok-monitoring/{tiktokOrder}', [SuperAdminFunctionsController::class, 'tiktok_order_details_to_edit']) -> name('tiktokorderdetailstoedit');

    Route::get('super-admin/purchasing-monitoring/view-purchasing-order/{purchase}', [SuperAdminFunctionsController::class, 'view_details_purchasing_order']) -> name('viewdetailspurchasingorder');

    Route::put('super-admin/purchasing-monitoring/view-purchasing-order/{purchase}/approve', [SuperAdminFunctionsController::class, 'superadmin_approve_po']) -> name('superadminapprovepo');

    Route::get('super-admin/receiving-monitoring/view/{receivedPurchaseOrder}', [SuperAdminFunctionsController::class, 'view_details_receive_po']) -> name('viewdetailsreceivepo');

    Route::get('super-admin/supplier-monitoring/view/{supplier}', [SuperAdminFunctionsController::class, 'supplier_details_view']) -> name('supplierdetailsview');

    Route::delete('super-admin/purchasing-monitoring/delete/{purchase}', [SuperAdminFunctionsController::class, 'purchasing_order_delete']) -> name('purchasingorderdelete');

    Route::get('super-admin/products-monitoring/view/{allProduct}', [SuperAdminFunctionsController::class, 'product_logs_view']) -> name('productlogsview');

    Route::get('super-admin/products-monitoring/view/{allProduct}/add-stock-form', [SuperAdminFunctionsController::class, 'add_stock_form']) -> name('addstockform');

    Route::put('super-admin/products-monitoring/view/{allProduct}/add-stock-form/add-now', [SuperAdminFunctionsController::class, 'add_stock_store']) -> name('addstockstore');

    Route::get('super-admin/raw-materials-monitoring/add-new', [SuperAdminFunctionsController::class, 'add_new_raw_materials']) -> name('addnewrawmaterials');

    Route::post('super-admin/raw-materials/add-new/add-now', [SuperAdminFunctionsController::class, 'add_new_raw_materials_store']) -> name('addnewrawmaterialsstore');

    Route::get('super-admin/raw-materials-monitoring/view/raw-details/{rawMaterial}', [SuperAdminFunctionsController::class, 'view_raw_materials_info']) -> name('viewrawmaterialsinfo');

    Route::get('super-admin/manufacturing-storage-monitoring/{storageSku}/view', [SuperAdminFunctionsController::class, 'view_storage_sku_details']) -> name('viewstorageskudetails');

    Route::get('super-admin/manufacturing-storage-monitoring/{storageSku}/view/log/history', [SuperAdminFunctionsController::class, 'storage_sku_view_logs']) -> name('storageskuviewlogs');

    Route::get('super-admin/manufacturing-storage-monitoring/view/{storageSku}/update-form', [SuperAdminFunctionsController::class, 'storage_sku_update_form']) -> name('storageskuupdateform');

    Route::put('super-admin/manufacturing-storage-monitoring/view/{storageSku}/update-form/update-now', [SuperAdminFunctionsController::class, 'storage_sku_update_store']) -> name('storageskuupdatestore');

});










