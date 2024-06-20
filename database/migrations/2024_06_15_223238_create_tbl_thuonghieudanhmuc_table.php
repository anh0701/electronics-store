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
        Schema::create('tbl_thuonghieudanhmuc', function (Blueprint $table) {
            $table->integer('MaTHDM', true);
            $table->integer('MaThuongHieu')->index('mathuonghieu');
            $table->integer('MaDanhMuc')->index('madanhmuc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_thuonghieudanhmuc');
    }
};
