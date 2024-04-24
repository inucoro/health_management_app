<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\User;
use App\Models\Movement;
use App\Models\Daily_record;
use Carbon\Carbon;
use App\Models\Favorite_meal;
use Illuminate\Support\Facades\Auth;

class Meal_Controller extends Controller
{
    public function showMeal()
    {
        // モデルを使用してデータを取得
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        $today = Carbon::today();
        
        // 今日のデイリーレコードを取得
        $dailyRecord = Daily_record::where('user_id', $userId)
                                    ->where('date', $today)
                                    ->first();
                                    
        // デイリーレコードが存在しない場合は作成する
        if (!$dailyRecord) {
            $this->calculate(); // calculateメソッドを呼び出してデイリーレコードを作成
            $dailyRecord = Daily_record::where('user_id', $userId)
                                        ->where('date', $today)
                                        ->first();
        }
            
        $sum_movement_consumption_cal = $dailyRecord->sum_movement_consumption_cal; //一日の合計運動消費カロリーの取得
        
        //カロリー
        $ingestion_cal = $dailyRecord->ingestion_cal; // 一日の合計摂取カロリーを取得
        
        $target_cal = $user->target_cal; //目標カロリーの取得
        
        $remaining_ingestion_cal = $target_cal - $ingestion_cal; //残り摂取カロリーの計算
        
        //タンパク質
        $sum_ingested_protein = $dailyRecord->sum_ingested_protein; //一日の摂取タンパク質の取得
        
        $target_protein = $user->target_protein; //目標タンパク質の取得
        
        $remaining_ingestion_protein = $target_protein - $sum_ingested_protein; //残りタンパク質の計算
        
        //脂質
        $sum_ingested_fat = $dailyRecord->sum_ingested_fat; //一日の摂取脂質の取得
        
        $target_fat = $user->target_fat; //目標脂質の取得
        
        $remaining_ingestion_fat = $target_fat - $sum_ingested_fat; //残り脂質の計算
        
        //炭水化物
        $sum_ingested_carbo = $dailyRecord->sum_ingested_carbo; //一日の摂取炭水化物の取得
        
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
    
    
    public function calculate()
    {
        $users = User::all();
        $today = Carbon::today();
    
        foreach ($users as $user) {
            $userId = $user->id;
    
            // 合計摂取カロリーの計算
            $ingestion_cal = Meal::where('user_id', $userId)->whereDate('meal_created_at', $today)->sum('record_cal');
    
            // 合計運動消費カロリーの計算
            $sum_movement_consumption_cal = Movement::where('user_id', $userId)->whereDate('movement_created_at', $today)->sum('movement_consumption_cal');
    
            // 合計タンパク質の計算
            $sum_ingested_protein =  Meal::where('user_id', $userId)->whereDate('meal_created_at', $today)->sum('record_protein');
    
            // 合計脂質の計算
            $sum_ingested_fat =  Meal::where('user_id', $userId)->whereDate('meal_created_at', $today)->sum('record_fat');
    
            // 合計炭水化物の計算
            $sum_ingested_carbo =  Meal::where('user_id', $userId)->whereDate('meal_created_at', $today)->sum('record_carbo');
    
            // Daily_record を作成または更新する
            Daily_record::updateOrCreate([
                'user_id' => $userId,
                'date' => $today,
            ], [
                'ingestion_cal' => $ingestion_cal,
                'movement_consumption_cal' => $sum_movement_consumption_cal,
                'sum_ingested_protein' => $sum_ingested_protein,
                'sum_ingested_fat' => $sum_ingested_fat,
                'sum_ingested_carbo' => $sum_ingested_carbo,
            ]);
        }
    }
    
    public function createMeal()
    {
        $this->calculate(); // calculateメソッドを呼び出してデイリーレコードを作成
        
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
        
        // calculateメソッドを再度呼び出して、新しいデータを含む合計値を更新する
        $this->calculate();
    
        // 食事記録画面にリダイレクトする
        return redirect()->route('meal.show')->with('success', '食事を記録しました。');
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
        
        // calculateメソッドを再度呼び出して、新しいデータを含む合計値を更新する
        $this->calculate();
    
        // 食事表示画面にリダイレクトする
        return redirect()->route('meal.show')->with('success', '食事の記録を更新しました。');
    }
    
    public function deleteMeal($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();
        
        // calculateメソッドを再度呼び出して、新しいデータを含む合計値を更新する
        $this->calculate();
        
        // 食事表示画面にリダイレクトする
        return redirect()->route('meal.show')->with('success', '食事記録が削除されました');
    }
    
    
    //お気に入り一覧
    public function showfavoriteMeal()
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        //食事記録を取得
        $favorite_meals = Favorite_meal::where('user_id', $userId)->orderBy('favorite_meal_created_at', 'desc')->paginate(7); // 7件ごとにページネーション
        
        return view('health_managements.favorite_meal', ['favorite_meals' => $favorite_meals]);
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
    
        // favorite_meal_created_at フィールドの値を設定
        $favorite_data['favorite_meal_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $favorite_data['user_id'] = $user->id;
        $favorite_data['favorite_menu'] = $data['record_menu'];
        $favorite_data['favorite_cal'] = $data['record_cal'];
        $favorite_data['favorite_protein'] = $data['record_protein'];
        $favorite_data['favorite_fat'] = $data['record_fat'];
        $favorite_data['favorite_carbo'] = $data['record_carbo'];
    
        // 特定のIDに対応する食事データを取得し、作成する
        $favorite_meals = Favorite_meal::create($favorite_data);
    
        // お気に入り食事画面にリダイレクトする
        return redirect()->route('meal.favoriteshow')->with('success', 'お気に入りに追加しました。');
    }
    
    //お気に入り画面から値を取得し、記録
    public function savefavoriteMeal(Request $request)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $favorite_data = $request->validate([
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
        
        $data['record_menu'] = $favorite_data['favorite_menu'];
        $data['record_cal'] = $favorite_data['favorite_cal'];
        $data['record_protein'] = $favorite_data['favorite_protein'];
        $data['record_fat'] = $favorite_data['favorite_fat'];
        $data['record_carbo'] = $favorite_data['favorite_carbo'];
    
        // Mealモデルの新しいインスタンスを作成し、データを追加して保存
        $meal = Meal::create($data);
        
        // calculateメソッドを再度呼び出して、新しいデータを含む合計値を更新する
        $this->calculate();
    
        // 食事記録画面にリダイレクトする
        return redirect()->route('meal.show');
    }
    
    //お気に入りの削除
    public function deleteFavoritemeal($id)
    {
        $favorite_meal = Favorite_meal::findOrFail($id);
        $favorite_meal->delete();
        
        // 食事表示画面にリダイレクトする
        return redirect()->route('meal.show')->with('success', 'お気に入りが削除されました');
    }
    
    //グラフ画面の表示
    public function showMealchart()
    {
        return view('health_managements.meal_chart');
    }
    
    //目標カロリーを取得
    public function getTargetCalories()
    {
        $user = Auth::user();
        return response()->json($user->target_cal);
    }
        
    //食事カロリーの履歴を取得
    public function getMealCalorieChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $meals = Daily_record::select('created_at', 'ingestion_cal')
                     ->where('user_id', $userId)
                     ->orderBy('created_at')
                     ->get();
    
        return response()->json($meals);
    }
    
    //タンパク質の履歴を取得
    public function getProteinChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $meals = Daily_record::select('created_at', 'sum_ingested_protein')
                     ->where('user_id', $userId)
                     ->orderBy('created_at')
                     ->get();
    
        return response()->json($meals);
    }
    
    //目標タンパク質を取得
    public function getTargetProtein()
    {
        $user = Auth::user();
        return response()->json($user->target_protein);
    }
    
    //脂質の履歴を取得
    public function getFatChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $meals = Daily_record::select('created_at', 'sum_ingested_fat')
                     ->where('user_id', $userId)
                     ->orderBy('created_at')
                     ->get();
    
        return response()->json($meals);
    }
    
    //目標脂質を取得
    public function getTargetFat()
    {
        $user = Auth::user();
        return response()->json($user->target_fat);
    }
    
    //炭水化物の履歴を取得
    public function getCarboChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $meals = Daily_record::select('created_at', 'sum_ingested_carbo')
                     ->where('user_id', $userId)
                     ->orderBy('created_at')
                     ->get();
    
        return response()->json($meals);
    }
    
    //目標炭水化物を取得
    public function getTargetCarbo()
    {
        $user = Auth::user();
        return response()->json($user->target_carbo);
    }
}
