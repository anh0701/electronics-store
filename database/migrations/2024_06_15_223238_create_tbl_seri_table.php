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
        Schema::create('tbl_seri', function (Blueprint $table) {
            $table->integer('MaSanPham');
            $table->string('MaSeri')->primary();
            $table->string('MaPN')->nullable()->index('mapn');
            $table->string('MaPX')->nullable()->index('mapx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_seri');
    }
};
