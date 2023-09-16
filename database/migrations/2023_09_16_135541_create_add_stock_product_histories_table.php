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
        Schema::create('add_stock_product_history', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('product_sku_id');
            $table -> integer('quantity');
            $table->timestamps();

            $table -> foreign('product_sku_id') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_stock_product_history');
    }
};
