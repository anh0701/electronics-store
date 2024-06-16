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
        Schema::create('tbl_phanquyennguoidung', function (Blueprint $table) {
            $table->integer('MaPQND', true);
            $table->integer('MaPhanQuyen')->index('maphanquyen');
            $table->integer('MaTaiKhoan')->index('mataikhoan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phanquyennguoidung');
    }
};
