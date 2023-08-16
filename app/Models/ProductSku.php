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

    protected $fillable = [
        'barcode',
        'variant_id', 
        'full_name',
        'sku_size',
        'sku_quantity',
    ];
}
