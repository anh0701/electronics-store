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
        Schema::create('tbl_tichdiem', function (Blueprint $table) {
            $table->integer('MaTichDiem', true);
            $table->integer('MaTaiKhoan')->index('mataikhoan');
            $table->integer('TongDiem');
            $table->integer('SoLuongDonHang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tichdiem');
    }
};
