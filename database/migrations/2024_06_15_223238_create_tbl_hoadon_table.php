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
        Schema::create('tbl_hoadon', function (Blueprint $table) {
            $table->integer('MaHoaDon', true);
            $table->integer('MaDonHang')->index('madonhang');
            $table->string('TenKhachHang', 50);
            $table->string('ThongTinThanhToan')->nullable();
            $table->string('order_code', 50)->unique('order_code');
            $table->integer('MaGiamGia')->nullable()->index('magiamgia');
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hoadon');
    }
};
