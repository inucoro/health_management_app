<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\User;
use App\Models\Movement;

class Meal_Controller extends Controller
{
    public function showMeal()
    {
        // モデルを使用してデータを取得
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        $userId = $user->id; //最初のユーザーidの取得
        
        $movement = Movement::where('user_id', $userId)->first(); //運動消費カロリーの取得
        
        //カロリー
        $ingestion_cal = Meal::where('user_id', $userId)->sum('record_cal'); //合計摂取カロリーの計算
        
        $target_cal = $user->target_cal; //目標カロリーの取得
        
        $remaining_ingestion_cal = $target_cal - $ingestion_cal; //残り摂取カロリーの計算
        
        //タンパク質
        $sum_ingested_protein =  Meal::where('user_id', $userId)->sum('record_protein'); //摂取タンパク質の計算
        
        $target_protein = $user->target_protein; //目標タンパク質の取得
        
        $remaining_ingestion_protein = $target_protein - $sum_ingested_protein; //残りタンパク質の計算
        
        //脂質
        $sum_ingested_fat =  Meal::where('user_id', $userId)->sum('record_fat'); //摂取脂質の計算
        
        $target_fat = $user->target_fat; //目標脂質の取得
        
        $remaining_ingestion_fat = $target_fat - $sum_ingested_fat; //残り脂質の計算
        
        //炭水化物
        $sum_ingested_carbo =  Meal::where('user_id', $userId)->sum('record_carbo'); //摂取炭水化物の計算
        
        $target_carbo = $user->target_carbo; //目標炭水化物の取得
        
        $remaining_ingestion_carbo = $target_carbo - $sum_ingested_carbo; //残り炭水化物の計算
        
        //食事記録を取得
        $meals = Meal::where('user_id', $userId)->get();

        // ビューにデータを渡して表示
        return view('health_managements.meal', 
        ['user' => $user, 
        'ingestion_cal' => $ingestion_cal, 
        'movement' => $movement, 
        'remaining_ingestion_cal' => $remaining_ingestion_cal, 
        'sum_ingested_protein' => $sum_ingested_protein, 
        'target_protein' => $target_protein,
        'remaining_ingestion_protein' => $remaining_ingestion_protein,
        'sum_ingested_fat' => $sum_ingested_fat, 
        'target_fat' => $target_fat,
        'remaining_ingestion_fat' => $remaining_ingestion_fat,
        'sum_ingested_carbo' => $sum_ingested_carbo, 
        'target_carbo' => $target_carbo,
        'remaining_ingestion_carbo' => $remaining_ingestion_carbo,
        'meals' => $meals
        ]);
    }
}