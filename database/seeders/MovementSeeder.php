<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movements')->insert([
            'id' => '2',
            'user_id' => '1',
            'movement_consumption_cal' => '200',
            'record_type' => 'サイドレイズ',
            'record_weight' => '10',
            'record_times' => '20',
            'record_sets' => '3',
            'record_movement_times' => '30',
            'movement_created_at' => new DateTime(),
            'movement_updated_at' => new DateTime(),
            'favorite_type' => 'スクワット',
            'favorite_weight' => '120',
            'favorite_times' => '8',
            'favorite_sets' => '3',
            'favorite_movement_times' => '50',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
         
         DB::table('movements')->insert([
            'id' => '3',
            'user_id' => '1',
            'movement_consumption_cal' => '600',
            'record_type' => 'ランニング',
            'record_weight' => '0',
            'record_times' => '0',
            'record_sets' => '1',
            'record_movement_times' => '30',
            'movement_created_at' => new DateTime(),
            'movement_updated_at' => new DateTime(),
            'favorite_type' => 'スクワット',
            'favorite_weight' => '120',
            'favorite_times' => '8',
            'favorite_sets' => '3',
            'favorite_movement_times' => '50',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}
