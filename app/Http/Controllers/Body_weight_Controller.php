<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Body_weight;
use App\Models\User;

class Body_weight_Controller extends Controller
{
    public function showBody_weight()
    {
        // モデルを使用してデータを取得
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        $userId = $user->id; //最初のユーザーidの取得
        
        $target_body_weight = $user->target_body_weight; //目標体重の取得
        
        // 最新の体重記録を取得
        $body_weights = Body_weight::where('user_id', $userId)->orderBy('body_weight_created_at', 'desc')->paginate(7); // 7件ごとにページネーション
        
        // 最新の体重記録以外を取得
        $previous_body_weight = $body_weights->slice(1)->first();
        $previous_record_body_weight = $previous_body_weight->record_body_weight;
        
        // ビューにデータを渡して表示
        return view('health_managements.body_weight', [
            'user' => $user, 
            'target_body_weight' => $target_body_weight,
            'body_weights' => $body_weights,
            'previous_body_weight' => $previous_body_weight,
            'previous_record_body_weight' => $previous_record_body_weight
        ]);
    }
    
    public function createBody_weight()
    {
        return view('health_managements.body_weight_record');
    }
    
    public function storeBody_weight(Request $request)
    {
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_body_weight' => 'required|numeric',
            'record_body_fat' => 'required|numeric',
            'record_body_weight_memo' => 'nullable|string'
        ]);
    
        // body_weight_created_at フィールドの値を設定
        $data['body_weight_created_at'] = now(); // 現在の日時を使用する
        
        // 最初のユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // Body_weightモデルの新しいインスタンスを作成し、データを追加して保存
        $body_weight = Body_weight::create($data);
    
        // 体重記録画面にリダイレクトする
        return redirect()->route('body_weight.show');
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
        $user = User::first(); // とりあえず最初のユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->validate([
            'record_body_weight' => 'required|numeric',
            'record_body_fat' => 'required|numeric',
            'record_body_weight_memo' => 'nullable|string'
        ]);
        
        // 最初のユーザーのIDをデータに追加
        $data['user_id'] = $user->id;
    
        // 特定のIDに対応する体重データを取得し、更新する
        $body_weight = Body_weight::where('id', $id)->where('user_id', $user->id)->update($data);
        
        // 体重表示画面にリダイレクトする
        return redirect()->route('body_weight.show');
    }
    
    public function deleteBody_weight($id)
    {
        $body_weight = Body_weight::findOrFail($id);
        $body_weight->delete();
        
        // 体重表示画面にリダイレクトする
        return redirect()->route('body_weight.show')->with('success', '体重記録が削除されました');
    }
}
