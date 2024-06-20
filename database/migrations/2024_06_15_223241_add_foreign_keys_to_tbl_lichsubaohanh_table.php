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
        Schema::table('tbl_lichsubaohanh', function (Blueprint $table) {
            $table->foreign(['MaPhieuBaoHanh'], 'tbl_lichsubaohanh_ibfk_1')->references(['MaPhieuBaoHanh'])->on('tbl_phieubaohanh')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_lichsubaohanh', function (Blueprint $table) {
            $table->dropForeign('tbl_lichsubaohanh_ibfk_1');
        });
    }
};
