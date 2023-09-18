<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerCart extends Model
{
    protected $table = 'ecom_customer_carts';

    protected $fillable = [

        'ecom_cs_id',
        'sku_id',
        'quantity',
        'price',
        'isPurchase',


    ];
}
