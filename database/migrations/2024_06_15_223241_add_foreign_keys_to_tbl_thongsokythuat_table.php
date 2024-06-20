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
        Schema::table('tbl_thongsokythuat', function (Blueprint $table) {
            $table->foreign(['MaDMTSKT'], 'tbl_thongsokythuat_ibfk_1')->references(['MaDMTSKT'])->on('tbl_danhmuctskt')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_thongsokythuat', function (Blueprint $table) {
            $table->dropForeign('tbl_thongsokythuat_ibfk_1');
        });
    }
};
