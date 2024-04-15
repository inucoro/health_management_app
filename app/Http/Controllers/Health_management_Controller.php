<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Health_management;

class Health_management_Controller extends Controller
{
     public function showProfile()
    {
        // モデルを使用してデータを取得
        $user = Health_management::first(); // とりあえず最初のユーザーを取得する例です

        // ビューにデータを渡して表示
        return view('health_managements.profile', ['user' => $user]);
    }
}