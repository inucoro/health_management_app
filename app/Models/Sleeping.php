<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sleeping extends Model
{
    protected $table = 'sleepings';

    protected $fillable = [
        'user_id',
        'record_sleeping_time',
        'record_wake_up_time',
        'record_bedtime',
        'record_sleeping_memo',
        'sleeping_created_at',
        'sleeping_updated_at'
    ];
    
    //ペジネーション
    public function getPaginateByLimit(int $limit_count = 7)
    {
        // sleeping_created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('sleeping_created_at', 'DESC')->paginate($limit_count);
    }
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}