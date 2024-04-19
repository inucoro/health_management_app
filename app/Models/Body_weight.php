<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body_weight extends Model
{
    
    protected $table = 'body_weights';

    protected $fillable = [
        'user_id',
        'record_body_weight',
        'record_body_fat',
        'record_body_weight_memo',
        'body_weight_created_at',
        'body_weight_updated_at',
    ];
    
    //ペジネーション
    public function getPaginateByLimit(int $limit_count = 7)
    {
        // body_weight_created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('body_weight_created_at', 'DESC')->paginate($limit_count);
    }
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
