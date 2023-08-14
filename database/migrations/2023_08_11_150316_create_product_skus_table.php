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
        Schema::create('product_sku', function (Blueprint $table) {
            $table->id();
            $table -> string('barcode') -> default('');
            $table -> unsignedBigInteger('variant_id');
            $table -> string('full_name') -> default('');
            $table -> decimal('sku_size', 10, 2) -> default(0);
            $table -> integer('sku_quantity') -> default(0);
            $table->timestamps();

            $table -> foreign('variant_id') -> references('id') -> on('product_variants') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_skus');
    }
};
