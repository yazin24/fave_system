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
        Schema::create('shopee_order_products', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('shopee_order_id');
            $table -> unsignedBigInteger('sku_id');
            $table -> integer('quantity') -> default(0);
            $table -> decimal('price', 8,2) -> default(0);
            $table -> decimal('amount', 8, 2) -> default(0);

            $table -> foreign('shopee_order_id') -> references('id') -> on('shopee_orders') -> onDelete('cascade');
            $table -> foreign('sku_id') -> references('id') -> on('product_sku') -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_order_products');
    }
};
