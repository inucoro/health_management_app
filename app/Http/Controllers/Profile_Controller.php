<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class Profile_Controller extends Controller
{
    public function showProfile()
    {
        // モデルを使用してデータを取得
        $user = Auth::user(); // ログインしているユーザーを取得

        // ビューにデータを渡して表示
        return view('health_managements.profile', ['user' => $user]);
    }
    
    public function updateProfile(Profile $user)
    {
        return view('health_managements.profile_setting')->with(['user' => $user]);
    }
    
    public function updatedProfile(Request $request, Profile $user)
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        
        // フォームから送信されたデータを受け取る
        $data = $request->all();
        
        //cloudinaryへ画像を送信し、画像のURLを$image_pathに代入している
        $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $data['image_path'] = $image_path;
        
        $user->update($data);
    
        // プロフィール表示ページにリダイレクトする
        return redirect()->route('myprofile.show')->with('success', 'プロフィールを更新しました。');
    }
}