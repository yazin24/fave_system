<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    public function agents()
    {
        return $this -> belongsTo(Agents::class, 'agent_id');
    }

    public function customersPurchaseOrders()
    {
        return $this -> hasMany(CustomersPurchaseOrders::class, 'cs_id');
    }

    public function customersStocks()
    {
        return $this -> hasMany(CustomersStocks::class, 'cs_id');
    }


    protected $fillable = [
        'full_name',
        'store_name',
        'agent_id',
        'contact_number',
        'address',
    ];
}
