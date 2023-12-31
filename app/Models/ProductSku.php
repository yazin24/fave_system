<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $table = 'product_sku';

    public function productVariants()
    {
        return $this -> belongsTo(ProductVariants::class, 'variant_id');
    }

    public function customersPurchaseOrders()
    {
        return $this -> belongsToMany(CustomersPurchaseOrders::class, 'customers_purchase_orders_products', 'cs_po_id', 'sku_id');
    }

    public function customersStocks()
    {
        return $this -> hasMany(ProductSku::class, 'sku_id');
    }

    public function manualPurchaseOrderProducts()
    {
        return $this -> hasMany(ManualPurchaseOrderProducts::class, 'sku_id');
    }

    public function shopeeOrderProducts()
    {
        return $this -> hasMany(ShopeeOrderProducts::class, 'sku_id');
    }

    public function lazadaOrderProducts()
    {
        return $this -> hasMany(LazadaOrderProducts::class, 'sku_id');
    }

    public function tiktokOrderProducts()
    {
        return $this -> hasMany(TiktokOrderProducts::class, 'sku_id');
    }

    public function manufacturingStorage()
    {
        return $this -> hasMany(ManufacturingStorage::class, 'sku_id');
    }

    public function addStockProductHistory()
    {
        return $this -> hasOne(AddStockProductHistory::class, 'product_sku_id');
    }

    public function ecomCustomerOrderItems()
    {
        return $this -> hasMany(EcomCustomerOrderItems::class, 'sku_id');
    }

    public function ecomCustomerCartItems()
    {
        return $this -> hasMany(EcomCustomerCartItems::class, 'sku_id');
    }

    protected $fillable = [
        'barcode',
        'variant_id', 
        'full_name',
        'sku_size',
        'sku_quantity',
        'retail_price',
        'wholesale_price',
    ];
}
