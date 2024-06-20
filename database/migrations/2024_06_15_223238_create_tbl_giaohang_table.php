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
        Schema::create('tbl_giaohang', function (Blueprint $table) {
            $table->integer('MaGiaoHang', true);
            $table->string('TenNguoiNhan', 50);
            $table->string('TienGiaoHang', 50);
            $table->string('DiaChi');
            $table->string('SoDienThoai', 10)->nullable();
            $table->text('GhiChu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_giaohang');
    }
};
