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
        Schema::create('tbl_phieubaohanh', function (Blueprint $table) {
            $table->integer('MaPhieuBaoHanh', true);
            $table->string('order_code', 50)->unique('order_code');
            $table->string('TenKhachHang', 50);
            $table->integer('SoDienThoai');
            $table->timestamp('ThoiGianTao');
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieubaohanh');
    }
};
