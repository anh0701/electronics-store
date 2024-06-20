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
        Schema::create('tbl_taikhoan', function (Blueprint $table) {
            $table->string('MaTaiKhoan', 50)->primary();
            $table->string('Email', 50);
            $table->string('TenTaiKhoan', 50)->nullable();
            $table->string('TenNguoiDung', 50)->nullable();
            $table->string('DiaChi')->nullable();
            $table->string('SoDienThoai', 20)->nullable();
            $table->string('MatKhau', 200);
            $table->string('HinhAnh', 50)->nullable();
            $table->integer('TrangThai')->nullable();
            $table->string('BacNguoiDung')->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
            $table->string('Quyen', 50)->nullable();
            $table->integer('Pin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_taikhoan');
    }
};
