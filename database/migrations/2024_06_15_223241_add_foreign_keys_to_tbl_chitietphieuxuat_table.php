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
        Schema::table('tbl_chitietphieuxuat', function (Blueprint $table) {
            $table->foreign(['MaPhieuXuat'], 'tbl_chitietphieuxuat_ibfk_1')->references(['MaPhieuXuat'])->on('tbl_phieuxuat')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_chitietphieuxuat', function (Blueprint $table) {
            $table->dropForeign('tbl_chitietphieuxuat_ibfk_1');
        });
    }
};
