<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>プロフィール画面</title>

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
            .profile_info span {
                display: block;
                margin-top: 5px;
                font-size: 16px;
            }
            .profile_buttons {
                text-align: center;
                margin-top: 20px;
            }
            .profile_buttons button {
                padding: 10px 20px;
                margin: 0 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .profile_buttons button:hover {
                background-color: #ddd;
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
            <h2>プロフィール表示</h2>
            <div class="profile_buttons">
                <button onclick="location.href='/profile/meal'">食事</button>
                <button onclick="location.href='/profile/movement'">運動</button>
                <button onclick="location.href='/profile/body_weight'">体重</button>
                <button onclick="location.href='/profile/sleeping'">睡眠</button>
            </div>
            <div class="profile_img">
                <img id="profile_img" src="{{ asset('image/IMG_3252.JPG') }}" alt="プロフィール写真">
            </div>
            <div class="profile_info">
                <label>名前</label>
                <span id="name">{{ $user->name }}</span>
            </div>
            <div class="profile_info">
                <label>性別</label>
                <span id="sex">{{ $user->sex }}</span>
            </div>
            <div class="profile_info">
                <label>身長(cm)</label>
                <span id="height">{{ $user->height }}</span>
            </div>
            <div class="profile_info">
                <label>体重(kg)</label>
                <span id="body_weight">{{ $user->body_weight }}</span>
            </div>
            <div class="profile_info">
                <label>年齢</label>
                <span id="age">{{ $user->age }}</span>
            </div>
            <h2>目標設定</h2>
            <div class="profile_info">
                <label>目標体重(kg)</label>
                <span id="target_body_weight">{{ $user->target_body_weight }}</span>
            </div>
            <div class="profile_info">
                <label>目標カロリー(kcal)</label>
                <span id="target_cal">{{ $user->target_cal }}</span>
            </div>
            <div class="profile_info">
                <label>目標タンパク質(g)</label>
                <span id="target_protein">{{ $user->target_protein }}</span>
            </div>
            <div class="profile_info">
                <label>目標脂質(g)</label>
                <span id="target_fat">{{ $user->target_fat }}</span>
            </div>
            <div class="profile_info">
                <label>目標炭水化物(g)</label>
                <span id="target_carbo">{{ $user->target_carbo }}</span>
            </div>
            <div class="profile_info">
                <label>目標運動消費カロリー(kcal)</label>
                <span id="target_movement_consumption_cal">{{ $user->target_movement_consumption_cal }}</span>
            </div>
            <div class="profile_info">
                <label>目標睡眠時間(h)</label>
                <span id="target_sleeping_time">{{ $user->target_sleeping_time }}</span>
            </div>
            <div class="profile_buttons">
                <button onclick="location.href='/profile/profile_setting'">プロフィール設定</button>
                <button onclick="location.href='/profile/calender'">カレンダー</button><br /><br />
                <button onclick="location.href='/profile/meal/meal_record'">食事記録</button>
                <button onclick="location.href='/profile/movement/movement_record'">運動記録</button>
                <button onclick="location.href='/profile/body_weight/body_weight_record'">体重記録</button>
                <button onclick="location.href='/profile/sleeping/sleeping_record'">睡眠記録</button>
            </div>
        </div>
    </body>
</html>
