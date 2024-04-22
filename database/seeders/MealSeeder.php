<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('meals')->insert([
            'id' => '1',
            'user_id' => '1',
            'record_menu' => '味噌汁',
            'record_cal' => '20',
            'record_protein' => '1',
            'record_fat' => '1',
            'record_carbo' => '4',
            'meal_created_at' => new DateTime(),
            'meal_updated_at' => new DateTime(),
            'favorite_menu' => '鶏胸肉',
            'favorite_cal' => '100',
            'favorite_protein' => '24',
            'favorite_fat' => '1',
            'favorite_carbo' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
         
         DB::table('meals')->insert([
            'id' => '2',
            'user_id' => '1',
            'record_menu' => 'パスタ',
            'record_cal' => '350',
            'record_protein' => '10',
            'record_fat' => '6',
            'record_carbo' => '85',
            'meal_created_at' => new DateTime(),
            'meal_updated_at' => new DateTime(),
            'favorite_menu' => '鶏胸肉',
            'favorite_cal' => '100',
            'favorite_protein' => '24',
            'favorite_fat' => '1',
            'favorite_carbo' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}
