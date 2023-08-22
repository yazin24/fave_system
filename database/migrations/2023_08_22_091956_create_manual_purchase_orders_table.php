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
        Schema::create('manual_customer_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table -> string('customers_name') -> default('');
            $table -> string('contact_number') -> default('');
            $table -> string('address') -> default('');
            $table -> string('purchase_type') -> default(0);
            $table -> boolean('isApproved') -> default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_customer_purchase_orders');
    }
};
