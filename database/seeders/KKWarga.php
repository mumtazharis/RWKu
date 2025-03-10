<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KKWarga extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warga')->where('nik', '3500000000000000')->update(['nomor_kk' => '3510000000000000']);
        DB::table('warga')->where('nik', '3500000000000001')->update(['nomor_kk' => '3510000000000001']);
        DB::table('warga')->where('nik', '3500000000000002')->update(['nomor_kk' => '3510000000000002']);
        DB::table('warga')->where('nik', '3500000000000003')->update(['nomor_kk' => '3510000000000003']);
        DB::table('warga')->where('nik', '3500000000000004')->update(['nomor_kk' => '3510000000000004']);
        DB::table('warga')->where('nik', '3500000000000005')->update(['nomor_kk' => '3510000000000005']);
        DB::table('warga')->where('nik', '3500000000000006')->update(['nomor_kk' => '3510000000000000']);
        DB::table('warga')->where('nik', '3500000000000007')->update(['nomor_kk' => '3510000000000001']);
        DB::table('warga')->where('nik', '3500000000000008')->update(['nomor_kk' => '3510000000000002']);
        DB::table('warga')->where('nik', '3500000000000009')->update(['nomor_kk' => '3510000000000003']);
        DB::table('warga')->where('nik', '3500000000000010')->update(['nomor_kk' => '3510000000000004']);

        // tambahkan data lainnya sesuai kebutuhan
    }
}
