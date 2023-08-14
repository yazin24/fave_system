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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table -> string('agent_name');
            $table -> unsignedBigInteger('area_id');
            $table -> string('agent_number') -> default('');
            $table -> string('agent_address') -> default('');
            $table -> string('fb_messenger') -> default('');
            $table -> string('email_address') -> default('');
            $table->timestamps();

            $table -> foreign('area_id') -> references('id') -> on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
