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
        Schema::create('tbl_chitietlichsubaohanh', function (Blueprint $table) {
            $table->integer('MaCTLSBH', true);
            $table->string('order_code', 50);
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('SoLuong');
            $table->string('TinhTrang', 50);
            $table->timestamp('NgayBaoHanh');
            $table->string('ThoiGianTra', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietlichsubaohanh');
    }
};
