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
        Schema::create('manual_customer_purchase_order_products', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('cs_id');
            $table -> unsignedBigInteger('sku_id');
            $table -> integer('quantity');
            $table -> decimal('price');
            $table -> decimal('amount');
            $table->timestamps();

            $table -> foreign('cs_id') -> references('id') -> on('manual_customer_purchase_orders') -> onDelete('cascade');
            $table -> foreign('sku_id') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_customer_purchase_order_products');
    }
};
