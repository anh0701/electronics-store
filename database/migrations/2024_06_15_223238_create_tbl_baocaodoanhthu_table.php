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
        Schema::create('tbl_baocaodoanhthu', function (Blueprint $table) {
            $table->integer('MaBCDT', true);
            $table->date('order_date');
            $table->string('sales', 200);
            $table->string('profit', 200);
            $table->integer('quantity');
            $table->integer('total_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_baocaodoanhthu');
    }
};
