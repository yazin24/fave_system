<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table -> string('area_name');
            $table->timestamps();
        });

        $area = [
            ['area_name' => 'CALOOCAN'],
            ['area_name' => 'LAS PINAS'],
            ['area_name' => 'MAKATI'],
            ['area_name' => 'MALABON'],
            ['area_name' => 'MANDALUYONG'],
            ['area_name' => 'MANILA'],
            ['area_name' => 'MARIKINA'],
            ['area_name' => 'MUNTINLUPA'],
            ['area_name' => 'NAVOTAS'],
            ['area_name' => 'PARANAQUE'],
            ['area_name' => 'PASAY'],
            ['area_name' => 'PASIG'],
            ['area_name' => 'PATEROS'],
            ['area_name' => 'QUEZON CITY'],
            ['area_name' => 'SAN JUAN'],
            ['area_name' => 'TAGUIG'],
            ['area_name' => 'ANGONO'],
            ['area_name' => 'ANTIPOLO'],
            ['area_name' => 'BINANGONAN'],
            ['area_name' => 'CAINTA'],
            ['area_name' => 'TAYTAY'],
        ];

        DB::table('areas') -> insert($area);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
