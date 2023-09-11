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
        Schema::create('manual_po_sales', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('manual_order_id');
            $table -> decimal('total_amount', 8, 2) -> default(0);
            $table->timestamps();

            $table -> foreign('manual_order_id') -> references('id') -> on('manual_customer_purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_purchase_order_sales');
    }
};
