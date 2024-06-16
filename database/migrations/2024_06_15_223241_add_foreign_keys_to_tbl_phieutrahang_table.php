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
        Schema::table('tbl_phieutrahang', function (Blueprint $table) {
            $table->foreign(['MaNhaCungCap'], 'tbl_phieutrahang_ibfk_1')->references(['MaNhaCungCap'])->on('tbl_nhacungcap')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaTaiKhoan'], 'tbl_phieutrahang_ibfk_2')->references(['MaTaiKhoan'])->on('tbl_taikhoan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaPhieuNhap'], 'tbl_phieutrahang_ibfk_3')->references(['MaPhieuNhap'])->on('tbl_phieunhap')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_phieutrahang', function (Blueprint $table) {
            $table->dropForeign('tbl_phieutrahang_ibfk_1');
            $table->dropForeign('tbl_phieutrahang_ibfk_2');
            $table->dropForeign('tbl_phieutrahang_ibfk_3');
        });
    }
};
