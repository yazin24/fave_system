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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table -> string('full_name') -> default('');
            $table -> string('store_name') -> default('');
            $table -> unsignedBigInteger('agent_id');
            $table -> string('contact_number') -> default('');
            $table -> string('address') -> default('');
            $table->timestamps();

            $table -> foreign('agent_id') -> references('id') -> on('agents') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
