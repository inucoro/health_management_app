<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class Body_weightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('body_weights')->insert([
            'id' => '1',
            'user_id' => '1',
            'record_body_weight' => '65',
            'record_body_fat' => '13',
            'record_body_weight_memo' => '昨日は少し食べ過ぎた。',
            'body_weight_created_at' => new DateTime(),
            'body_weight_updated_at' => new DateTime(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}
