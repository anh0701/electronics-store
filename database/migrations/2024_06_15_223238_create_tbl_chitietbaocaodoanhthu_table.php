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
        Schema::create('tbl_chitietbaocaodoanhthu', function (Blueprint $table) {
            $table->integer('MaCTBCDT', true);
            $table->integer('MaSanPham')->index('masanpham');
            $table->integer('SoLuongNhap');
            $table->integer('SoLuongBan');
            $table->string('GiaNhap', 50);
            $table->string('GiaBan', 50);
            $table->string('MaLienKet', 50)->index('malienket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chitietbaocaodoanhthu');
    }
};
