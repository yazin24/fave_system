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

    public function allItems()
    {
        return $this -> belongsTo(AllItems::class, 'item_id');
    }

    public function receivedItems()
    {
        return $this -> hasMany(ReceivedItems::class, 'item_id', 'item_id');
    }

    // public function supplierItems()
    // {
    //     return $this -> belongsTo(SupplierItems::class, '')
    // }

    protected $fillable = [
        'item_id',
        'quantity',
        'quantity_unit',
        'unit_price',
        'amount',
    ];
}
