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
        Schema::table('purchase_order_terms', function (Blueprint $table) {
            $table -> integer('payment_term') -> after('po_id') -> default(0);
            $table -> string('mode_of_payment') -> after('payment_term') -> default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_order_terms', function (Blueprint $table) {
            //
        });
    }
};
