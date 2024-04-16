<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SleepingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sleepings')->insert([
            'id' => '1',
            'user_id' => '1',
            'record_sleeping_time' => '8',
            'record_sleeping_memo' => '昨日の夜にスマホを触った。',
            'sleeping_created_at' => new DateTime(),
            'sleeping_updated_at' => new DateTime(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}
