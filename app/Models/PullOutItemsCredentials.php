<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PullOutItemsCredentials extends Model
{
    public function pullOutItems()
    {
        return $this -> hasMany(PullOutItems::class, 'pull_out_id');
    }

    protected $fillable = [
        'pull_out_number',
        'prepared_by',
        'requested_by',
        'approved_by',
    ];
}
