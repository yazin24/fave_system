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

    public function supplier()
    {
        return $this -> belongsTo(Suppliers::class, 'supplier_name');
    }

    protected $fillable = [
        'supplier_name',
        'po_id',

    ];
}
