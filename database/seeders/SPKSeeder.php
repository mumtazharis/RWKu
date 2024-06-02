<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SPKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kepemilikan_id' => 1,
                'skor_mabac' => null,
                'peringkat_mabac' => null,
                'skor_topsis' => null,
                'peringkat_topsis' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 2,
                'skor_mabac' => null,
                'peringkat_mabac' => null,
                'skor_topsis' => null,
                'peringkat_topsis' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 3,
                'skor_mabac' => null,
                'peringkat_mabac' => null,
                'skor_topsis' => null,
                'peringkat_topsis' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 4,
                'skor_mabac' => null,
                'peringkat_mabac' => null,
                'skor_topsis' => null,
                'peringkat_topsis' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 5,
                'skor_mabac' => null,
                'peringkat_mabac' => null,
                'skor_topsis' => null,
                'peringkat_topsis' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('spk')->insert($data);
    }
}
