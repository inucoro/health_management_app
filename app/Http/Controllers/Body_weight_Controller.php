<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Body_weight;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Body_weight_Controller extends Controller
{
    public function showBody_weight()
    {
        // モデルを使用してデータを取得
        $user = Auth::user(); // ログインしているユーザーを取得
        
        $userId = $user->id; //ログインユーザーidの取得
        
        $target_body_weight = $user->target_body_weight; //目標体重の取得
        
        // 最新の体重記録を取得
        $latest_body_weight_record = Body_weight::where('user_id', $userId)
                                          ->orderByDesc('body_weight_created_at')
                                          ->first();
        
        $latest_body_weight = $latest_body_weight_record ? $latest_body_weight_record->record_body_weight : null;
        
        // 最新の体重記録以外を取得
        $previous_body_weight = null;
        $previous_record_body_weight = null;
        
        if ($latest_body_weight_record) {
            $previous_body_weight = Body_weight::where('user_id', $userId)
                                                ->where('id', '<>', $latest_body_weight_record->id)
                                                ->orderByDesc('body_weight_created_at')
                                                ->first();
            
            $previous_record_body_weight = $previous_body_weight ? $previous_body_weight->record_body_weight : null;
        }
        
        $weight_up_to_target = $target_body_weight - $latest_body_weight; //目標体重までの計算
        
        // 最新の体重記録を含むすべての体重記録を取得
        $body_weights = Body_weight::where('user_id', $userId)->orderBy('body_weight_created_at', 'desc')->paginate(7); // 7件ごとにページネーション
        
        // ビューにデータを渡して表示
        return view('health_managements.body_weight', [
            'user' => $user, 
            'target_body_weight' => $target_body_weight,
            'latest_body_weight' => $latest_body_weight,
            'body_weights' => $body_weights,
            'previous_body_weight' => $previous_body_weight,
            'previous_record_body_weight' => $previous_record_body_weight,
            'weight_up_to_target' => $weight_up_to_target,
        ]);
    }

    
    public function createBody_weight()
    {
        return view('health_managements.body_weight_record');
    }
    
    public function storeBody_weight(Request $request)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // 今日の日付で既に体重が記録されているかを確認します
        $existingRecord = Body_weight::where('user_id', $user->id)
                                      ->whereDate('body_weight_created_at', now()->toDateString())
                                      ->first();
    
        // 既に今日の日付に記録がある場合は、ユーザーに更新するよう促す
        if ($existingRecord) {
            return redirect()->route('body_weight.edit', ['id' => $existingRecord->id])
                             ->with('info', '今日はすでに体重を記録しています。今日の体重を更新しますか？');
        }
    
        // 今日の日付に記録がない場合は、体重を記録
        $data = $request->validate([
            'record_body_weight' => 'required|numeric',
            'record_body_fat' => 'required|numeric',
            'record_body_weight_memo' => 'nullable|string'
        ]);
    
        // body_weight_created_at フィールドの値を設定
        $data['body_weight_created_at'] = now(); // 現在の日時を使用する
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // Body_weightモデルの新しいインスタンスを作成し、データを追加して保存
        $body_weight = Body_weight::create($data);
    
        // 体重記録画面にリダイレクトする
        return redirect()->route('body_weight.show')->with('success', '体重を記録しました。');
    }
    
    public function editBody_weight($id)
    {
        // 特定のIDに対応する体重データを取得
        $body_weight = Body_weight::findOrFail($id);
    
        // 編集画面にデータを渡して表示
        return view('health_managements.edit_body_weight', ['body_weight' => $body_weight]);
    }
    
    public function updateBody_weight(Request $request, $id)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_body_weight' => 'required|numeric',
            'record_body_fat' => 'required|numeric',
            'record_body_weight_memo' => 'nullable|string'
        ]);
        
        // ログインユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // 特定のIDに対応する体重データを取得し、更新する
        $body_weight = Body_weight::where('id', $id)->where('user_id', $user->id)->update($data);
        
        // 体重表示画面にリダイレクトする
        return redirect()->route('body_weight.show')->with('success', '体重の記録を更新しました。');
    }
    
    public function deleteBody_weight($id)
    {
        $body_weight = Body_weight::findOrFail($id);
        $body_weight->delete();
        
        // 体重表示画面にリダイレクトする
        return redirect()->route('body_weight.show')->with('success', '体重記録が削除されました');
    }
    
    //グラフ画面の表示
    public function showBody_weightchart()
    {
        return view('health_managements.body_weight_chart');
    }
    
    //目標体重を取得
    public function getTargetBody_weight()
    {
        $user = Auth::user();
        return response()->json($user->target_body_weight);
    }
        
    //体重の履歴を取得
    public function getBody_WeightChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $body_weights = Body_weight::select('body_weight_created_at', 'record_body_weight')
                     ->where('user_id', $userId)
                     ->orderBy('body_weight_created_at')
                     ->get();
    
        return response()->json($body_weights);
    }
    
    //体脂肪の履歴を取得
    public function getBody_FatChartData()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $body_weights = Body_weight::select('body_weight_created_at', 'record_body_fat')
                     ->where('user_id', $userId)
                     ->orderBy('body_weight_created_at')
                     ->get();
    
        return response()->json($body_weights);
    }
}
