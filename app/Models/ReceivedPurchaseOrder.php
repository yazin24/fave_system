<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedPurchaseOrder extends Model
{
    protected $table = 'received_purchase_orders';

     public function purchaseOrder()
     {
        return $this -> belongsTo(PurchaseOrder::class, 'po_id');
     }

     public function receivedPurchaseOrderDetails()
     {
        return $this -> hasOne(ReceivedPurchaseOrderDetails::class, 'received_id');
     }

     public function receivedPartials()
     {
        return $this -> hasMany(ReceivedPartial::class, 'received_id');
     }

    protected $fillable = [
        'po_id',
        'item_id',
        'quantity',

    ];
}
