<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
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
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //Mealに対するリレーション
    public function meals()   
    {
        return $this->hasMany(Meal::class);  
    }
    
    //Movementに対するリレーション
    public function movements()   
    {
        return $this->hasMany(Movement::class);  
    }
    
    //Body_weightに対するリレーション
    public function body_weights()   
    {
        return $this->hasMany(Body_weght::class);  
    }
    
    //Sleepingに対するリレーション
    public function sleepings()   
    {
        return $this->hasMany(Sleeping::class);  
    }
    
    //Favorite_mealに対するリレーション
    public function favorite_meals()   
    {
        return $this->hasMany(Favorite_meal::class);  
    }
    
    //Favorite_movementsに対するリレーション
    public function favorite_movements()   
    {
        return $this->hasMany(Favorite_movements::class);  
    }
}
