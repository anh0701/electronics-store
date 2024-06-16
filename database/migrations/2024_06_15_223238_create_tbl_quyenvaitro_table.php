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
        Schema::create('tbl_quyenvaitro', function (Blueprint $table) {
            $table->integer('MaQVT', true);
            $table->integer('MaQuyen')->index('maquyen');
            $table->integer('MaVaiTro')->index('mavaitro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_quyenvaitro');
    }
};
