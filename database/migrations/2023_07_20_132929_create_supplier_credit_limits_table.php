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
        Schema::create('supplier_credit_limit', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('supplier_id');
            $table -> string('credit_limit');
            $table->timestamps();

            $table -> foreign('supplier_id') -> references('id') -> on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_credit_limits');
    }
};
