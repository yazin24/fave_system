<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder;

class PurchaseOrderCredentials extends Model
{
    public function PurchaseOrder()
    {
        return $this -> belongsTo(PurchaseOrder::class);
    }

    protected $fillable = [
        'prepared_by',
        'requested_by',
        'approved_by',
    ];
}
