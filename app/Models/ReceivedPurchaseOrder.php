<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedPurchaseOrder extends Model
{
    public function receivedPurchaseOrderCredentials()
    {
        return $this -> belongsTo(ReceivedPurchaseOrderCredentials::class, 'received_id');
    }

    protected $fillable =[
        'received_id',
        'po_number',
        'item_name',
        'quantity',
        'quantity_unit',
        'unit_price',
        'amount',
    ];
}
