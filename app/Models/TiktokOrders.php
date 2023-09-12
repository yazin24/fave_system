<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokOrders extends Model
{
   protected $table = 'tiktok_orders';

   public function systemStatus()
   {
    return $this -> hasOne(SystemStatus::class, 'status');
   }

   public function tiktokOrderProducts()
   {
    return $this -> hasMany(TiktokOrderProducts::class, 'tiktok_order_id');
   }

   public function tiktokSales()
   {
    return $this -> hasOne(TiktokSales::class, 'tiktok_order_id');
   }

   protected $fillable = [

    'customers_name',
    'customers_address',
    'phone_number',
    'order_id',
    'charges_and_fees',
    'voucher',
    'status',
    'encoded_by',

   ];
}
