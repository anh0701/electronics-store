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
        Schema::create('tbl_phieugiamgiannguoidung', function (Blueprint $table) {
            $table->integer('MaGGND', true);
            $table->integer('MaGiamGia')->index('magiamgia');
            $table->integer('MaTaiKhoan')->index('mataikhoan');
            $table->integer('SoLuong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieugiamgiannguoidung');
    }
};
