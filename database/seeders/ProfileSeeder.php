<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Shota',
            'sex' => '男',
            'height' => '168',
            'body_weight' => '64',
            'age' => '22',
            'image_path' => 'a',
            'target_body_weight' => '65',
            'target_cal' => '2200',
            'target_protein' => '120',
            'target_fat' => '50',
            'target_carbo' => '300',
            'target_movement_comsumption_cal' => '400',
            'target_sleeping_time' => '8',
            'user_created_at' => new DateTime(),
            'user_updated_at' => new DateTime(),
            'email' => 'inucorotetu@gmail.com',
            'email_verified_at' => new DateTime(),
            'password' => 'abcde',
            // 'rememberToken' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}
