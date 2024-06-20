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
        Schema::create('tbl_chuongtrinhgiamgia', function (Blueprint $table) {
            $table->integer('MaCTGG', true);
            $table->string('SlugCTGG')->unique('slugctgg');
            $table->string('TenCTGG');
            $table->string('HinhAnh');
            $table->text('MoTa');
            $table->integer('TrangThai');
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
            $table->timestamp('ThoiGianBatDau');
            $table->timestamp('ThoiGianKetThuc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chuongtrinhgiamgia');
    }
};
