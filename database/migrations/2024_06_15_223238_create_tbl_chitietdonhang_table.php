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
        Schema::create('tbl_chitietdonhang', function (Blueprint $table) {
            $table->integer('MaCTDH', true);
            $table->string('order_code', 50)->index('order_code');
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('SoLuong')->nullable();
            $table->string('GiaSanPham', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietdonhang');
    }
};
