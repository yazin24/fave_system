<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    public function supplierItems()
    {
        return $this -> hasMany(SupplierItems::class, 'supplier_id');
    }

    protected $fillable = [
        'supplier_name',
    ];
}
