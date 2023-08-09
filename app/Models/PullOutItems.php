<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PullOutItems extends Model
{
    protected $table = 'pull_out_items';

    public function allItems()
    {
        return $this -> belongsTo(AllItems::class, 'item_id');
    }

    protected $fillable = [
        'po_number',
        'item_id',
        'item_unit',
        'quantity',
        'price',
        'total_amount',
        'requested_by',
        'approved_by',
    ];
}
