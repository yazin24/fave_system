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
            $table -> unsignedBigInteger('pull_out_id') -> nullable();
            $table -> unsignedBigInteger('item_id') -> nullable();
            $table -> string('item_unit') -> default('');
            $table -> integer('quantity') -> default(0);
            $table -> decimal('price') -> default(0); 
            $table -> decimal('total_amount') -> default(0);
            $table->timestamps();

            $table -> foreign('pull_out_id') -> references('id') -> on('pull_out_items_credentials');
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
