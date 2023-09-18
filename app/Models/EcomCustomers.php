<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomCustomers extends Model
{
    protected $table = 'ecom_customers';

    

    protected $fillable = [

        'name',
        'email',
        'email_verfied_at',
        'phone_number',
        'password',
        'usertype',
        'remember_token',

    ];
}
