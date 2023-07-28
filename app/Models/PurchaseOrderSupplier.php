<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder;

class PurchaseOrderSupplier extends Model
{
    public function purchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class);
    }

    // public function suppliers()
    // {
    //     return $this -> belongsTo(Suppliers::class);
    // }

    protected $fillable = [
        'supplier_name',
        'po_id',

    ];
}
