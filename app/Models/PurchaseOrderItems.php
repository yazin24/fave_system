<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder;

class PurchaseOrderItems extends Model
{
    public function purchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class);
    }

    protected $fillable = [
        'item_name',
        'quantity',
        'quantity_unit',
        'unit_price',
        'amount',
    ];
}
