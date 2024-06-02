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
            $table->double('skor_mabac');
            $table->integer('peringkat_mabac');
            $table->double('skor_topsis');
            $table->integer('peringkat_topsis');
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