<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //hanya untuk data dummy
        $data = [
            [
                'nik' => 3500000000000000,
                'nomor_kk' => null,
                'nama' => 'UNTUNG',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1960-01-01',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'AB',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 1,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'KETUA RW',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000001,
                'nomor_kk' => null,
                'nama' => 'SAMSUL',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1969-11-21',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'A',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 1,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'BURUH',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000002,
                'nomor_kk' => null,
                'nama' => 'JOSEPH',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1980-04-06',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'O',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 2,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'KRISTEN',
                'pekerjaan' => 'GURU',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000003,
                'nomor_kk' => null,
                'nama' => 'SUPARMAN',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1971-03-12',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'A',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 3,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'PETANI',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000004,
                'nomor_kk' => null,
                'nama' => 'PAIMIN',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1953-06-01',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'B',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 4,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'PETANI',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000005,
                'nomor_kk' => null,
                'nama' => 'SAMSUDIN',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1970-10-01',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'B',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 1,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'KARYAWAN SWASTA',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000006,
                'nomor_kk' => null,
                'nama' => 'SUPRIADI',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1985-07-15',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'O',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 2,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'PENGUSAHA',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000007,
                'nomor_kk' => null,
                'nama' => 'SULIYAH',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1990-09-23',
                'jenis_kelamin' => 'PEREMPUAN',
                'golongan_darah' => 'A',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 3,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'GURU',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000008,
                'nomor_kk' => null,
                'nama' => 'SUGENG',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1978-04-19',
                'jenis_kelamin' => 'LAKI-LAKI',
                'golongan_darah' => 'B',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 4,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'PEDAGANG',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => 3500000000000009,
                'nomor_kk' => null,
                'nama' => 'SITI',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1982-05-05',
                'jenis_kelamin' => 'PEREMPUAN',
                'golongan_darah' => 'O',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 5,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'IBU RUMAH TANGGA',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),            
            ],
            [
                'nik' => 3500000000000010,
                'nomor_kk' => null,
                'nama' => 'YANTO',
                'tempat_lahir' => 'BLITAR',
                'tanggal_lahir' => '1982-11-05',
                'jenis_kelamin' => 'PEREMPUAN',
                'golongan_darah' => 'O',
                'alamat' => 'DESA LINGKUNGAN DANDER',
                'rt' => 5,
                'rw' => 5,
                'kelurahan_desa' => 'LINGKUNGAN DANDER',
                'kecamatan' => 'TALUN',
                'kabupaten_kota' => 'BLITAR',
                'provinsi' => 'JAWA TIMUR',
                'agama' => 'ISLAM',
                'pekerjaan' => 'Petani',
                'status_kependudukan' => 'warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),            
            ],
        ];

        DB::table('warga')->insert($data);
    }
}