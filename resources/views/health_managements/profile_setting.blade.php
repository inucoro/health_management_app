<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>プロフィールの設定画面</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f5f5f5;
            }
            .profile {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 8px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .profile_img {
                text-align: center;
                margin-bottom: 20px;
            }
            .profile_img img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
                border: 4px solid #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .profile_info {
                margin-bottom: 20px;
            }
            .profile_info label {
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
                color: #333;
            }
            .profile_info input[type="text"],
            .profile_info input[type="number"],
            .profile_info select {
                width: 100%;
                padding: 8px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 16px;
            }
            .profile_info select {
                width: 100%;
            }
            .profile_info input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .profile_info input[type="submit"]:hover {
                background-color: #45a049;
            }
            h2 {
                color: #333;
                margin-top: 0;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="profile">
            <h2>プロフィール更新</h2>
            <form action="/profile/profile_setting" method="POST">
                @csrf
                @method('PUT')
                <div class="profile_img">
                    <img src="default_profile.jpg" alt="プロフィール写真">
                </div>
                <div class="profile_info">
                    <label for="name">名前</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="profile_info">
                    <label for="sex">性別</label>
                    <select id="sex" name="sex">
                        <option value="male">男性</option>
                        <option value="female">女性</option>
                    </select>
                </div>
                <div class="profile_info">
                    <label for="height">身長(cm)</label>
                    <input type="number" id="height" name="height" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="body_weight">体重(kg)</label>
                    <input type="number" id="body_weight" name="body_weight" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="age">年齢</label>
                    <input type="number" id="age" name="age" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_body_weight">目標体重(kg)</label>
                    <input type="number" id="target_body_weight" name="target_body_weight" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_cal">目標カロリー(kcal)</label>
                    <input type="number" id="target_cal" name="target_cal" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_protein">目標タンパク質(g)</label>
                    <input type="number" id="target_protein" name="target_protein" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_fat">目標脂質(g)</label>
                    <input type="number" id="target_fat" name="target_fat" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_carbo">目標炭水化物(g)</label>
                    <input type="number" id="target_carbo" name="target_carbo" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_movement_consumption_cal">目標運動消費カロリー(kcal)</label>
                    <input type="number" id="target_movement_consumption_cal" name="target_movement_consumption_cal" min="0" required>
                </div>
                <div class="profile_info">
                    <label for="target_sleeping_time">目標睡眠時間(hours)</label>
                    <input type="number" id="target_sleeping_time" name="target_sleeping_time" min="0" required>
                </div>
                <div class="profile_info">
                    <input type="submit" value="更新">
                </div>
                <div class="footer">
                   <a href="/profile">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>
