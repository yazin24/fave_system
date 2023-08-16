<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersPurchaseOrdersProducts extends Model
{
    protected $table = 'customers_purchase_orders_products';

    public function customersPurchaseOrders()
    {
        return $this -> belongsTo(CustomersPurchaseOrders::class, 'cs_po_id');
    }

    protected $fillable = [
        'cs_po_id',
        'sku',
        'quantity',
        'total_price',
    ];
}
