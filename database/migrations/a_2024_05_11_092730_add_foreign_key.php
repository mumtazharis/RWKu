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
        Schema::table('rw', function (Blueprint $table) {
            $table->foreign('nik_ketua_rw')->references('nik')->on('warga');
        });

        Schema::table('rt', function (Blueprint $table) {
            $table->foreign('rw_id')->references('rw_id')->on('rw');
            $table->foreign('nik_ketua_rt')->references('nik')->on('warga');
        });

        Schema::table('keluarga', function (Blueprint $table) {
            $table->foreign('nik_kepala_keluarga')->references('nik')->on('warga');
            $table->foreign('alamat_kk')->references('rt_id')->on('rt');
        });

        Schema::table('warga', function (Blueprint $table) {
            $table->foreign('nomor_kk')->references('nomor_kk')->on('keluarga');
        });

        Schema::table('user', function (Blueprint $table) {
            $table->foreign('level_id')->references('level_id')->on('level');
            $table->foreign('username')->references('nik')->on('warga');
        });

        Schema::table('persetujuan', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('user');
        });

        Schema::table('kepemilikan', function (Blueprint $table) {
            $table->foreign('nomor_kk')->references('nomor_kk')->on('keluarga');
        });

        Schema::table('iuran', function (Blueprint $table) {
            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('kegiatan');
            $table->foreign('nomor_kk')->references('nomor_kk')->on('keluarga');
        });

        Schema::table('dokumentasi', function (Blueprint $table) {
            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('kegiatan');
        });

        Schema::table('keuangan', function (Blueprint $table) {
            $table->foreign('penginput')->references('nik')->on('warga');
        });

        Schema::table('peserta', function (Blueprint $table) {
            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('kegiatan');
            $table->foreign('nik')->references('nik')->on('warga');
        });

        Schema::table('spk', function (Blueprint $table) {
            $table->foreign('kepemilikan_id')->references('kepemilikan_id')->on('kepemilikan');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
