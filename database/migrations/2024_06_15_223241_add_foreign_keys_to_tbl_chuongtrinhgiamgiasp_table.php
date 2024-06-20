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
        Schema::table('tbl_chuongtrinhgiamgiasp', function (Blueprint $table) {
            $table->foreign(['MaCTGG'], 'tbl_chuongtrinhgiamgiasp_ibfk_1')->references(['MaCTGG'])->on('tbl_chuongtrinhgiamgia')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaSanPham'], 'tbl_chuongtrinhgiamgiasp_ibfk_2')->references(['MaSanPham'])->on('tbl_sanpham')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_chuongtrinhgiamgiasp', function (Blueprint $table) {
            $table->dropForeign('tbl_chuongtrinhgiamgiasp_ibfk_1');
            $table->dropForeign('tbl_chuongtrinhgiamgiasp_ibfk_2');
        });
    }
};
