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
        Schema::create('tbl_chitietphieunhap', function (Blueprint $table) {
            $table->string('MaCTPN', 50)->primary();
            $table->string('MaPhieuNhap', 50)->index('order_code');
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('SoLuong');
            $table->float('GiaSanPham', null, 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietphieunhap');
    }
};