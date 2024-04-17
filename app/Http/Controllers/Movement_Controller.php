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
    
    public function createMovement()
    {
        return view('health_managements.movement_record');
    }
    
    public function storeMovement(Request $request)
    {
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_type' => 'required|string',
            'record_weight' => 'required|numeric',
            'record_times' => 'required|numeric',
            'record_sets' => 'required|numeric',
            'record_movement_times' => 'required|string',
            'movement_consumption_cal' => 'required|string'
        ]);
    
        // movement_created_at フィールドの値を設定
        $data['movement_created_at'] = now(); // 現在の日時を使用する
        
        // 最初のユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // Movementモデルの新しいインスタンスを作成し、データを追加して保存
        $movement = Movement::create($data);
    
        // 食事記録画面にリダイレクトする
        return redirect()->route('movement.show');
    }
}
