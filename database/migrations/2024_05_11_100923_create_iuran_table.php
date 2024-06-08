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
        Schema::create('iuran', function (Blueprint $table) {
            $table->id('iuran_id');
            $table->unsignedBigInteger('kegiatan_id');
            $table->bigInteger('nomor_kk');
            $table->double('nominal');
            $table->enum('status', ['lunas', 'belum lunas', 'menunggu']);
            $table->string('bukti_pembayarann')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran');
    }
};
