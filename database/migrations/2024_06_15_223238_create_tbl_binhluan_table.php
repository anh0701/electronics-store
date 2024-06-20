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
        Schema::create('tbl_binhluan', function (Blueprint $table) {
            $table->integer('MaBinhLuan', true);
            $table->string('Email', 50);
            $table->integer('MaBaiViet')->nullable();
            $table->integer('BaiVietCha')->nullable();
            $table->text('NoiDung');
            $table->integer('TrangThai');
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_binhluan');
    }
};
