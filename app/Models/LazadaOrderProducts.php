<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LazadaOrderProducts extends Model
{

    protected $table = 'lazada_order_products';

    public function lazadaOrders()
    {
        return $this -> belongsTo(LazadaOrders::class, 'lazada_order_id'); 
    }

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    protected $fillable = [

        'lazada_order_id',
        'sku_id',
        'quantity',
        'price',
        'amount',

    ];
}
