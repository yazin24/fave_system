<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerOrderItems extends Model
{
    protected $table = 'ecom_customer_order_items';

    public function ecomCustomerOrders()
    {
        return $this -> belongsTo(EcomCustomerOrders::class, 'order_id');
    }

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    protected $fillable = [

        'order_id',
        'sku_id',
        'quantity',
        'price'

    ];
}
