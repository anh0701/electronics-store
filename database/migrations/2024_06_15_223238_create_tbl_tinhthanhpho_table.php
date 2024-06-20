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
        Schema::create('tbl_tinhthanhpho', function (Blueprint $table) {
            $table->string('MaThanhPho', 5)->primary();
            $table->string('TenThanhPho', 100);
            $table->string('type', 30);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tinhthanhpho');
    }
};
