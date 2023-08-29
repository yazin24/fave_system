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
        Schema::create('system_status', function (Blueprint $table) {
            $table->id();
            $table -> string('status');
            $table->timestamps();
        });

        $status = [
            ['status' => 'approved'],
            ['status' => 'disapproved'],
            ['status' => 'queued'],
            ['status' => 'complete'],
            ['status' => 'incomplete'],
            ['status' => 'partial'],
            ['status' => 'undelivered'],
            ['status' => 'cancelled'],
        ];

        DB::table('system_status') -> insert($status);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_status');
    }
};
