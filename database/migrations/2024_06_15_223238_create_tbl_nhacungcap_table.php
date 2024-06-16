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
        Schema::create('tbl_nhacungcap', function (Blueprint $table) {
            $table->string('MaNhaCungCap', 50)->primary();
            $table->string('TenNhaCungCap', 50);
            $table->string('DiaChi')->nullable();
            $table->string('SoDienThoai', 15)->nullable();
            $table->string('TenNguoiDaiDien', 50)->nullable();
            $table->string('Email', 50)->nullable()->unique('email');
            $table->integer('TrangThai')->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_nhacungcap');
    }
};
