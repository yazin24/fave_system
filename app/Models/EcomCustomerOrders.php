<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerOrders extends Model
{
    protected $table = 'ecom_customer_orders';

    protected $fillable = [

        'ecom_cs_id',
        'status',
        'shipping_address',
        'billing_address',
        'tracking_number'

    ];
}
