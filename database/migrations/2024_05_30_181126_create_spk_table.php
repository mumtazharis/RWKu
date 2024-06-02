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
        Schema::create('spk', function (Blueprint $table) {
            $table->id('spk_id');
            $table->unsignedBigInteger('kepemilikan_id')->unique();
            $table->double('skor_mabac')->nullable();
            $table->integer('peringkat_mabac')->nullable();
            $table->double('skor_topsis')->nullable();
            $table->integer('peringkat_topsis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk');
    }
};
