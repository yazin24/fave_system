<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddStockProductHistory extends Model
{
    use HasFactory;

    protected $table = 'add_stock_product_history';

    public function  productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'product_sku');
    }

    protected $fillable = [

        'product_sku_id',
        'quantity',

    ];
}
