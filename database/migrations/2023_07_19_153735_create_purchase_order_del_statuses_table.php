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
        Schema::create('purchase_order_del_status', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('po_id');
            $table -> unsignedBigInteger('del_status');
            $table->timestamps();

            $table -> foreign('po_id') -> references('id') -> on('purchase_orders') -> onDelete('cascade');
            $table -> foreign('del_status') -> references('id') -> on('system_status') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_del_statuses');
    }
};
