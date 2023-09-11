<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualPurchaseOrderSales extends Model
{
    protected $table = 'manual_po_sales';

    public function manualPurchaseOrders()
    {
        return $this -> belongsTo(ManualPurchaseOrder::class, 'manual_order_id');
    }

    protected $fillable = [

        'manual_order_id',
        'total_amount',

    ];
}
