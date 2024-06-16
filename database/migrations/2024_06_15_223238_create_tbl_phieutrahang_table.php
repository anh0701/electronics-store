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
        Schema::create('tbl_phieutrahang', function (Blueprint $table) {
            $table->string('MaPhieuTraHang', 50)->primary();
            $table->string('MaNhaCungCap', 50)->index('manhacungcap');
            $table->string('MaPhieuNhap', 50)->index('maphieunhap');
            $table->string('MaTaiKhoan', 50)->index('mataikhoan');
            $table->integer('TrangThai');
            $table->double('TongTien', null, 0)->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieutrahang');
    }
};
