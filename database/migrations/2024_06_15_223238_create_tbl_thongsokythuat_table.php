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
        Schema::create('tbl_thongsokythuat', function (Blueprint $table) {
            $table->integer('MaTSKT', true);
            $table->string('TenTSKT', 50);
            $table->integer('MaDMTSKT')->nullable()->index('madmtskt');
            $table->integer('TrangThai');
            $table->string('SlugTSKT', 50);
            $table->text('MoTa')->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_thongsokythuat');
    }
};
