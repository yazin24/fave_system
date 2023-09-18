<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerCart extends Model
{
    protected $table = 'ecom_customer_carts';

    protected function ecomCustomers()
    {
        return $this -> belongsTo(EcomCustomers::class, 'ecom_cs_id');
    }

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    protected $fillable = [

        'ecom_cs_id',
        'sku_id',
        'quantity',
        'price',
        'isPurchase',

    ];
}
