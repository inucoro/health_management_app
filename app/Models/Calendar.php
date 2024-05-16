<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';

    protected $fillable = [
        'user_id',
        'date',
        'record_body_weight',
        'record_body_fat',
        'record_sleeping_time',
        'ingestion_cal',
        'sum_movement_consumption_cal',
        'record_calendar_memo',
        'calendar_created_at',
        'calendar_updated_at',
    ];
    
    protected $dates = ['date'];
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
