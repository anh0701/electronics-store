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
        Schema::create('tbl_chuongtrinhgiamgiasp', function (Blueprint $table) {
            $table->integer('MaCTGGSP', true);
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('MaCTGG')->index('mactgg');
            $table->string('PhanTramGiam', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chuongtrinhgiamgiasp');
    }
};
