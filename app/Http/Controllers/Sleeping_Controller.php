<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sleeping;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Sleeping_Controller extends Controller
{
    public function showSleeping()
    {
        // モデルを使用してデータを取得
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        $target_sleeping_time = $user->target_sleeping_time; //目標睡眠時間の取得
        
        // 最新の睡眠記録を取得
        $sleepings = Sleeping::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(7); // 7件ごとにページネーション
        
        // 直近の睡眠記録を取得
        $latest_sleeping_records = Sleeping::where('user_id', $userId)->orderBy('created_at', 'desc')->take(2)->get(); // 直近の2つの記録を取得

        // 直近の一つ前の睡眠記録を取得
        $previous_sleeping_record = $latest_sleeping_records->count() > 1 ? $latest_sleeping_records[1] : null;

        // 直近の一つ前の睡眠時間をフォーマット
        $previous_record_sleeping_time = $previous_sleeping_record ? $this->formatSleepingTime($previous_sleeping_record->record_sleeping_time) : '睡眠時間が記録されていません';
        
        // 今回の睡眠時間を計算
        $today_sleeping_time = $this->calculateTodaySleepingTime();
        
        // ビューにデータを渡して表示
        return view('health_managements.sleeping', [
            'user' => $user, 
            'target_sleeping_time' => $target_sleeping_time,
            'sleepings' => $sleepings,
            'today_sleeping_time' => $today_sleeping_time,
            'previous_record_sleeping_time' => $previous_record_sleeping_time,
        ]);
    }
    
    // 睡眠時間をフォーマットするメソッド
    private function formatSleepingTime($minutes)
    {
        $hours = floor($minutes / 60); // 時間の整数部分
        $minutes = $minutes % 60; // 残りの分
        
        return $hours . '時間' . $minutes . '分';
    }

    
    public function createSleeping()
    {
        return view('health_managements.sleeping_record');
    }
    
    public function storeSleeping(Request $request)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_wake_up_time' => 'required',
            'record_bedtime' => 'required',
            'record_sleeping_memo' => 'nullable|string'
        ]);
    
        // 睡眠時間の計算
        $wakeUpTime = \Carbon\Carbon::createFromFormat('H:i', $data['record_wake_up_time']);
        $bedtime = \Carbon\Carbon::createFromFormat('H:i', $data['record_bedtime']);
        $sleepingTime = $this->calculateSleepingTime($bedtime, $wakeUpTime); // 睡眠時間の計算
    
        // sleeping_created_at フィールドの値を設定
        $data['sleeping_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
        
        // 睡眠時間をデータに追加
        $data['record_sleeping_time'] = $sleepingTime;
    
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
    
    public function updateSleeping(Request $request, $id)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_wake_up_time' => 'required',
            'record_bedtime' => 'required',
            'record_sleeping_memo' => 'nullable|string'
        ]);
        
        // 睡眠時間の計算
        $wakeUpTime = \Carbon\Carbon::createFromFormat('H:i', $data['record_wake_up_time']);
        $bedtime = \Carbon\Carbon::createFromFormat('H:i', $data['record_bedtime']);
        $sleepingTime = $this->calculateSleepingTime($bedtime, $wakeUpTime); // 睡眠時間の計算
        
         // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
        
        // 睡眠時間をデータに追加
        $data['record_sleeping_time'] = $sleepingTime;
        
        // 特定のIDに対応する睡眠データを取得し、更新する
        $sleeping = Sleeping::where('id', $id)->where('user_id', $user->id)->update($data);
    
        // 睡眠表示画面にリダイレクトする
        return redirect()->route('sleeping.show');
    }
    
    public function deleteSleeping($id)
    {
        $sleeping = Sleeping::findOrFail($id);
        $sleeping->delete();
        
        // 睡眠表示画面にリダイレクトする
        return redirect()->route('sleeping.show')->with('success', '睡眠記録が削除されました');
    }
    
    // 起床時間と就寝時間から睡眠時間を計算するメソッド
    private function calculateSleepingTime($bedtime, $wakeUpTime)
    {
        // 起床時間が就寝時間より前の場合（翌日起床の場合）
        if ($wakeUpTime->lessThan($bedtime)) {
            // 起床時間に24時間を足してから就寝時間との差分を計算
            $sleepingTime = $wakeUpTime->addHours(24)->diffInMinutes($bedtime);
        } else {
            // それ以外の場合は通常の差分を計算
            $sleepingTime = $bedtime->diffInMinutes($wakeUpTime);
        }

        return $sleepingTime;
    }
    
    // 今回の睡眠時間を計算するメソッド
    private function calculateTodaySleepingTime()
    {
        $user = User::first(); // 最初のユーザーを取得
        $lastSleepingRecord = Sleeping::where('user_id', $user->id)->latest()->first();
    
        if ($lastSleepingRecord && $lastSleepingRecord->created_at->isToday()) {
            return $this->formatSleepingTime($lastSleepingRecord->record_sleeping_time);
        }

        return '睡眠時間が記録されていません';
    }
}