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
        Schema::table('tbl_quyenvaitro', function (Blueprint $table) {
            $table->foreign(['MaQuyen'], 'tbl_quyenvaitro_ibfk_1')->references(['MaPhanQuyen'])->on('tbl_quyen')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaVaiTro'], 'tbl_quyenvaitro_ibfk_2')->references(['MaVaiTro'])->on('tbl_vaitro')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_quyenvaitro', function (Blueprint $table) {
            $table->dropForeign('tbl_quyenvaitro_ibfk_1');
            $table->dropForeign('tbl_quyenvaitro_ibfk_2');
        });
    }
};
