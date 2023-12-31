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
        Schema::create('customers_stocks', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('cs_id');
            $table -> unsignedBigInteger('sku_id');
            $table -> integer('quantity');
            $table->timestamps();

            $table -> foreign('cs_id') -> references('id') -> on('customers');
            $table -> foreign('sku_id') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_stocks');
    }
};
