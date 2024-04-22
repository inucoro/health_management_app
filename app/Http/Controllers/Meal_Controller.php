<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\User;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;

class Meal_Controller extends Controller
{
    public function showMeal()
    {
        // モデルを使用してデータを取得
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        $sum_movement_consumption_cal = Movement::where('user_id', $userId)->sum('movement_consumption_cal'); //合計運動消費カロリーの計算
        
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
        $meals = Meal::where('user_id', $userId)->orderBy('meal_created_at', 'desc')->paginate(7); // 7件ごとにページネーション;


        // ビューにデータを渡して表示
        return view('health_managements.meal', 
        ['user' => $user, 
        'ingestion_cal' => $ingestion_cal, 
        'sum_movement_consumption_cal' => $sum_movement_consumption_cal, 
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
    
    public function createMeal()
    {
        return view('health_managements.meal_record');
    }
    
    public function storeMeal(Request $request)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_menu' => 'required|string',
            'record_cal' => 'required|numeric',
            'record_protein' => 'required|numeric',
            'record_fat' => 'required|numeric',
            'record_carbo' => 'required|numeric'
        ]);
    
        // meal_created_at フィールドの値を設定
        $data['meal_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // Mealモデルの新しいインスタンスを作成し、データを追加して保存
        $meal = Meal::create($data);
    
        // 食事記録画面にリダイレクトする
        return redirect()->route('meal.show');
    }
    
    public function editMeal($id)
    {
        // 特定のIDに対応する食事データを取得
        $meal = Meal::findOrFail($id);
    
        // 編集画面にデータを渡して表示
        return view('health_managements.edit_meal', ['meal' => $meal]);
    }
    
    public function updateMeal(Request $request, $id)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_menu' => 'required|string',
            'record_cal' => 'required|numeric',
            'record_protein' => 'required|numeric',
            'record_fat' => 'required|numeric',
            'record_carbo' => 'required|numeric'
        ]);
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // 特定のIDに対応する食事データを取得し、更新する
        $meal = Meal::where('id', $id)->where('user_id', $user->id)->update($data);
    
        // 食事表示画面にリダイレクトする
        return redirect()->route('meal.show');
    }
    
    public function deleteMeal($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();
        
        // 食事表示画面にリダイレクトする
        return redirect()->route('meal.show')->with('success', '食事記録が削除されました');
    }
    
    
    //お気に入り一覧
    public function showfavoriteMeal()
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        //食事記録を取得
        $meals = Meal::where('user_id', $userId)->orderBy('meal_created_at', 'desc')->paginate(7); // 7件ごとにページネーション
        
        return view('health_managements.favorite_meal', ['meals' => $meals]);
    }
    
    //お気に入り記録画面
    public function showrecordfavoriteMeal($id)
    {
        // 特定のIDに対応する食事データを取得
        $meal = Meal::findOrFail($id);
    
        // 編集画面にデータを渡して表示
        return view('health_managements.favorite_meal_record', ['meal' => $meal]);
    }
    
    //お気に入り追加
    public function addfavoriteMeal(Request $request, $id)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_menu' => 'required|string',
            'record_cal' => 'required|numeric',
            'record_protein' => 'required|numeric',
            'record_fat' => 'required|numeric',
            'record_carbo' => 'required|numeric'
        ]);
    
        // meal_created_at フィールドの値を設定
        $data['meal_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
        
        $data['favorite_menu'] = $data['record_menu'];
        $data['favorite_cal'] = $data['record_cal'];
        $data['favorite_protein'] = $data['record_protein'];
        $data['favorite_fat'] = $data['record_fat'];
        $data['favorite_carbo'] = $data['record_carbo'];
    
        // 特定のIDに対応する食事データを取得し、更新する
        $meal = Meal::where('id', $id)->where('user_id', $user->id)->update($data);
    
        // お気に入り食事画面にリダイレクトする
        return redirect()->route('meal.favoriteshow');
    }
    
    //お気に入り画面から値を取得し、記録
    public function savefavoriteMeal(Request $request)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'favorite_menu' => 'required|string',
            'favorite_cal' => 'required|numeric',
            'favorite_protein' => 'required|numeric',
            'favorite_fat' => 'required|numeric',
            'favorite_carbo' => 'required|numeric'
        ]);
    
        // meal_created_at フィールドの値を設定
        $data['meal_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
        
        $data['record_menu'] = $data['favorite_menu'];
        $data['record_cal'] = $data['favorite_cal'];
        $data['record_protein'] = $data['favorite_protein'];
        $data['record_fat'] = $data['favorite_fat'];
        $data['record_carbo'] = $data['favorite_carbo'];
    
        // Mealモデルの新しいインスタンスを作成し、データを追加して保存
        $meal = Meal::create($data);
    
        // 食事記録画面にリダイレクトする
        return redirect()->route('meal.show');
    }
}
