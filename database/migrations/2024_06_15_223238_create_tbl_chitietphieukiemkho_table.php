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
        Schema::create('tbl_chitietphieukiemkho', function (Blueprint $table) {
            $table->integer('MaCTPKK');
            $table->string('order_code', 50)->index('order_code');
            $table->integer('MaSanPham');
            $table->string('SoLuong', 50);
            $table->text('TinhTrang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietphieukiemkho');
    }
};
