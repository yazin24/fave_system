<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedItems extends Model
{
    protected $table = 'received_items';


    public function purchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class, 'po_id');
    }

    public function purchaseOrderItems()
    {
        return $this -> belongsTo(PurchaseOrderItems::class, 'item_id');
    }

    protected $fillable = [
        'po_id',
        'item_id',
        'quantity_received',
    ];
}
