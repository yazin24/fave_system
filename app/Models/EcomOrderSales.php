<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomOrderSales extends Model
{
    protected $table = 'ecom_order_sales';

    public function ecomCustomerOrders()
    {
        return $this -> belongsTo(EcomCustomerOrders::class, 'order_id');
    }

    protected $fillable = [

        'order_id',
        'total_amount'

    ];
}
