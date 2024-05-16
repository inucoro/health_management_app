<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Daily_record;
use App\Models\Body_weight;
use App\Models\Sleeping;
use App\Models\Calendar;
use Carbon\Carbon;

class Calendar_Controller extends Controller
{
    // カレンダーに運動した日にスタンプを表示、クリックされた日の記録を出力
    public function show_calendar(Request $request)
    {
        // ログインしているユーザーを取得
        $user = Auth::user();
        $userId = $user->id;
    
        if ($request->ajax() && $request->has('clickedDate')) {
            $clickedDate = $request->input('clickedDate');
            $calendarRecord = Calendar::where('user_id', $userId)
                                       ->where('date', $clickedDate)
                                       ->first();
            return response()->json($calendarRecord);
        }
    
        // 今日のデイリーレコードを取得
        $today = Carbon::today();
        $todaycalendarRecord = Calendar::where('user_id', $userId)
                                    ->where('date', $today)
                                    ->first();
                                    
        // 現在の年と月を取得    
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // 全年、全月に関しての運動記録の日付の配列を取得
        $recordedDates = Movement::where('user_id', $userId)
                                 ->pluck('movement_created_at')
                                 ->map(function ($date) {
                                     return Carbon::parse($date)->format('Y-m-d');
                                 })
                                 ->toArray();
                                 
        // Bladeテンプレートを返す
        return view('health_managements.calendar', [
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
            'recordedDates' => $recordedDates,
            'todaycalendarRecord' => $todaycalendarRecord, 
        ]);
    }
    
    public function saveMemo(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
    
        $date = $request->input('date');
        $memo = $request->input('memo');
    
        // カレンダーテーブルにレコードが存在するかチェック
        $calendarRecord = Calendar::where('user_id', $userId)
                                   ->where('date', $date)
                                   ->first();
    
        if ($calendarRecord) {
            // レコードが存在する場合は更新
            $calendarRecord->record_calendar_memo = $memo;
            $calendarRecord->save();
        } else {
            // レコードが存在しない場合は新規作成
            Calendar::create([
                'user_id' => $userId,
                'date' => $date,
                'record_calendar_memo' => $memo,
            ]);
        }
    
        return response()->json(['message' => 'メモが保存されました。']);
    }
}
    

