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
        Schema::create('tbl_phieugiamgia', function (Blueprint $table) {
            $table->integer('MaGiamGia', true);
            $table->string('TenMaGiamGia', 50);
            $table->string('SlugMaGiamGia', 50);
            $table->integer('DonViTinh');
            $table->integer('TrangThai')->default(1);
            $table->integer('BacNguoiDung');
            $table->string('TriGia', 50);
            $table->string('MaCode', 50);
            $table->timestamp('ThoiGianBatDau')->useCurrent();
            $table->timestamp('ThoiGianKetThuc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieugiamgia');
    }
};
