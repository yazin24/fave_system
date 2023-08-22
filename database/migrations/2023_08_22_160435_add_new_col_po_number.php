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
        Schema::table('manual_customer_purchase_orders', function (Blueprint $table) {
            $table -> string('po_number') -> default('') -> after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manual_customers_purchase_orders', function (Blueprint $table) {
            //
        });
    }
};
