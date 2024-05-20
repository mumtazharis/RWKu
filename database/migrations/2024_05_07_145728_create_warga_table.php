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
        Schema::create('warga', function (Blueprint $table) {
            $table->bigInteger('nik')->primary();   
            $table->unsignedBigInteger('tempat_tinggal');
            $table->tinyInteger('kelas_ekonomi');
            $table->enum('status_kependudukan', ['warga', 'meninggal', 'pindah', 'pendatang']);

        

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_warga');
    }
};
