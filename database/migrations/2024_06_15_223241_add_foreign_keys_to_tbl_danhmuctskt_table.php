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
        Schema::table('tbl_danhmuctskt', function (Blueprint $table) {
            $table->foreign(['MaDanhMuc'], 'tbl_danhmuctskt_ibfk_1')->references(['MaDanhMuc'])->on('tbl_danhmuc')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_danhmuctskt', function (Blueprint $table) {
            $table->dropForeign('tbl_danhmuctskt_ibfk_1');
        });
    }
};
