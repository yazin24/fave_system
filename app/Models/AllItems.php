<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllItems extends Model
{
    protected $table = 'all_items';

    public function suppliers()
    {
        return $this -> belongsToMany(Suppliers::class, 'supplier_items', 'supplier_id', 'item_id');
    }

    public function purchaseOrderItems()
    {
        return $this -> hasMany(PurchaseOrderItems::class, 'itemd_id');
    }

    protected $fillable = [
        'item_name',
        'quantity',
    ];
}
