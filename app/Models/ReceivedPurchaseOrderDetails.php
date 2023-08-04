<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedPurchaseOrderDetails extends Model
{
    protected $table = 'received_purchase_order_details';

   public function receivedPurchaseOrder()
   {
    return $this -> belongsTo(ReceivedPurchaseOrder::class, 'po_id');
   }

   protected $fillable = [
    'po_id',
    'status',
    'supplier_name',
    'payment_status',
    'del_status',
    'requested_by',
    'prepared_by',
    'approved_by',

   ];
}
