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
        Schema::create('tbl_chitietphieutrahang', function (Blueprint $table) {
            $table->string('MaCTPTH', 50)->primary();
            $table->string('MaPhieuTraHang', 50)->index('order_code');
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('SoLuong');
            $table->float('GiaSanPham', null, 0);
            $table->string('LyDoTraHang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietphieutrahang');
    }
};
