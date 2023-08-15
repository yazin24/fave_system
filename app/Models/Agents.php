<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    protected $table = 'agents';

    public function areas()
    {
        return $this -> belongsTo(Areas::class, 'area_id');
    }

    public function customers()
    {
        return $this -> hasMany(Customers::class, 'agent_id');
    }

    protected $fillable = [
        'agent_name',
        'area_id',
        'agent_number',
        'agent_address',
        'fb_messenger',
        'email_address',
        'agents_password',
    ];
}
