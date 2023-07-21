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
        Schema::table('supplier_credit_limit', function (Blueprint $table) {
            $table -> decimal('credit_limit', 10, 2) -> change();
            $table -> decimal('available_credit_limit', 10, 2) -> change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_credit_limit', function (Blueprint $table) {
            //
        });
    }
};
