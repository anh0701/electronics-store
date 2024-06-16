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
        Schema::create('tbl_thanhtruot', function (Blueprint $table) {
            $table->integer('MaThanhTruot', true);
            $table->integer('MaCTGG')->index('mactgg');
            $table->string('SlugThanhTruot', 50)->unique('slugthanhtruot');
            $table->string('HinhAnh', 50);
            $table->text('MoTa');
            $table->integer('TrangThai');
            $table->timestamp('ThoiGianTao');
            $table->timestamp('ThoiGianSua');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_thanhtruot');
    }
};
