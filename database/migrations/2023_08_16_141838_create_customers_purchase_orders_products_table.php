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
        Schema::create('customers_purchase_orders_products', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('cs_po_id');
            $table -> unsignedBigInteger('sku');
            $table -> integer('quantity');
            $table -> decimal('total_price', 8,2) -> default(0);
            $table->timestamps();

            $table -> foreign('cs_po_id') -> references('id') -> on('customers_purchase_orders');
            $table -> foreign('sku') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_purchase_orders_products');
    }
};
