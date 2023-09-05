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
        Schema::create('manufacturing_storage', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('sku_id');
            $table -> integer('quantity') -> default(0);
            $table->timestamps();

            $table -> foreign('sku_id') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufacturing_storages');
    }
};
