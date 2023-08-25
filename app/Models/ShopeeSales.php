<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeSales extends Model
{
    protected $table = 'shopee_sales';

    public function shopeeOrders()
    {
        return $this -> belongsTo(ShopeeOrders::class, 'shopee_order_id');
    }

    protected $fillable = [

        'shopee_order_id',
        'total_amount',

    ];
}
