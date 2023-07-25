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
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffFunctionsController;
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

Route::get('/purchasing/supplier-list', [PurchasingController::class, 'purchasing_supplier_list'])->name('purchasingsupplierlist');


//Purchasing Routes (Functionalities)


Route::post('/purchasing/purchase-form', [PurchasingFunctionsController::class, 'purchase_show_supplier_items']) -> name('purchaseshowsupplieritems');

Route::post('/purchasing/make-purchase', [PurchasingFunctionsController::class, 'purchase_order_store']) -> name('purchaseorderstore');

Route::get('/purchasing/view-purchase/{purchase}/view', [PurchasingFunctionsController::class, 'view_purchase_order']) -> name('viewpurchase');

Route::get('/purchasing/generate-receipt/{purchase}', [PurchasingFunctionsController::class, 'generate_po_receipt']) -> name('generatereceipt');

Route::post('/purchasing/all-purchases/show-purchases', [PurchasingFunctionsController::class, 'show_purchases'])-> name('showpurchases');

Route::get('/purchasing/all-purchases/all-purchase-order', [PurchasingFunctionsController::class, 'all_purchases']) -> name('allpurchaseorder');

Route::get('/purchasing/add-supplier', [PurchasingFunctionsController::class, 'add_supplier']) -> name('addsupplier');

Route::post('/purchasing/add-supplier/store', [PurchasingFunctionsController::class, 'add_supplier_store']) -> name('addsupplierstore');

Route::post('purchasing/purchase-monitoring/update-payment-status/{id}', [PurchasingFunctionsController::class, 'update_payment_status']) -> name('updatepaymentstatus');

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


Route::get('/receiving/receiving-monitoring', [ReceivingController::class, 'received_po_monitoring']) -> name('receivedpomonitoring');

Route::get('receiving/receive-po', [ReceivingController::class, 'receive_po']) -> name('receivepo');

Route::get('/receiving/view/purchase-order/{toReceivePurchaseOrder}', [ReceivingFunctionsController::class, 'view_to_be_receive_po']) -> name('viewtobereceivepo');

Route::get('/receiving/receive-po/purchase-order-form', [ReceivingFunctionsController::class, 'receive_po_form']) -> name('receivepoform');

Route::put('receiving/view/purchase-order/receive/save/{id}', [ReceivingFunctionsController::class, 'save_and_receive_po']) -> name('saveandreceivepo');

//----------------------------------------------------------ADMIN-----------------------------------------------------------------
//----------------------------------------------------------ADMIN-----------------------------------------------------------------

Route::middleware(['auth', 'admin']) -> group(function(){

    //Admin Routes Sidebar

Route::get('/admin/purchasing-monitoring', [AdminController::class, 'admin_purchasing_monitoring']) -> name('adminpurchasingmonitoring');

Route::get('admin/purchase-approval', [AdminController::class, 'admin_purchase_approval']) -> name('adminpurchaseapproval');

Route::get('admin/add-supplier', [AdminController::class, 'admin_add_supplier']) -> name('adminaddsupplier');

Route::get('admin/supplier-list', [AdminController::class, 'admin_supplier_list']) -> name('adminsupplierlist');

Route::get('admin/unpurchase-order', [AdminController::class, 'admin_unpurchase']) -> name('adminunpurchase');

//Admin Routes (Functionalities)

//Route::get('/')

//Route::get('/admin/purchase-monitoring/edit', [AdminPurchasingMonitoringController::class, 'admin_purchase_order_edit']) -> name('adminpurchaseorderedit');

Route::get('admin/purchasing-monitoring/search', [AdminFunctionsController::class, 'admin_search']) -> name('adminsearch');

Route::delete('/admin/purchasing-monitoring/delete/{id}', [AdminFunctionsController::class, 'admin_purchase_order_delete']) -> name('adminpurchaseorderdelete');

Route::get('/admin/purchase-monitoring/view-purchase/{allPurchaseOrder}', [AdminFunctionsController::class, 'admin_view_purchase']) -> name('adminviewpurchase');

Route::post('admin/supplier-list/items', [AdminFunctionsController::class, 'admin_show_suppliers_items']) -> name('adminshowsuppliersitems');

Route::get('/admin/purchase-approval/view-details/{queuePurchase}', [AdminFunctionsController::class, 'admin_purchase_order_approval']) -> name('adminpurchaseorderapproval');

Route::post('admin/purchase-approval/view-details/approve/{id}', [AdminFunctionsController::class, 'admin_approve_purchase']) -> name('adminapprovepurchase');

Route::post('admin/purchase-approval/view-details/disapprove/{id}', [AdminFunctionsController::class, 'admin_disapprove_purchase']) -> name('admindisapprovepurchase');

Route::get('/admin/purchasing-monitoring/generate-receipt/{allPurchaseOrder}', [AdminFunctionsController::class, 'admin_generate_po_receipt']) -> name('admingeneratereceipt');

Route::delete('admin/unpurchase-order/{id}', [AdminFunctionsController::class, 'admin_delete_unpurchase']) -> name('admindeleteunpurchase');

});










