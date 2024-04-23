<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_movement extends Model
{
    protected $table = 'favorite_movements';

    protected $fillable = [
        'user_id',
        'favorite_movement_created_at',
        'favorite_movement_updated_at',
        'favorite_type',
        'favorite_weight',
        'favorite_times',
        'favorite_sets',
        'favorite_movement_times',
        'favorite_movement_consumption_cal',
    ];
    
    //ペジネーション
    public function getPaginateByLimit(int $limit_count = 7)
    {
        // favorite_movement_created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('favorite_movement_created_at', 'DESC')->paginate($limit_count);
    }
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
