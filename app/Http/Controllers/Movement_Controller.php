<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\User;

class Movement_Controller extends Controller
{
    public function showMovement()
    {
        // モデルを使用してデータを取得
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        $userId = $user->id; //最初のユーザーidの取得
        
        $sum_movement_consumption_cal = Movement::where('user_id', $userId)->sum('movement_consumption_cal'); //合計運動消費カロリーの計算
        
        $target_movement_consumption_cal = $user->target_movement_consumption_cal; //目標運動消費カロリーの取得
        
        //運動記録を取得
        $movements = Movement::where('user_id', $userId)->get();
        
        // ビューにデータを渡して表示
        return view('health_managements.movement', 
        ['user' => $user, 
        'sum_movement_consumption_cal' => $sum_movement_consumption_cal,
        'target_movement_consumption_cal' => $target_movement_consumption_cal,
        'movements' => $movements
        ]);
    }
}
