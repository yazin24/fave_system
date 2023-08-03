<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';

    public function allItems()
    {
        return $this -> belongsToMany(AllItems::class, 'supplier_items', 'supplier_id', 'item_id');
    }

    public function supplierItems()
    {
        return $this -> hasMany(SupplierItems::class, 'supplier_id');
    }

    public function supplierCreditLimit()
    {
        return $this -> hasOne(SupplierCreditLimit::class, 'supplier_id');
    }

    // public function purchaseOrderSupplier()
    // {
    //     return $this -> hasOne(PurchaseOrderSupplier::class);
    // }

    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'contact_number',
        'tel_number',
        'contact_person',
        'viber_account',
        'supplier_email',
        'credit_limit',
        
    ];
}
