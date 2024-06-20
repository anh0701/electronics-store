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
        Schema::create('tbl_phigiaohang', function (Blueprint $table) {
            $table->integer('MaPhiGiaoHang', true);
            $table->integer('MaThanhPho')->nullable()->index('mathanhpho');
            $table->integer('MaQuanHuyen')->nullable()->index('maquanhuyen');
            $table->integer('MaXaPhuong')->nullable()->index('maxaphuong');
            $table->string('SoTien', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phigiaohang');
    }
};
