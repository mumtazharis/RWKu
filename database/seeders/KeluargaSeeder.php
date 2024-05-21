<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nomor_kk' => 3510000000000000,
                'nik_kepala_keluarga' => 3500000000000000,
                'alamat_kk' => 1,
                'kelas_ekonomi' => null,
                'kepemilikan_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_kk' => 3510000000000001,
                'nik_kepala_keluarga' => 3500000000000001,
                'alamat_kk' => 2,
                'kelas_ekonomi' => null,
                'kepemilikan_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_kk' => 3510000000000002,
                'nik_kepala_keluarga' => 3500000000000002,
                'alamat_kk' => 3,
                'kelas_ekonomi' => null,
                'kepemilikan_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_kk' => 3510000000000003,
                'nik_kepala_keluarga' => 3500000000000003,
                'alamat_kk' => 4,
                'kelas_ekonomi' => null,
                'kepemilikan_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_kk' => 3510000000000004,
                'nik_kepala_keluarga' => 3500000000000004,
                'alamat_kk' => 1,
                'kelas_ekonomi' => null,
                'kepemilikan_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_kk' => 3510000000000005,
                'nik_kepala_keluarga' => 3500000000000005,
                'alamat_kk' => 2,
                'kelas_ekonomi' => null,
                'kepemilikan_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        DB::table('keluarga')->insert($data);
    }
}
