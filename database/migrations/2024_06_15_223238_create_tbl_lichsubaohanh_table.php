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
        Schema::create('tbl_lichsubaohanh', function (Blueprint $table) {
            $table->integer('MaLSBH')->primary();
            $table->integer('MaPhieuBaoHanh')->index('maphieubaohanh');
            $table->timestamp('NgayBaoHanh');
            $table->integer('MaTaiKhoan');
            $table->string('order_code', 50)->unique('malienket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lichsubaohanh');
    }
};
