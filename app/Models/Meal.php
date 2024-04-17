<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'meals';

    protected $fillable = [
        'user_id',
        'record_menu',
        'record_cal',
        'record_protein',
        'record_fat',
        'record_carbo',
        'meal_created_at',
        'meal_updated_at',
        'favorite_menu',
        'favorite_cal',
        'favorite_protein',
        'favorite_fat',
        'favorite_carbo',
        'ingestion_cal',
        'remaining_ingestion_cal',
        'sum_ingested_protein',
        'remaining_ingestion_protein',
        'sum_ingested_fat',
        'remeinng_ingestion_fat',
        'sum_ingested_carbo',
        'remeinng_ingestion_carbo'
    ];
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
