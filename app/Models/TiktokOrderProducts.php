<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokOrderProducts extends Model
{
    protected $table = 'tiktok_order_products';

    public function tiktokOrders()
    {
        return $this -> belongsTo(TiktokOrders::class, 'tiktok_order_id');
    }

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    protected $fillable = [

        'tiktok_order_id',
        'sku_id',
        'quantity',
        'price',
        'amount',

    ];
}
