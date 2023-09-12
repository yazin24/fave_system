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
        Schema::create('tiktok_orders', function (Blueprint $table) {
            $table->id();
            $table -> string('customers_name') -> default('');
            $table -> string('customers_address') -> default('');
            $table -> string('phone_number') -> default('');
            $table -> string('order_id') -> default('');
            $table -> decimal('charges_and_fees', 8,2) -> default(0);
            $table -> decimal('voucher', 8, 2) -> default(0);
            $table -> unsignedBigInteger('status');
            $table -> string('encoded_by') -> default('');

            $table -> foreign('status') -> references('id') -> on('system_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiktok_orders');
    }
};
