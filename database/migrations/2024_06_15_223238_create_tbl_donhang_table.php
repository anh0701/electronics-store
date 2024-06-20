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
        Schema::create('tbl_donhang', function (Blueprint $table) {
            $table->integer('MaDonHang', true);
            $table->string('Email', 50);
            $table->integer('MaGiamGia')->nullable();
            $table->integer('MaGiaoHang');
            $table->integer('TrangThai');
            $table->string('order_code', 50);
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_donhang');
    }
};
