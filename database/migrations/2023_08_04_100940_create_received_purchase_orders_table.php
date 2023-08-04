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
            $table -> unsignedBigInteger('item_id');
            $table -> integer('quantity') -> default(0);
           
            $table->timestamps();

            $table -> foreign('po_id') -> references('id') -> on('purchase_orders') -> onDelete('cascade');
            $table -> foreign('item_id') -> references('id') -> on('all_items')-> onDelete('cascade');

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
