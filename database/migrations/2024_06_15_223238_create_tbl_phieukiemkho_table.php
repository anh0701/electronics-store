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
        Schema::create('tbl_phieukiemkho', function (Blueprint $table) {
            $table->integer('MaPKK', true);
            $table->integer('MaTaiKhoan')->index('mataikhoan');
            $table->string('order_code', 50)->unique('order_code');
            $table->timestamp('ThoiGianTao');
            $table->timestamp('ThoiGianSua');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phieukiemkho');
    }
};
