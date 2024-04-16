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
            'id' => '1',
            'user_id' => '1',
            'movement_comsumption_cal' => '500',
            'record_type' => 'ベンチプレス',
            'record_weight' => '100',
            'record_times' => '10',
            'record_sets' => '5',
            'record_movement_times' => '60',
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
