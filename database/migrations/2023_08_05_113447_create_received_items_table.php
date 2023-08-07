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
        Schema::create('received_items', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('po_id') -> nullable();
            $table -> unsignedBigInteger('item_id') -> nullable();
            $table -> integer('quantity_received') ->nullable();
            $table->timestamps();

            $table -> foreign('po_id') -> references('id') -> on('purchase_orders') -> onDelete('cascade');
            $table -> foreign('item_id') -> references('item_id') -> on('purchase_order_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_items');
    }
};
