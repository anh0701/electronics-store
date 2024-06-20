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
        Schema::create('tbl_xaphuongthitran', function (Blueprint $table) {
            $table->string('MaXaPhuong', 5)->primary();
            $table->string('TenXaPhuong', 100);
            $table->string('type', 30);
            $table->integer('MaQuanHuyen')->nullable()->index('maquanhuyen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_xaphuongthitran');
    }
};
