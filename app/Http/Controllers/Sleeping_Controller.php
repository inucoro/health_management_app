<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sleeping;
use App\Models\User;
use App\Models\Calendar;
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
        
        // 今日の睡眠時間を取得し、時間と分に分割する
        $sleeping_time_parts = explode('時間', str_replace('分', '', $today_sleeping_time));
        $hours = $sleeping_time_parts[0];
        $minutes = $sleeping_time_parts[1];
        // 5時間未満の場合にはtrue、そうでない場合にはfalseを返す
        $is_less_than_5_hours = ($hours < 5 || ($hours == 5 && $minutes < 0));
        
        // ビューにデータを渡して表示
        return view('health_managements.sleeping', [
            'user' => $user, 
            'target_sleeping_time' => $target_sleeping_time,
            'sleepings' => $sleepings,
            'today_sleeping_time' => $today_sleeping_time,
            'previous_record_sleeping_time' => $previous_record_sleeping_time,
            'is_less_than_5_hours' => $is_less_than_5_hours,
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
        
        // 今日の日付で既に睡眠が記録されているかを確認します
        $existingRecord = Sleeping::where('user_id', $user->id)
                                      ->whereDate('sleeping_created_at', now()->toDateString())
                                      ->first();
    
        // 既に今日の日付に記録がある場合は、ユーザーに更新するよう促す
        if ($existingRecord) {
            return redirect()->route('sleeping.edit', ['id' => $existingRecord->id])
                             ->with('info', '今日はすでに睡眠時間を記録しています。今日の睡眠時間を更新しますか？');
        }
        
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
        
        // 今日の睡眠時間をカレンダーテーブルに保存します
        $this->saveSleepingToCalendar($user, $sleepingTime);

        // 睡眠記録画面にリダイレクトする
        return redirect()->route('sleeping.show')->with('success', '睡眠時間を記録しました。');
    }
    
    // 今日の睡眠時間をカレンダーテーブルに保存するメソッド
    private function saveSleepingToCalendar($user, $sleepingTime)
    {
        // カレンダーテーブルから今日の日付のレコードを取得します
        $calendarRecord = Calendar::where('user_id', $user->id)
                                  ->whereDate('date', now()->toDateString())
                                  ->first();
    
        // 今日の日付のレコードが既に存在する場合は、そのレコードを更新します
        if ($calendarRecord) {
            $calendarRecord->record_sleeping_time = $sleepingTime;
            $calendarRecord->save();
        } else {
            // 今日の日付のレコードが存在しない場合は、新しいレコードを作成します
            $calendar = new Calendar();
            $calendar->user_id = $user->id;
            $calendar->date = now()->toDateString(); // 今日の日付を使用します
            $calendar->record_sleeping_time = $sleepingTime;
            $calendar->save();
        }
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
        
        // 特定のIDに対応する睡眠データを取得
        $sleeping = Sleeping::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_wake_up_time' => 'required',
            'record_bedtime' => 'required',
            'record_sleeping_memo' => 'nullable|string'
        ]);
    
        // データが編集されたかどうかを確認
        $wake_up_time_Edited = ($sleeping->record_wake_up_time != $data['record_wake_up_time']);
        
        // データが編集されたかどうかを確認
        $bedtime_Edited = ($sleeping->record_bedtime != $data['record_bedtime']);
    
        // もしデータが編集されていなければH:i:s形式で保存
        $wake_up_time_format = ($wake_up_time_Edited) ? 'H:i' : 'H:i:s';
        
        // もしデータが編集されていなければH:i:s形式で保存
        $bedtime_format = ($bedtime_Edited) ? 'H:i' : 'H:i:s';
    
        // 睡眠時間の計算
        $wakeUpTime = \Carbon\Carbon::createFromFormat($wake_up_time_format, $data['record_wake_up_time']);
        $bedtime = \Carbon\Carbon::createFromFormat($bedtime_format, $data['record_bedtime']);
        $sleepingTime = $this->calculateSleepingTime($bedtime, $wakeUpTime); // 睡眠時間の計算
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
        
        // 睡眠時間をデータに追加
        $data['record_sleeping_time'] = $sleepingTime;
        
        // 特定のIDに対応する睡眠データを取得し、更新する
        $sleeping = Sleeping::where('id', $id)->where('user_id', $user->id)->update($data);
    
        // 睡眠表示画面にリダイレクトする
        return redirect()->route('sleeping.show')->with('success', '睡眠時間の記録を更新しました。');
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
    
     //グラフ画面の表示
    public function showSleepingchart()
    {
        return view('health_managements.sleeping_chart');
    }
    
    //目標睡眠を取得
    public function getTargetSleeping()
    {
        $user = Auth::user();
        return response()->json($user->target_sleeping_time);
    }
        
    //睡眠の履歴を取得
    public function getSleepingChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $sleepings = Sleeping::select('sleeping_created_at', 'record_sleeping_time')
                     ->where('user_id', $userId)
                     ->orderBy('sleeping_created_at')
                     ->get();
                     
        foreach ($sleepings as $sleeping) {
            // 分から時間に変換
            $sleeping['record_sleeping_time'] = $sleeping['record_sleeping_time'] / 60; // 時間単位に変換
        }
        
        return response()->json($sleepings);
    }
}