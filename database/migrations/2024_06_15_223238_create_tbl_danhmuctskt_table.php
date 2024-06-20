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
        Schema::create('tbl_danhmuctskt', function (Blueprint $table) {
            $table->integer('MaDMTSKT', true);
            $table->string('TenDMTSKT', 50);
            $table->string('SlugDMTSKT', 50);
            $table->integer('TrangThai');
            $table->text('MoTa');
            $table->integer('MaDanhMuc')->index('madanhmuc');
            $table->timestamp('ThoiGianTao');
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_danhmuctskt');
    }
};
