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
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
