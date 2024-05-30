<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
           
            [
                'level_id' => 1,
                'username' => 3500000000000000,
                'password' => '$2y$10$fum77w4eaCy.Gg/HOGaF7.w73a0nkscl61hUv3MUk4UoMCeuem5YG',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('user')->insert($data);
    }
}
