<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderSupplier;
use App\Models\PurchaseOrderCredentials;
use App\Models\PurchaseOrderDelDate;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';

    public function purchaseOrderItems()
    {
        return $this -> hasMany(PurchaseOrderItems::class, 'po_id');
    }

    public function purchaseOrderSupplier()
    {
        return $this -> hasOne(PurchaseOrderSupplier::class, 'po_id');
    }

    public function purchaseOrderDelDate()
    {
        return $this -> hasOne(PurchaseOrderDelDate::class, 'po_id');
    }

    public function systemStatus()
    {
        return $this -> belongsTo(SystemStatus::class, 'status',);
    }

    public function deliveryStatus() 
    {
        return $this -> hasMany(PurchaseOrderDelStatus::class);
    }

    public function purchaseOrderTerms()
    {
        return $this -> hasOne(PurchaseOrderTerms::class, 'po_id');
    }

    public function receivedItems()
    {
        return $this -> hasMany(ReceivedItems::class, 'po_id');
    }

    protected $fillable = [
        'po_number',
        'status',
        'payment_stsatus',
        'del_status',
        'prepared_by',
        'requested_by',
        'approved_by',
        'del_charge',
        'total_amount',
        'amount_paid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($purchaseOrder){
            $purchaseOrder -> status = SystemStatus::where('status', 'queued') -> first() -> id;
            $purchaseOrder -> payment_status = false;
            $purchaseOrder -> created_at = now() -> format('Y-m-d h:i:s A');
            $purchaseOrder -> updated_at = now() -> format('Y-m-d h:i:s A');
        });

        static::deleting(function($purchaseOrder){
            $purchaseOrder -> receivedItems() -> delete();
        });

    }
}
