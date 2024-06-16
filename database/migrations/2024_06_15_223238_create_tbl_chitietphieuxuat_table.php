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
        Schema::create('tbl_chitietphieuxuat', function (Blueprint $table) {
            $table->string('MaCTPX', 50)->primary();
            $table->string('MaPhieuXuat', 50)->index('order_code');
            $table->integer('MaSanPham');
            $table->string('SoLuong', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietphieuxuat');
    }
};
