<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersPurchaseOrders extends Model
{
    protected $table = 'customers_purchase_orders';

    public function customers()
    {
        return $this -> belongsTo(Customers::class, 'cs_id');
    }

    public function agents()
    {
        return $this -> belongsTo(Agents::class, 'agent_id');
    }

    public function systemStatus()
    {
        return $this -> belongsTo(SystemStatus::class, 'status',);
    }

    public function productSku()
    {
        return $this -> belongsToMany(ProductSku::class, 'customers_purchase_orders_products', 'cs_po_id', 'sku_id')
                    ->withPivot('quantity', 'price', 'isRetail', 'isWholesale');
    }

    public function customersStocks()
    {
        return $this -> hasMany(CustomersStocks::class, 'cs_id');
    }


    protected $fillable = [

        'cs_id',
        'agent_id',
        'status',
        'del_status',

    ];
}
