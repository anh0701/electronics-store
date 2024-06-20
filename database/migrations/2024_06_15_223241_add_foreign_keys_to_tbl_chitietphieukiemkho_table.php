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
        Schema::table('tbl_chitietphieukiemkho', function (Blueprint $table) {
            $table->foreign(['order_code'], 'tbl_chitietphieukiemkho_ibfk_1')->references(['order_code'])->on('tbl_phieukiemkho')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_chitietphieukiemkho', function (Blueprint $table) {
            $table->dropForeign('tbl_chitietphieukiemkho_ibfk_1');
        });
    }
};
