<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierCreditLimit extends Model
{
    protected $table = 'supplier_credit_limit';

    public function suppliers()
    {
        return $this -> belongsTo(Suppliers::class, 'supplier_id');
    }

    protected $fillable = [
        'supplier_id',
        'credit_limit',
    ];
}
