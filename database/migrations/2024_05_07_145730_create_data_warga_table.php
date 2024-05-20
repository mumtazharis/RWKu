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
        Schema::create('data_warga', function (Blueprint $table) {
            $table->id('data_warga_id')->primary();
            $table->bigInteger('nik')->unique();
            $table->bigInteger('nomor_kk');
            $table->string('nama',100);
            $table->string('tempat_lahir',20);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin',10);
            $table->string('golongan_darah',4);
            $table->string('alamat', 30);
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('kelurahan_desa', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupaten_kota', 50);
            $table->string('provinsi', 50);
            $table->string('agama', 15);
            $table->string('pekerjaan', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_warga');
    }
};
