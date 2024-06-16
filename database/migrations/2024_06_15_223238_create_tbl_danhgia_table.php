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
        Schema::create('tbl_danhgia', function (Blueprint $table) {
            $table->integer('MaDanhGia', true);
            $table->string('Email', 50)->index('email');
            $table->integer('MaSanPham')->index('masanpham');
            $table->text('NoiDung');
            $table->integer('SoSao')->nullable();
            $table->integer('TrangThai');
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_danhgia');
    }
};
