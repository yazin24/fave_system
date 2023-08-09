<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PullOutItems extends Model
{
    protected $table = 'pull_out_items';

    public function pullOutItemsCredentials()
    {
        return $this -> belongsTo(PullOutItemsCredentials::class);
    }

    public function allItems()
    {
        return $this -> belongsTo(AllItems::class, 'item_id');
    }

    protected $fillable = [
        'pull_out_id',
        'item_id',
        'item_unit',
        'quantity',
        'price',
        'total_amount',
    ];
}
