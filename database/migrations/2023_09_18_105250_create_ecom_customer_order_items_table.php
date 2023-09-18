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
        Schema::create('ecom_customer_order_items', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('order_id');
            $table -> unsignedBigInteger('sku_id');
            $table -> integer('quantity') -> default(0);
            $table -> decimal('price', 8, 2) -> default(0);
            $table->timestamps();

            $table -> foreign('order_id') -> references('id') -> on('ecom_customer_orders');
            $table -> foreign('sku_id') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecom_customer_order_items');
    }
};
