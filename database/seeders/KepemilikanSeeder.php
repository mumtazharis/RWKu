<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KepemilikanSeeder extends Seeder
{
   
    public function run(): void
    {
        //hanya untuk data dummy
        $data = [];
        $baseKK = 3510000000000000;

        for ($i = 0; $i <= 5; $i++) {
            // Menentukan apakah keluarga memiliki atau tidak
            $hasCar = rand(0, 1) == 1;
            $hasAir = rand(0, 1) == 1;
            $hasHutang = rand(0, 1) == 1;

            $data[] = [
                'penghasilan' => 500000 + rand(500000, 10000000),
                'nomor_kk' => 3510000000000000 + $i,
                'keluarga_ditanggung' => rand(1, 5),
                'pajak_motor' => rand(200000, 500000),
                'pajak_mobil' => $hasCar ? rand(500000, 1000000) : 0,
                'pajak_bumi_bangunan' => rand(100000, 200000),
                'tagihan_air' => $hasAir ? rand(100000, 150000) : 0,
                'tagihan_listrik' => rand(150000, 250000),
                'hutang' => $hasHutang ? rand(100000, 20000000) : 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('kepemilikan')->insert($data);
    }
}
