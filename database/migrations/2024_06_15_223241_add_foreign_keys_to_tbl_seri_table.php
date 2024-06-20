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
        Schema::table('tbl_seri', function (Blueprint $table) {
            $table->foreign(['MaPN'], 'tbl_seri_ibfk_1')->references(['MaPhieuNhap'])->on('tbl_phieunhap')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_seri', function (Blueprint $table) {
            $table->dropForeign('tbl_seri_ibfk_1');
        });
    }
};
