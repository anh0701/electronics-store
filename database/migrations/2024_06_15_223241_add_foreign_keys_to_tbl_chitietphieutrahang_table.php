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
        Schema::table('tbl_chitietphieutrahang', function (Blueprint $table) {
            $table->foreign(['MaSanPham'], 'tbl_chitietphieutrahang_ibfk_1')->references(['MaSanPham'])->on('tbl_sanpham')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaPhieuTraHang'], 'tbl_chitietphieutrahang_ibfk_2')->references(['MaPhieuTraHang'])->on('tbl_phieutrahang')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_chitietphieutrahang', function (Blueprint $table) {
            $table->dropForeign('tbl_chitietphieutrahang_ibfk_1');
            $table->dropForeign('tbl_chitietphieutrahang_ibfk_2');
        });
    }
};