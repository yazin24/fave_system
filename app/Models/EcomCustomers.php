<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EcomCustomers extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'ecom_customers';

    public function ecomCustomerOrders()
    {
        return $this -> hasMany(EcomCustomerOrders::class, 'ecom_cs_id');
    }

    public function ecomCustomerCart()
    {
        return $this -> hasMany(EcomCustomerCart::class, 'ecom_cs_id');
    }

    protected $fillable = [

        'name',
        'email',
        'phone_number',
        'usertype',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
