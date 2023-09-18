<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomerPaymentTransactions extends Model
{
    protected $table = 'ecom_customer_payment_transactions';

    public function ecomCustomerOrders()
    {
        return $this -> belongsTo(EcomCustomerOrders::class, 'order_id');
    }

    protected $fillable = [

        'order_id',
        'payment_method',
        'amount',
        'ref_number',

    ];
}
