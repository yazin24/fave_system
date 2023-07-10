<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierItems extends Model
{
    public function suppliers()
    {
        return $this -> belongsTo(Suppliers::class, 'supplier_id');
    }

    protected $fillable = [
        'supplier_id',
        'item_name',
    ];
}
