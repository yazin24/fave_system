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
        Schema::create('ecom_customer_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('order_id');
            // $table -> unsignedBigInteger('transaction_id');
            $table -> string('payment_method');
            $table -> decimal('amount', 8, 2) -> default(0);
            // $table -> unsignedBigInteger('status');
            $table->timestamps();

            $table -> foreign('order_id') -> references('id') -> on('ecom_customer_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecom_customer_payment_transactions');
    }
};
