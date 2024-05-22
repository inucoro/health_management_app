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
        $today = (new DateTime())->format('Y-m-d');

        DB::table('calendars')->insert([
            'id' => '1',
            'user_id' => '1',
            'date' => $today,
            'record_body_weight' => '0',
            'record_body_fat' => '0',
            'ingestion_cal' => '0',
            'sum_movement_consumption_cal' => '0',
            'record_calendar_memo' => '',
            'calendar_created_at' => new DateTime(),
            'calendar_updated_at' => new DateTime(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
