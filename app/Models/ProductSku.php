<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $table = 'product_sku';

    public function productVariants()
    {
        return $this -> belongsTo(ProductVariants::class, 'variant_id');
    }

    protected $fillable = [
        'barcode',
        'variant_id', 
        'full_name',
        'sku_size',
        'sku_quantity',
    ];
}
