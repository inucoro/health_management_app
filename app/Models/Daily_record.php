<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_record extends Model
{
    protected $table = 'daily_records';

    protected $fillable = [
        'user_id',
        'date',
        'ingestion_cal',
        'sum_ingested_protein',
        'sum_ingested_fat',
        'sum_ingested_carbo',
        'sum_movement_consumption_cal',
        'created_at',
        'updated_at',
    ];
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
