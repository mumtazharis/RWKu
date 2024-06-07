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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('kegiatan_id');
            $table->string('kegiatan_nama');
            $table->text('kegiatan_deskripsi');
            $table->text('kegiatan_lokasi');
            $table->date('kegiatan_tanggal');
            $table->time('kegiatan_waktu');
            $table->string('kegiatan_peserta', 6);
            $table->text('foto');
            $table->integer('total_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
