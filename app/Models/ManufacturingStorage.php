<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingStorage extends Model
{
    protected $table = 'manufacturing_storage';

    public function productSku()
    {
        return $this -> belongsTo(ProductSku::class, 'sku_id');
    }

    public function storageLogHistory()
    {
        return $this -> hasMany(StorageLogHistory::class, 'sku_storage_id');
    }


    protected $fillable = [

        'sku_id',
        'quantity',

    ];

}
