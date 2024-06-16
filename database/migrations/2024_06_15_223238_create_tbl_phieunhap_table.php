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
        Schema::create('tbl_phieunhap', function (Blueprint $table) {
            $table->string('MaPhieuNhap', 50)->primary();
            $table->string('MaNhaCungCap', 50)->index('manhacungcap');
            $table->string('MaTaiKhoan', 50)->index('mataikhoan');
            $table->float('TongTien', null, 0);
            $table->float('TienTra', null, 0)->nullable();
            $table->float('TienNo', null, 0)->nullable();
            $table->string('PhuongThucThanhToan')->nullable();
            $table->string('TrangThai', 50)->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieunhap');
    }
};
