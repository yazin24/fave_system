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
        Schema::create('ecom_customer_carts', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('ecom_cs_id');
            $table -> boolean('isPurchase') -> default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecom_customer_carts');
    }
};