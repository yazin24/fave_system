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
            $table -> boolean('isRetail') -> default(0) -> after('total_price');
            $table -> boolean('isWholesale') -> default(0) -> after('isRetail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers_purchase_orders_products', function (Blueprint $table) {
            //
        });
    }
};
