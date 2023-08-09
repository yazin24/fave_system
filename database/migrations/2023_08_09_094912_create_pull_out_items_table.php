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
        Schema::create('pull_out_items', function (Blueprint $table) {
            $table->id();
            $table -> string('po_number') -> nullable();
            $table -> unsignedBigInteger('item_id') -> nullable();
            $table -> string('item_unit') -> default('');
            $table -> integer('quantity') -> default(0);
            $table -> decimal('price') -> default(0); 
            $table -> decimal('total_amount') -> default(0);
            $table -> string('requested_by') -> default('');
            $table -> string('approved_by') -> nullable('');
            $table->timestamps();

            $table -> foreign('item_id') -> references('id') -> on('all_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pull_out_items');
    }
};
