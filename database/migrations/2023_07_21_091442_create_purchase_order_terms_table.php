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
        Schema::create('purchase_order_terms', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('po_id');
            $table -> string('credit_term');
            $table -> string('payment_term');
            $table->timestamps();

            $table -> foreign('po_id') -> references('id') -> on('purchase_orders') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('purchase_order_terms');
    }
};
