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
        'record_sleeping_memo',
        'sleeping_created_at',
        'sleeping_updated_at'
    ];
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}