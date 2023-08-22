<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualPurchaseOrderProducts extends Model
{
    protected $table = 'manual_customer_purchase_order_products';

    public function manualPurchaseOrder()
    {
        return $this -> belongsTo(ManualPurchaseOrder::class, 'cs_id');
    }

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    protected $fillable = [
        'cs_id',
        'sku_id',
        'quantity',
        'price',
        'amount',
    ];
}
