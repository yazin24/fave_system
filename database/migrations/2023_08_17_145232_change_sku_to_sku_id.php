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
        Schema::table('customers_purchase_orders_products', function (Blueprint $table) {
            $table -> dropColumn('sku');

            $table -> unsignedBigInteger('sku_id') -> after('cs_po_id');

            $table -> foreign('sku_id') -> references('id') -> on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers_purchase_orders_table', function (Blueprint $table) {
            //
        });
    }
};
