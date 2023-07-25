<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedPurchaseOrderCredentials extends Model
{
    public function purchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class, 'po_id');
    }

    public function receivedPurchaseOrder()
    {
        return $this -> hasOne(ReceivedPurchaseOrder::class, 'received_id');
    }

    protected $fillable = [
        'po_id',
        'supplier_name',
        'status',
        'del_status',
        'requested_by',
        'prepared_by',
        'approved_by',
    ];
}
