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
        Schema::create('received_purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('po_id');
            $table -> unsignedBigInteger('status');
            $table -> string('supplier_name') -> default('');
            $table -> boolean('payment_status') -> default(0);
            $table -> unsignedBigInteger('del_status');
            $table -> string('requested_by') -> default('');
            $table -> string('prepared_by') -> default('');
            $table -> string('approved_by') -> default('');
            $table->timestamps();

            $table -> foreign('po_id') -> references('po_id') -> on('received_purchase_orders') -> onDelete('cascade');
            $table -> foreign('status') -> references('id') -> on('system_status')-> onDelete('cascade');
            $table -> foreign('del_status') -> references('id') -> on('system_status')-> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_purchase_order_details');
    }
};
