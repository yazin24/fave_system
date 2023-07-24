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
        Schema::create('received_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('po_id');
            $table -> string('po_number');
            $table -> string('item_name');
            $table -> integer('quantity');
            $table -> string('quantity_unit') -> nullable();
            $table -> decimal('unit_price');
            $table -> decimal('amount');

            $table -> foreign('po_id') -> references('id') -> on('purchase_orders') -> onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_purchase_orders');
    }
};
