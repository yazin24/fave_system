<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedPartial extends Model
{
    protected $table = 'purchase_order_received_partials';

    public function receivedPurchaseOrder()
    {
        return $this -> belongsTo(ReceivedPurchaseOrder::class, 'received_id');
    }

    protected $fillable = [
        'received_id',
        'item_id',
        'quantity',
    ];
}
