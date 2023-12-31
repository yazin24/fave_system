<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerOrders extends Model
{
    protected $table = 'ecom_customer_orders';

    public function ecomCustomers()
    {
        return $this -> belongsTo(EcomCustomers::class, 'ecom_cs_id');
    }

    public function ecomCustomerOrderItems()
    {
        return $this -> hasMany(EcomCustomerOrderItems::class, 'order_id');
    }

    public function ecomCustomerPaymentTransactions()
    {
        return $this -> hasOne(EcomCustomerPaymentTransactions::class, 'order_id');
    }

    public function ecomOrderSales()
    {
        return $this -> hasOne(EcomOrderSales::class, 'order_id');
    }

    protected $fillable = [

        'ecom_cs_id',
        'status',
        'shipping_address',
        'billing_address',
        'tracking_number'

    ];
}
