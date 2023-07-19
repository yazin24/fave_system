<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDelStatus extends Model
{
    public function purchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class, 'po_id');
    }

    public function deliveryStatus()
    {
        return $this -> belongsTo(SystemStatus::class, 'del_status');
    }

    protected $fillable = [
        
        'del_status',
    ];
}
