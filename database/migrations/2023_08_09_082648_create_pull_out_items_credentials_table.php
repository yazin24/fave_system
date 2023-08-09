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
        Schema::create('pull_out_items_credentials', function (Blueprint $table) {
            $table->id();
            $table -> string('pull_out_number') -> default('');
            $table -> string('prepared_by') -> default('');
            $table -> string('requested_by') -> default('');
            $table -> string('approved_by') -> nullable('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pull_out_items_credentials');
    }
};
