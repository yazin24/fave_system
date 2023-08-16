<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersStocks extends Model
{
    protected $table = 'customers_stocks';

    public function customers()
    {
        return $this -> belongsTo(Customers::class, 'cs_id');
    }

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    protected $fillable = [
        'cs_id',
        'sku_id',
        'quantity',

    ];
}
