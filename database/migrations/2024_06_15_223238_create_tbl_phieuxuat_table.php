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
        Schema::create('tbl_phieuxuat', function (Blueprint $table) {
            $table->string('MaPhieuXuat', 50)->primary();
            $table->string('MaTaiKhoan', 50)->index('mataikhoan');
            $table->string('LyDoXuat')->nullable();
            $table->integer('MaDonHang')->nullable();
            $table->integer('TongSoLuong');
            $table->integer('TrangThai');
            $table->string('order_code', 50)->nullable()->unique('order_code');
            $table->timestamp('ThoiGianTao');
            $table->timestamp('ThoiGianSua')->nullable();

            $table->unique(['order_code'], 'order_code_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieuxuat');
    }
};
