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
        Schema::create('tbl_sanpham', function (Blueprint $table) {
            $table->integer('MaSanPham', true);
            $table->string('TenSanPham');
            $table->string('SlugSanPham')->nullable()->unique('slugsanpham');
            $table->integer('MaThuongHieu')->nullable()->index('mathuonghieu');
            $table->integer('MaDanhMuc')->nullable()->index('madanhmuc');
            $table->string('HinhAnh')->nullable();
            $table->integer('TrangThai')->nullable();
            $table->text('MoTa')->nullable();
            $table->integer('SoLuongHienTai')->nullable();
            $table->integer('SoLuongBan')->nullable();
            $table->integer('SoLuongTrongKho')->nullable();
            $table->integer('GiaSanPham')->nullable();
            $table->double('ChieuCao', null, 0)->nullable();
            $table->double('ChieuNgang', null, 0)->nullable();
            $table->double('ChieuDay', null, 0)->nullable();
            $table->double('CanNang', null, 0)->nullable();
            $table->text('ThongSoKyThuat')->nullable();
            $table->integer('ThoiGianBaoHanh')->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sanpham');
    }
};
