<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokSales extends Model
{
    protected $table = 'tiktok_sales';

    public function tiktokOrders()
    {
        return $this -> belongsTo(TiktokOrders::class, 'tiktok_order_id');
    }

    protected $fillable = [

        'tiktok_order_id',
        'total_amount',

    ];
}
