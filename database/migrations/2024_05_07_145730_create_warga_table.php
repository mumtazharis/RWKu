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
            $table->bigInteger('nomor_kk')->nullable();
            $table->string('nama',100)->nullable();
            $table->string('tempat_lahir',20)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin',10)->nullable();
            $table->string('golongan_darah',4)->nullable();
            $table->string('alamat', 30)->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('kelurahan_desa', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kabupaten_kota', 50)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('agama', 15)->nullable();
            $table->string('pekerjaan', 20)->nullable();
            $table->enum('status_kependudukan', ['warga', 'meninggal', 'pindah', 'pendatang'])->nullable();

            $table->timestamps();
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
