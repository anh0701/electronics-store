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
        Schema::create('tbl_thongsokythuatsp', function (Blueprint $table) {
            $table->integer('MaTSKTSP', true);
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('MaTSKT')->index('matskt');
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_thongsokythuatsp');
    }
};
