<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFunctionsController;
use App\Http\Controllers\AdminPurchasingMonitoringController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseMonitoringController;
use App\Http\Controllers\PurchaseOrderCreateController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\ShowPurchasesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffFunctionsController;
use App\Http\Controllers\SupplierListController;
use App\Http\Controllers\ViewPurchaseOrderController;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpWord\Element\Row;

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
    return view('welcome');
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


//Inventory Routes Sidebar
Route::get('/stock-monitoring', [InventoryController::class, 'stock_monitoring'])->name('stockmonitoring');

Route::get('/add-item', [InventoryController::class, 'add_item'])->name('additem');

Route::get('/stocks', [InventoryController::class, 'stocks'])->name('stocks');

Route::get('/supplier', [InventoryController::class, 'supplier'])->name('supplier');

Route::get('inventory-history', [InventoryController::class, 'inventory_history'])->name('inventoryhistory');


//Purchasing Routes Sidebar
Route::get('/purchasing/purchase-monitoring', [PurchasingController::class, 'purchase_monitoring'])->name('purchasemonitoring');

Route::get('/purchasing/purchase', [PurchasingController::class, 'purchase'])->name('purchase');

Route::get('/purchasing/all-purchases', [PurchasingController::class, 'all_purchases'])->name('allpurchases');

Route::get('/purchasing/supplier-list', [PurchasingController::class, 'purchasing_supplier_list'])->name('purchasingsupplierlist');


//Purchasing Routes (Functionalities)


Route::post('/purchasing/purchase-form', [PurchaseOrderCreateController::class, 'purchase_show_supplier_items']) -> name('purchaseshowsupplieritems');

Route::post('/make-purchase', [PurchaseOrderCreateController::class, 'purchase_order_store']) -> name('purchaseorderstore');

Route::get('/view-purchase/{purchase}/view', [ViewPurchaseOrderController::class, 'view_purchase_order']) -> name('viewpurchase');

Route::get('/generate-receipt/{purchase}', [ViewPurchaseOrderController::class, 'generate_po_receipt']) -> name('generatereceipt');

Route::post('/all-purchases/show-purchases', [ShowPurchasesController::class, 'show_purchases'])-> name('showpurchases');

Route::get('/all-purchases/all-purchase-order', [ShowPurchasesController::class, 'all_purchases']) -> name('allpurchaseorder');

Route::get('/purchasing/add-supplier', [SupplierListController::class, 'add_supplier']) -> name('addsupplier');

Route::post('/purchasing/add-supplier/store', [SupplierListController::class, 'add_supplier_store']) -> name('addsupplierstore');

Route::get('/purchasing/supplier-list', [SupplierListController::class, 'supplier_list']) -> name('supplierlist');

Route::post('purchasing/supplier-list/items', [SupplierListController::class, 'show_supplier_items']) -> name('showsupplieritems');


//Staff Routes (Sidebar)

Route::get('/staff/all-purchasing', [StaffController::class, 'staff_all_purchases']) -> name('staffallpurchases');


//Staff Routes (Functionalities)

Route::post('staff/all-purchasing/view', [StaffFunctionsController::class, 'staff_show_specific_purchase']) -> name('staffshowspecificpurchase');

Route::get('staff/all-purchasing/view/all', [StaffFunctionsController::class, 'staff_show_all_purchases']) -> name('staffshowallpurchases');



//Admin Routes Sidebar

Route::get('/admin/purchasing-monitoring', [AdminController::class, 'admin_purchasing_monitoring']) -> name('adminpurchasingmonitoring');

Route::get('admin/purchase-approval', [AdminController::class, 'admin_purchase_approval']) -> name('adminpurchaseapproval');

Route::get('admin/supplier-list', [AdminController::class, 'admin_supplier_list']) -> name('adminsupplierlist');


//Admin Routes (Functionalities)

//Route::get('/')

//Route::get('/admin/purchase-monitoring/edit', [AdminPurchasingMonitoringController::class, 'admin_purchase_order_edit']) -> name('adminpurchaseorderedit');

Route::delete('/admin/purchasing-monitroring/delete/{id}', [AdminPurchasingMonitoringController::class, 'admin_purchase_order_delete']) -> name('adminpurchaseorderdelete');

Route::post('admin/supplier-list/items', [AdminFunctionsController::class, 'admin_show_suppliers_items']) -> name('adminshowsuppliersitems');

Route::get('/admin/purchase-approval/view-details/{queuePurchase}', [AdminFunctionsController::class, 'admin_purchase_order_approval']) -> name('adminpurchaseorderapproval');

Route::post('admin/purchase-approval/view-details/approve/{id}', [AdminFunctionsController::class, 'admin_approve_purchase']) -> name('adminapprovepurchase');

Route::post('admin/purchase-approval/view-details/disapprove/{id}', [AdminFunctionsController::class, 'admin_disapprove_purchase']) -> name('admindisapprovepurchase');







