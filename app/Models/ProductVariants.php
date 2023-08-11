<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    protected $table = 'product_variants';

    public function productSku()
    {
        return $this -> hasMany(ProductSku::class, 'variant_id');
    }

    protected $fillable = [
        'variant_name',
    ];
}
