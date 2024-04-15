<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health_management extends Model
{
    // モデルが関連付けられているテーブル名を指定します（デフォルトではクラス名のスネークケースとなります）
    protected $table = 'users';

    // モデルで更新可能なフィールドを指定します
    protected $fillable = [
        'name',
        'sex',
        'height',
        'body_weight',
        'age',
        'image_path',
        'target_body_weight',
        'target_cal',
        'target_protein',
        'target_fat',
        'target_carbo',
        'target_movement_consumption_cal',
        'target_sleeping_time',
        'user_created_at',
        'user_updated_at'
    ];
}
