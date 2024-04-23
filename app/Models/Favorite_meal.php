<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_meal extends Model
{
    protected $table = 'favorite_meals';

    protected $fillable = [
        'user_id',
        'favorite_meal_created_at',
        'favorite_meal_updated_at',
        'favorite_menu',
        'favorite_cal',
        'favorite_protein',
        'favorite_fat',
        'favorite_carbo',
    ];
    
    //ペジネーション
    public function getPaginateByLimit(int $limit_count = 7)
    {
        // favorite_meal_created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('favorite_meal_created_at', 'DESC')->paginate($limit_count);
    }
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
