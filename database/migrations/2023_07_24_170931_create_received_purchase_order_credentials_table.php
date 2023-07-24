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
        Schema::create('received_purchase_order_credentials', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('po_id');
            $table -> string('supplier_name');
            $table -> string('status');
            $table -> boolean('del_status') -> default(1);
            $table -> string('requested_by');
            $table -> string('prepared_by');
            $table -> string('approved_by');

            $table -> foreign('po_id') -> references('id') -> on('purchase_orders') -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_purchase_order_credentials');
    }
};
