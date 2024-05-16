<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->insert([
            'id' => '4',
            'user_id' => '1',
            'date' => '2024-04-15',
            'record_body_weight' => '63',
            'record_body_fat' => '13',
            'ingestion_cal' => '1500',
            'sum_movement_consumption_cal' => '300',
            'record_calendar_memo' => '昨日は少し食べ過ぎた。',
            'calendar_created_at' => new DateTime(),
            'calendar_updated_at' => new DateTime(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
         
        DB::table('calendars')->insert([
            'id' => '5',
            'user_id' => '1',
            'date' => '2024-06-14',
            'record_body_weight' => '64',
            'record_body_fat' => '14',
            'ingestion_cal' => '1000',
            'sum_movement_consumption_cal' => '200',
            'record_calendar_memo' => '昨日は少し食べ過ぎた。',
            'calendar_created_at' => new DateTime(),
            'calendar_updated_at' => new DateTime(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}
