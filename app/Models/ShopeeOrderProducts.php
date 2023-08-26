<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeOrderProducts extends Model
{
    protected $table = 'shopee_order_products';

    public function shopeeOrders()
    {
        return $this -> belongsTo(ShopeeOrders::class, 'shopee_order_id');
    }

    public function productSku()
    {
        return $this -> hasMany(ProductSku::class, 'sku_id');
    }

    protected $fillable = [

        'shopee_order_id',
        'sku_id',
        'quantity',
        'price',
        'amount',

    ];
}
