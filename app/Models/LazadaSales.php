<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LazadaSales extends Model
{
    protected $table = 'lazada_sales';

    public function lazadaOrders()
    {
        return $this -> belongsTo(LazadaOrders::class, 'lazada_order_id');
    }

    protected $fillable = [

        'lazada_order_id',
        'total_amount',

    ];
}
