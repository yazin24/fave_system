<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualPurchaseOrder extends Model
{
    protected $table = 'manual_customer_purchase_orders';

    public function manualPurchaseOrderProducts()
    {
        return $this -> hasMany(ManualPurchaseOrderProducts::class, 'manual_po_id');
    }

    protected $fillable = [
        'po_number',
        'customers_name',
        'contact_number',
        'address',
        'purchase_type',
        'isApproved',
    ];
}
