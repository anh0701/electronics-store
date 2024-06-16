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
        Schema::create('tbl_baiviet', function (Blueprint $table) {
            $table->integer('MaBaiViet', true);
            $table->string('TenBaiViet', 200);
            $table->string('SlugBaiViet', 200);
            $table->integer('TrangThai');
            $table->integer('MaDanhMucBV')->index('madanhmucbv');
            $table->text('MoTa');
            $table->string('HinhAnh', 200);
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_baiviet');
    }
};
