<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sleeping;
use App\Models\User;

class Sleeping_Controller extends Controller
{
    public function showSleeping()
    {
        // モデルを使用してデータを取得
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        $userId = $user->id; //最初のユーザーidの取得
        
        $target_sleeping_time = $user->target_sleeping_time; //目標睡眠時間の取得
        
        //睡眠記録を取得
        $sleepings = Sleeping::where('user_id', $userId)->get();
        
        //前回の睡眠時間を取得
        // $previous_sleeping = Sleeping::
        
        // ビューにデータを渡して表示
        return view('health_managements.sleeping', 
        ['user' => $user, 
        'target_sleeping_time' => $target_sleeping_time,
        'sleepings' => $sleepings
        ]);
    }
    
    public function createSleeping()
    {
        return view('health_managements.sleeping_record');
    }
    
    public function storeSleeping(Request $request)
    {
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_sleeping_time' => 'required',
            'record_sleeping_memo' => 'string'
        ]);
    
        // sleeping_created_at フィールドの値を設定
        $data['sleeping_created_at'] = now(); // 現在の日時を使用する
        
        // 最初のユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // Sleepingモデルの新しいインスタンスを作成し、データを追加して保存
        $sleeping = Sleeping::create($data);

        // 睡眠記録画面にリダイレクトする
        return redirect()->route('sleeping.show');
    }
    
    public function editSleeping($id)
    {
        // 特定のIDに対応する睡眠データを取得
        $sleeping = Sleeping::findOrFail($id);
    
        // 編集画面にデータを渡して表示
        return view('health_managements.edit_sleeping', ['sleeping' => $sleeping]);
    }
    
    public function updateSleeping(Request $request)
    {
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_body_weight' => 'required|numeric',
            'record_body_fat' => 'required|numeric',
            'record_body_weight_memo' => 'string'
        ]);
        
        // 最初のユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // 特定のIDに対応する睡眠データを取得し、更新する
        $sleeping = Sleeping::where('id', $id)->where('user_id', $user->id)->update($data);
    
        // 睡眠表示画面にリダイレクトする
        return redirect()->route('sleeping.show');
    }
}
