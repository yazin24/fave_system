<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ecom_customer_orders', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('ecom_cs_id');
            $table -> unsignedBigInteger('status') -> default(3);
            $table -> string('shipping_address') -> default('');
            $table -> string('billing_address') -> default('');
            $table -> string('phone_number') -> default('');
            $table->timestamps();

            $table -> foreign('ecom_cs_id') -> references('id') -> on('ecom_customers');
            $table -> foreign('status') -> references('id') -> on('system_status');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecom_customer_orders');
    }
};
