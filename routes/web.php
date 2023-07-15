<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFunctionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\PurchasingFunctionsController;
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


//Inventory Routes Sidebar
Route::get('/stock-monitoring', [InventoryController::class, 'stock_monitoring'])->name('stockmonitoring');

Route::get('/add-item', [InventoryController::class, 'add_item'])->name('additem');

Route::get('/stocks', [InventoryController::class, 'stocks'])->name('stocks');

Route::get('/supplier', [InventoryController::class, 'supplier'])->name('supplier');

Route::get('inventory-history', [InventoryController::class, 'inventory_history'])->name('inventoryhistory');


//Purchasing Routes Sidebar
Route::get('/purchasing/purchase-monitoring', [PurchasingController::class, 'purchase_monitoring'])->name('purchasemonitoring') -> middleware('purchasing');

Route::get('/purchasing/purchase', [PurchasingController::class, 'purchase'])->name('purchase') -> middleware('purchasing');

Route::get('/purchasing/all-purchases', [PurchasingController::class, 'all_purchases'])->name('allpurchases') -> middleware('purchasing');

Route::get('/purchasing/supplier-list', [PurchasingController::class, 'purchasing_supplier_list'])->name('purchasingsupplierlist') -> middleware('purchasing');


//Purchasing Routes (Functionalities)


Route::post('/purchasing/purchase-form', [PurchasingFunctionsController::class, 'purchase_show_supplier_items']) -> name('purchaseshowsupplieritems') -> middleware('purchasing');

Route::post('/make-purchase', [PurchasingFunctionsController::class, 'purchase_order_store']) -> name('purchaseorderstore') -> middleware('purchasing');

Route::get('/view-purchase/{purchase}/view', [PurchasingFunctionsController::class, 'view_purchase_order']) -> name('viewpurchase') -> middleware('purchasing');

Route::get('/generate-receipt/{purchase}', [PurchasingFunctionsController::class, 'generate_po_receipt']) -> name('generatereceipt') -> middleware('purchasing');

Route::post('/all-purchases/show-purchases', [PurchasingFunctionsController::class, 'show_purchases'])-> name('showpurchases') -> middleware('purchasing');

Route::get('/all-purchases/all-purchase-order', [PurchasingFunctionsController::class, 'all_purchases']) -> name('allpurchaseorder') -> middleware('purchasing');

Route::get('/purchasing/add-supplier', [PurchasingFunctionsController::class, 'add_supplier']) -> name('addsupplier') -> middleware('purchasing');

Route::post('/purchasing/add-supplier/store', [PurchasingFunctionsController::class, 'add_supplier_store']) -> name('addsupplierstore');

Route::get('/purchasing/supplier-list', [PurchasingFunctionsController::class, 'supplier_list']) -> name('supplierlist') -> middleware('purchasing');

Route::post('purchasing/supplier-list/items', [PurchasingFunctionsController::class, 'show_supplier_items']) -> name('showsupplieritems') -> middleware('purchasing');


//Staff Routes (Sidebar)

Route::get('/staff/all-purchasing', [StaffController::class, 'staff_all_purchases']) -> name('staffallpurchases') -> middleware('staff');


//Staff Routes (Functionalities)

Route::post('staff/all-purchasing/view', [StaffFunctionsController::class, 'staff_show_specific_purchase']) -> name('staffshowspecificpurchase') -> middleware('staff');

Route::get('staff/all-purchasing/view/all', [StaffFunctionsController::class, 'staff_show_all_purchases']) -> name('staffshowallpurchases') -> middleware('staff');



//Admin Routes Sidebar

Route::get('/admin/purchasing-monitoring', [AdminController::class, 'admin_purchasing_monitoring']) -> name('adminpurchasingmonitoring') -> middleware('admin');

Route::get('admin/purchase-approval', [AdminController::class, 'admin_purchase_approval']) -> name('adminpurchaseapproval') -> middleware('admin');

Route::get('admin/add-supplier', [AdminController::class, 'admin_add_supplier']) -> name('adminaddsupplier') -> middleware('admin');

Route::get('admin/supplier-list', [AdminController::class, 'admin_supplier_list']) -> name('adminsupplierlist') -> middleware('admin');

Route::get('admin/unpurchase-order', [AdminController::class, 'admin_unpurchase']) -> name('adminunpurchase') -> middleware('admin');


//Admin Routes (Functionalities)

//Route::get('/')

//Route::get('/admin/purchase-monitoring/edit', [AdminPurchasingMonitoringController::class, 'admin_purchase_order_edit']) -> name('adminpurchaseorderedit');

Route::get('admin/purchasing-monitoring/search', [AdminFunctionsController::class, 'admin_search']) -> name('adminsearch') -> middleware('admin');

Route::delete('/admin/purchasing-monitoring/delete/{id}', [AdminFunctionsController::class, 'admin_purchase_order_delete']) -> name('adminpurchaseorderdelete') -> middleware('admin');

Route::post('admin/supplier-list/items', [AdminFunctionsController::class, 'admin_show_suppliers_items']) -> name('adminshowsuppliersitems') -> middleware('admin');

Route::get('/admin/purchase-approval/view-details/{queuePurchase}', [AdminFunctionsController::class, 'admin_purchase_order_approval']) -> name('adminpurchaseorderapproval') -> middleware('admin');

Route::post('admin/purchase-approval/view-details/approve/{id}', [AdminFunctionsController::class, 'admin_approve_purchase']) -> name('adminapprovepurchase') -> middleware('admin');

Route::post('admin/purchase-approval/view-details/disapprove/{id}', [AdminFunctionsController::class, 'admin_disapprove_purchase']) -> name('admindisapprovepurchase') -> middleware('admin');

Route::delete('admin/unpurchase-order/{id}', [AdminFunctionsController::class, 'admin_delete_unpurchase']) -> name('admindeleteunpurchase') -> middleware('admin');







