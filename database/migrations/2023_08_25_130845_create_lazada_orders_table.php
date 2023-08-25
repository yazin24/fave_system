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
        Schema::create('lazada_orders', function (Blueprint $table) {
            $table->id();
            $table -> string('customers_name') -> default('');
            $table -> string('customers_address') -> default('');
            $table -> string('phone_number') -> default('');
            $table -> unsignedBigInteger('status');

            $table -> foreign('status') -> references('id') -> on('system_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lazada_orders');
    }
};