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
        Schema::create('keluarga', function (Blueprint $table) {
            $table->bigInteger('nomor_kk')->primary();
            $table->bigInteger('nik_kepala_keluarga')->nullable();
            $table->unsignedBigInteger('alamat_kk')->nullable();
            $table->tinyInteger('kelas_ekonomi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
