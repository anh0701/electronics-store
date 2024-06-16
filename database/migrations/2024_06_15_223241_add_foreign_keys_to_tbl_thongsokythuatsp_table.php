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
        Schema::table('tbl_thongsokythuatsp', function (Blueprint $table) {
            $table->foreign(['MaSanPham'], 'tbl_thongsokythuatsp_ibfk_1')->references(['MaSanPham'])->on('tbl_sanpham')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaTSKT'], 'tbl_thongsokythuatsp_ibfk_2')->references(['MaTSKT'])->on('tbl_thongsokythuat')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_thongsokythuatsp', function (Blueprint $table) {
            $table->dropForeign('tbl_thongsokythuatsp_ibfk_1');
            $table->dropForeign('tbl_thongsokythuatsp_ibfk_2');
        });
    }
};
