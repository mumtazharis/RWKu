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
                'peringkat_mabac' => null,
                'peringkat_electre' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 2,
                'peringkat_mabac' => null,
                'peringkat_electre' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 3,
                'peringkat_mabac' => null,
                'peringkat_electre' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 4,
                'peringkat_mabac' => null,
                'peringkat_electre' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 5,
                'peringkat_mabac' => null,
                'peringkat_electre' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kepemilikan_id' => 6,
                'peringkat_mabac' => null,
                'peringkat_electre' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('spk')->insert($data);
    }
}
