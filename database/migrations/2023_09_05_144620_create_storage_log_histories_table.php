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
        Schema::create('storage_log_history', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('sku_storage_id');
            $table -> integer('quantity') -> default(0);
            $table -> string('action') -> default('');
            $table->timestamps();

            $table -> foreign('sku_storage_id') -> references('id') -> on('manufacturing_storage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_log_history');
    }
};
