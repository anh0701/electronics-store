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
        Schema::table('tbl_phieunhap', function (Blueprint $table) {
            $table->foreign(['MaNhaCungCap'], 'tbl_phieunhap_ibfk_1')->references(['MaNhaCungCap'])->on('tbl_nhacungcap')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaTaiKhoan'], 'tbl_phieunhap_ibfk_2')->references(['MaTaiKhoan'])->on('tbl_taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_phieunhap', function (Blueprint $table) {
            $table->dropForeign('tbl_phieunhap_ibfk_1');
            $table->dropForeign('tbl_phieunhap_ibfk_2');
        });
    }
};
