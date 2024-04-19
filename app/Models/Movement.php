<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movements';

    protected $fillable = [
        'user_id',
        'movement_consumption_cal',
        'record_type',
        'record_weight',
        'record_times',
        'record_sets',
        'record_movement_times',
        'movement_created_at',
        'movement_updated_at',
        'favorite_type',
        'favorite_weight',
        'favorite_times',
        'favorite_sets',
        'favorite_movement_times'
    ];
    
    //ペジネーション
    public function getPaginateByLimit(int $limit_count = 7)
    {
        // movement_created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('movement_created_at', 'DESC')->paginate($limit_count);
    }
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}