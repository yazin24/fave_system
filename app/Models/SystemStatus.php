<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemStatus extends Model
{
    protected $table = 'system_status';

    public function purchaseOrder()
    {
        return $this -> hasOne(PurchaseOrder::class, 'status');
    }

    public function deliveryStatus()
    {
        return $this -> hasOne(PurchaseOrderDelStatus::class, 'del_status');
    }

    public function shopeeOrders()
    {
        return $this -> belongsTo(ShopeeOrders::class, 'status');
    }

    public function lazadaOrders()
    {
        return $this -> belongsTo(LazadaOrders::class, 'status');
    }

    protected $fillable = [
        'status',
    ];
}
