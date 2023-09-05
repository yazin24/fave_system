<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageLogHistory extends Model
{
    protected $table = 'storage_log_history';

    public function manufacturingStorage()
    {
        return $this -> belongsTo(manufacturingStorage::class, 'sku_storage_id');
    }

    protected $fillable = [

        'sku_storage_id',
        'quantity',
        'action',

    ];
}
