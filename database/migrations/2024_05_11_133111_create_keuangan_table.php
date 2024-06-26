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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id('keuangan_id');
            $table->bigInteger('penginput');
            $table->double('pemasukan')->nullable();
            $table->double('pengeluaran')->nullable();
            $table->text('pengeluaran_untuk')->nullable();
            $table->text('pemasukan_dari')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
