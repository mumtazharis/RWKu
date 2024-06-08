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
            [
                'level_id' => 2,
                'username' => 3500000000000001,
                'password' => '$2y$10$/Ho/Z.TXD1FalbPTalKZfe2M7/AAlNWQjQnpM0VgQ5QpXhN.dmdUC',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 2,
                'username' => 3500000000000002,
                'password' => '$2y$10$vdonNyoB20xiekUrRP5HtOWKcVMaKDvzRQaGEPaqkB2/7v19.AtJi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 2,
                'username' => 3500000000000003,
                'password' => '$$2y$10$0v8jquJ52fo5N8g5ThE5T.OnF7OzLv19f4j6s8b8mRUrBPSBLb/bO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 2,
                'username' => 3500000000000004,
                'password' => '$2y$10$2hZQRsc2/8k6IyYiijh4/.gxhRdlYRP8CX8fY3kawXu8U3lNpGO7a',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 3 ,
                'username' => 3500000000000005,
                'password' => '$2y$10$btBJyfNwy323UDAh3b5u3.dAtyWVTtXBt3PXC7TIIhvZPMRmUZzoi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('user')->insert($data);
    }
}
