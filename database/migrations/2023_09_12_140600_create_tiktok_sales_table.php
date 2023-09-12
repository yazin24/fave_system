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
        Schema::create('tiktok_sales', function (Blueprint $table) {
            $table->id();

            $table -> unsignedBigInteger('tiktok_order_id');

            $table -> decimal('total_amount', 8, 2) -> default(0);

            $table -> foreign('tiktok_order_id') -> references('id') -> on('tiktok_orders');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiktok_sales');
    }
};
