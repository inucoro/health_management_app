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
            .profile-img {
                text-align: center;
                margin-bottom: 20px;
            }
            .profile-img img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
                border: 4px solid #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .profile-info {
                margin-bottom: 20px;
            }
            .profile-info label {
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
                color: #333;
            }
            .profile-info span {
                display: block;
                margin-top: 5px;
                font-size: 16px;
            }
            .profile-buttons {
                text-align: center;
                margin-top: 20px;
            }
            .profile-buttons button {
                padding: 10px 20px;
                margin: 0 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .profile-buttons button:hover {
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
            <div class="profile-img">
                <img id="profile-img" src="default_profile.jpg" alt="プロフィール写真">
            </div>
            <div class="profile-info">
                <label>名前</label>
                <span id="name">John Doe</span>
            </div>
            <div class="profile-info">
                <label>性別</label>
                <span id="sex">男性</span>
            </div>
            <div class="profile-info">
                <label>身長(cm)</label>
                <span id="height">180</span>
            </div>
            <div class="profile-info">
                <label>体重(kg)</label>
                <span id="body_weight">75</span>
            </div>
            <div class="profile-info">
                <label>年齢</label>
                <span id="age">30</span>
            </div>
            <h2>目標設定</h2>
            <div class="profile-info">
                <label>目標体重(kg)</label>
                <span id="target_body_weight">70</span>
            </div>
            <div class="profile-info">
                <label>目標カロリー(kcal)</label>
                <span id="target_cal">2000</span>
            </div>
            <div class="profile-info">
                <label>目標タンパク質(g)</label>
                <span id="target_protein">100</span>
            </div>
            <div class="profile-info">
                <label>目標脂質(g)</label>
                <span id="target_fat">70</span>
            </div>
            <div class="profile-info">
                <label>目標炭水化物(g)</label>
                <span id="target_carbo">200</span>
            </div>
            <div class="profile-info">
                <label>目標運動消費カロリー(kcal)</label>
                <span id="target_movement_consumption_cal">300</span>
            </div>
            <div class="profile-info">
                <label>目標睡眠時間(h)</label>
                <span id="target_sleeping_time">7</span>
            </div>
            <div class="profile-buttons">
                <button onclick="location.href='update_profile.html'">プロフィール設定</button>
                <button onclick="updateProfile()">更新</button>
                <button onclick="location.href='#'">食事記録</button>
                <button onclick="location.href='#'">運動記録</button>
                <button onclick="location.href='#'">体重記録</button>
                <button onclick="location.href='#'">睡眠記録</button>
            </div>
        </div>

        <script>
            function updateProfile() {
                // ここでプロフィール情報を更新する処理を実装します
                // 例えば、入力フォームから値を取得して、それを表示する部分のspan要素の内容を更新します
                var name = document.getElementById("name").value;
                var sex = document.getElementById("sex").value;
                var height = document.getElementById("height").value;
                var body_weight = document.getElementById("body_weight").value;
                var age = document.getElementById("age").value;
    
                // 以下のように、取得した値をそれぞれの要素に反映させます
                document.getElementById("name").textContent = name;
                document.getElementById("sex").textContent = sex;
                document.getElementById("height").textContent = height;
                document.getElementById("body_weight").textContent = body_weight;
                document.getElementById("age").textContent = age;
    
                // 他のプロフィール情報も同様に更新する処理を追加します
    
                // 更新が完了したら、ボタンのクリックに応じて適切なページに移動します
                // ここでは更新後もプロフィール表示画面に留まるよう、何もしないでおきます
            }
        </script>
    </body>
</html>
