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
        Schema::table('lazada_orders', function (Blueprint $table) {
            $table -> decimal('Voucher',8,2) -> default(0) -> after('charges_and_fess');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lazada_orders', function (Blueprint $table) {
            //
        });
    }
};
