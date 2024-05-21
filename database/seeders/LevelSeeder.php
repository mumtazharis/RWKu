<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['level_id' => 1, 'level_kode' => 'RW', 'level_nama' => 'Ketua RW'],
            ['level_id' => 2, 'level_kode' => 'RT', 'level_nama' => 'Ketua RT'],
            ['level_id' => 3, 'level_kode' => 'WARGA', 'level_nama' => 'Warga'],
        ];
        DB::table('level')->insert($data);
    }
}
