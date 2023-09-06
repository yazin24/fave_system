<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LazadaOrders extends Model
{
    protected $table = 'lazada_orders';

    public function lazadaSales()
    {
        return $this -> hasOne(LazadaSales::class, 'lazada_order_id');
    }

    public function lazadaOrderProducts()
    {
        return $this -> hasMany(LazadaOrderProducts::class, 'lazada_order_id');
    }

    public function systemStatus()
    {
        return $this -> hasOne(SystemStatus::class, 'status');
    }

    protected $fillable = [

        'customers_name',
        'customers_address',
        'phone_number',
        'order_number',
        'charges_and_fees',
        'status',
        'encoded_by',

    ];
}
