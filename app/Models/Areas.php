<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'areas';

    public function agents()
    {
        return $this -> hasOne(Agents::class, 'area_id');
    }
}
