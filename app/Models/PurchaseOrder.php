<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderSupplier;
use App\Models\PurchaseOrderCredentials;
use App\Models\PurchaseOrderDelDate;
use PHPUnit\Event\Telemetry\SystemMemoryMeter;

class PurchaseOrder extends Model
{
    public function purchaseOrderItems()
    {
        return $this -> hasMany(PurchaseOrderItems::class, 'po_id');
    }

    public function purchaseOrderSupplier()
    {
        return $this -> hasOne(PurchaseOrderSupplier::class, 'po_id');
    }

    public function purchaseOrderCredentials()
    {
        return $this -> hasOne(PurchaseOrderCredentials::class, 'po_id');
    }

    public function purchaseOrderDelDate()
    {
        return $this -> hasOne(PurchaseOrderDelDate::class, 'po_id');
    }

    public function systemStatus()
    {
        return $this -> belongsTo(SystemStatus::class, 'status');
    }

    public function deliveryStatus() 
    {
        return $this -> hasMany(PurchaseOrderDelStatus::class);
    }

    protected $fillable = [
        'po_number',
        'status',
        'del_status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($purchaseOrder){
            $purchaseOrder -> status = SystemStatus::where('status', 'queued') -> first() -> id;
            $purchaseOrder ->  del_status = false;
            $purchaseOrder -> created_at = now() -> format('Y-m-d h:i:s A');
            $purchaseOrder -> updated_at = now() -> format('Y-m-d h:i:s A');
        });
    }
}
