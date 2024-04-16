<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Health_management;

class Health_management_Controller extends Controller
{
    public function showProfile()
    {
        // モデルを使用してデータを取得
        $user = Health_management::first(); // とりあえず最初のユーザーを取得

        // ビューにデータを渡して表示
        return view('health_managements.profile', ['user' => $user]);
    }
    
    public function updateProfile(Health_management $user)
    {
        return view('health_managements.profile_setting')->with(['user' => $user]);
    }
    
    public function updatedProfile(Request $request, Health_management $user)
    {
        $user = Health_management::first();
        
        // フォームから送信されたデータを受け取る
        $data = $request->only(['name', 'sex', 'height', 'body_weight', 'age', 'target_body_weight', 'target_cal', 'target_protein', 'target_fat', 'target_carbo', 'target_movement_consumption_cal', 'target_sleeping_time']);

        $user->update($data);

        // プロフィール表示ページにリダイレクトする
        return redirect()->route('profile.show');
    }
}