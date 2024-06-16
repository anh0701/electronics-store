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
        Schema::table('tbl_sanpham', function (Blueprint $table) {
            $table->foreign(['MaThuongHieu'], 'tbl_sanpham_ibfk_1')->references(['MaThuongHieu'])->on('tbl_thuonghieu')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaDanhMuc'], 'tbl_sanpham_ibfk_2')->references(['MaDanhMuc'])->on('tbl_danhmuc')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_sanpham', function (Blueprint $table) {
            $table->dropForeign('tbl_sanpham_ibfk_1');
            $table->dropForeign('tbl_sanpham_ibfk_2');
        });
    }
};
