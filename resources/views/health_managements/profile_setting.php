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
            .profile-info input[type="text"],
            .profile-info input[type="number"],
            .profile-info select {
                width: 100%;
                padding: 8px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 16px;
            }
            .profile-info select {
                width: 100%;
            }
            .profile-info input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .profile-info input[type="submit"]:hover {
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
            <form action="update_profile.php" method="post">
                <div class="profile-img">
                    <img src="default_profile.jpg" alt="プロフィール写真">
                </div>
                <div class="profile-info">
                    <label for="name">名前</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="profile-info">
                    <label for="gender">性別</label>
                    <select id="gender" name="gender">
                        <option value="male">男性</option>
                        <option value="female">女性</option>
                    </select>
                </div>
                <div class="profile-info">
                    <label for="height">身長(cm)</label>
                    <input type="number" id="height" name="height" min="0" required>
                </div>
                <div class="profile-info">
                    <label for="weight">体重(kg)</label>
                    <input type="number" id="weight" name="weight" min="0" required>
                </div>
                <div class="profile-info">
                    <label for="age">年齢</label>
                    <input type="number" id="age" name="age" min="0" required>
                </div>
                <div class="profile-info">
                    <input type="submit" value="更新">
                </div>
            </form>
        </div>
    </body>
</html>
