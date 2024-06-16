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
        Schema::create('tbl_quanhuyen', function (Blueprint $table) {
            $table->string('MaQuanHuyen', 5)->primary();
            $table->string('TenQuanHuyen', 100);
            $table->string('type', 30);
            $table->string('MaThanhPho', 5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_quanhuyen');
    }
};
