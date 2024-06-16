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
        Schema::create('tbl_danhmucbaiviet', function (Blueprint $table) {
            $table->integer('MaDanhMucBV', true);
            $table->string('TenDanhMucBV', 50);
            $table->string('SlugDanhMucBV', 50);
            $table->integer('TrangThai');
            $table->text('MoTa');
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_danhmucbaiviet');
    }
};
