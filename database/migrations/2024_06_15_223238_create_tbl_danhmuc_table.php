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
        Schema::create('tbl_danhmuc', function (Blueprint $table) {
            $table->integer('MaDanhMuc', true);
            $table->string('TenDanhMuc', 50);
            $table->string('SlugDanhMuc', 50)->unique('slugdanhmuc');
            $table->text('MoTa');
            $table->integer('TrangThai');
            $table->integer('DanhMucCha')->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_danhmuc');
    }
};
