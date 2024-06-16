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
        Schema::create('tbl_chitietphieubaohanh', function (Blueprint $table) {
            $table->integer('MaCTPBH', true);
            $table->string('order_code', 50)->index('order_code');
            $table->integer('MaSanPham');
            $table->integer('SoLuong');
            $table->string('ThoiGianBaoHanh', 50);
            $table->timestamp('ThoiGianBatDau')->nullable();
            $table->timestamp('ThoiGianKetThuc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietphieubaohanh');
    }
};
