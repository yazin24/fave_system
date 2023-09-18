<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerOrderItems extends Model
{
    protected $table = 'ecom_customer_order_items';

    

    protected $fillable = [

        'order_id',
        'sku_id',
        'quantity',
        'price'

    ];
}
