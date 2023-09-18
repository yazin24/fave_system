<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerCartItems extends Model
{
    protected $table = 'ecom_customer_cart_items';

    public function ecomCustomerCarts()
    {
        return $this -> belongsTo(EcomCustomerCart::class, 'cart_id');
    }

    protected $fillable = [

        'cart_id',
        'sku_id',
        'quantity',
        'price'

    ];
}
