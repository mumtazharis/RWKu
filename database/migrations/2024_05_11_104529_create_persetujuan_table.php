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
        Schema::create('persetujuan', function (Blueprint $table) {
            $table->id('persetujuan_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('jenis', ['data kepemilikan', 'iuran', 'kegiatan']);
            $table->text('query');
            $table->text('keterangan');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persetujuan');
    }
};
