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
        Schema::create('customers_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('cs_id');
            $table -> unsignedBigInteger('agent_id');
            $table -> unsignedBigInteger('status');
            $table -> unsignedBigInteger('del_status') -> default(7);
            $table->timestamps();

            $table -> foreign('cs_id') -> references('id') -> on('customers');
            $table -> foreign('agent_id') -> references('id') -> on('agents');
            $table -> foreign('status') -> references('id') -> on('system_status');
            $table -> foreign('del_status') -> references('id') -> on('system_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_purchase_orders');
    }
};
