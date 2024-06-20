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
        Schema::create('tbl_thuonghieu', function (Blueprint $table) {
            $table->integer('MaThuongHieu', true);
            $table->string('TenThuongHieu', 50)->nullable();
            $table->string('SlugThuongHieu', 50)->nullable()->unique('slugthuonghieu');
            $table->string('HinhAnh')->nullable();
            $table->integer('TrangThai')->nullable();
            $table->text('MoTa')->nullable();
            $table->timestamp('ThoiGianTao')->nullable();
            $table->timestamp('ThoiGianSua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_thuonghieu');
    }
};
