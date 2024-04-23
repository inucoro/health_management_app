<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\User;
use App\Models\Favorite_movement;
use Illuminate\Support\Facades\Auth;

class Movement_Controller extends Controller
{
    public function showMovement()
    {
        // モデルを使用してデータを取得
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        $sum_movement_consumption_cal = Movement::where('user_id', $userId)->sum('movement_consumption_cal'); //合計運動消費カロリーの計算
        
        $target_movement_consumption_cal = $user->target_movement_consumption_cal; //目標運動消費カロリーの取得
        
        //運動記録を取得
        $movements = Movement::where('user_id', $userId)->orderBy('movement_created_at', 'desc')->paginate(7); // 7件ごとにページネーション;
        
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
        $user = Auth::user(); // ログインしているユーザーを取得
        
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
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // Movementモデルの新しいインスタンスを作成し、データを追加して保存
        $movement = Movement::create($data);
    
        // 運動記録画面にリダイレクトする
        return redirect()->route('movement.show');
    }
    
    public function editMovement($id)
    {
        // 特定のIDに対応する運動データを取得
        $movement = Movement::findOrFail($id);
    
        // 編集画面にデータを渡して表示
        return view('health_managements.edit_movement', ['movement' => $movement]);
    }
    
    public function updateMovement(Request $request, $id)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_type' => 'required|string',
            'record_weight' => 'required|numeric',
            'record_times' => 'required|numeric',
            'record_sets' => 'required|numeric',
            'record_movement_times' => 'required|string',
            'movement_consumption_cal' => 'required|string'
        ]);
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // 特定のIDに対応する運動データを取得し、更新する
        $movement = Movement::where('id', $id)->where('user_id', $user->id)->update($data);
    
        // 運動表示画面にリダイレクトする
        return redirect()->route('movement.show');
    }
    
    public function deleteMovement($id)
    {
        $movement = Movement::findOrFail($id);
        $movement->delete();
        
        // 運動表示画面にリダイレクトする
        return redirect()->route('movement.show')->with('success', '運動記録が削除されました');
    }
    
    //お気に入り一覧
    public function showfavoriteMovement()
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        //運動記録を取得
        $favorite_movements = Favorite_movement::where('user_id', $userId)->orderBy('favorite_movement_created_at', 'desc')->paginate(7); // 7件ごとにページネーション
        
        return view('health_managements.favorite_movement', ['favorite_movements' => $favorite_movements]);
    }
    
    //お気に入り記録画面
    public function showrecordfavoriteMovement($id)
    {
        // 特定のIDに対応する運動データを取得
        $movement = Movement::findOrFail($id);
    
        // 編集画面にデータを渡して表示
        return view('health_managements.favorite_movement_record', ['movement' => $movement]);
    }
    
    //お気に入り追加
    public function addfavoriteMovement(Request $request, $id)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_type' => 'required|string',
            'record_weight' => 'required|numeric',
            'record_times' => 'required|numeric',
            'record_sets' => 'required|numeric',
            'record_movement_times' => 'required|numeric',
            'movement_consumption_cal' => 'required|numeric',
        ]);
    
        //favorite_ movement_created_at フィールドの値を設定
        $favorite_data['favorite_movement_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $favorite_data['user_id'] = $user->id;
        
        $favorite_data['favorite_type'] = $data['record_type'];
        $favorite_data['favorite_weight'] = $data['record_weight'];
        $favorite_data['favorite_times'] = $data['record_times'];
        $favorite_data['favorite_sets'] = $data['record_sets'];
        $favorite_data['favorite_movement_times'] = $data['record_movement_times'];
        $favorite_data['favorite_movement_consumption_cal'] = $data['movement_consumption_cal'];
    
        // 特定のIDに対応する運動データを取得し、作成する
        $favorite_movements = Favorite_movement::create($favorite_data);
    
        // お気に入り運動画面にリダイレクトする
        return redirect()->route('movement.favoriteshow');
    }
    
    //お気に入り画面から値を取得し、記録
    public function savefavoriteMovement(Request $request)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $favorite_data = $request->validate([
            'favorite_type' => 'required|string',
            'favorite_weight' => 'required|numeric',
            'favorite_times' => 'required|numeric',
            'favorite_sets' => 'required|numeric',
            'favorite_movement_times' => 'required|numeric',
            'favorite_movement_consumption_cal' => 'required|numeric',
        ]);
    
        // movement_created_at フィールドの値を設定
        $data['movement_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
        
        $data['record_type'] = $favorite_data['favorite_type'];
        $data['record_weight'] = $favorite_data['favorite_weight'];
        $data['record_times'] = $favorite_data['favorite_times'];
        $data['record_sets'] = $favorite_data['favorite_sets'];
        $data['record_movement_times'] = $favorite_data['favorite_movement_times'];
        $data['movement_consumption_cal'] = $favorite_data['favorite_movement_consumption_cal'];
        
        // Movementモデルの新しいインスタンスを作成し、データを追加して保存
        $movement = Movement::create($data);
    
        // 運動記録画面にリダイレクトする
        return redirect()->route('movement.show');
    }
    
    //お気に入りの削除
    public function deleteFavoritemovement($id)
    {
        $favorite_movement = Favorite_movement::findOrFail($id);
        $favorite_movement->delete();
        
        // 運動表示画面にリダイレクトする
        return redirect()->route('movement.show')->with('success', 'お気に入りが削除されました');
    }
}
