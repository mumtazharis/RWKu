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
            [
                'level_id' => 3 ,
                'username' => 3500000000000006,
                'password' => '$2y$10$PhfP0pTtPXv//W3JhxD5Ourfj6Zbi2P5teSZMVb1oFoU1JZi2k9He',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 3 ,
                'username' => 3500000000000007,
                'password' => '$2y$10$r9Bjgh5CCxka7LUPq96umeJp.EP0qvH9NCETN6/i2z3rkVf8vlLne',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 3 ,
                'username' => 3500000000000008,
                'password' => '$2y$10$r9Bjgh5CCxka7LUPq96umeJp.EP0qvH9NCETN6/i2z3rkVf8vlLne',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 3 ,
                'username' => 3500000000000009,
                'password' => '$2y$10$2mI6NDqfkrKVx9yuFosfTubDyB95RC2vU6W/0JJedDaBYxVOoiMtS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_id' => 3 ,
                'username' => 3500000000000010,
                'password' => '$2y$10$53cY2Em/wv0/8YJc00e/guyi99yQ9AWv7CnX6qGncRgDB.tXMOtv.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('user')->insert($data);
    }
}
