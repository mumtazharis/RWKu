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
        Schema::create('kepemilikan', function (Blueprint $table) {
            $table->id('kepemilikan_id')->primary();
            $table->bigInteger('nik')->unique();
            $table->bigInteger('penghasilan');
            $table->smallInteger('keluarga_ditanggung');
            $table->integer('pajak_motor');
            $table->integer('pajak_mobil');
            $table->integer('pajak_bumi_bangunan');
            $table->integer('tagihan_air');
            $table->integer('tagihan_listrik');
            $table->integer('hutang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepemilikan');
    }
};
