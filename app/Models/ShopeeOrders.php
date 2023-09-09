<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeOrders extends Model
{
    protected $table = 'shopee_orders';

    public function systemStatus()
    {
        return $this -> hasOne(SystemStatus::class, 'status');
    }

    public function shopeeOrderProducts()
    {
        return $this -> hasMany(ShopeeOrderProducts::class, 'shopee_order_id');
    }

    public function shopeeSales()
    {
        return $this -> hasOne(ShopeeSales::class, 'shopee_order_id');
    }

    protected $fillable = [

        'customers_name',
        'customers_address',
        'phone_number',
        'order_id',
        'charges_and_fees',
        'voucher',
        'status',
        'encoded_by',

    ];

}