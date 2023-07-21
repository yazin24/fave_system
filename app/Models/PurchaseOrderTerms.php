<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderTerms extends Model
{

    protected $table = 'purchase_order_terms';
    

    public function purchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class, 'po_id');
    }

    protected $fillable = [
        'po_id',
        'credit_term',
        'payment_term',
        'due_date',
    ];
}
