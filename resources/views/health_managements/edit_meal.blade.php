<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>食事記録編集</title>

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
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 8px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #333;
                margin-top: 0;
                margin-bottom: 20px;
                text-align: center;
            }
            form {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                color: #333;
                font-weight: bold;
            }
            input[type="text"],
            input[type="number"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }
            input[type="submit"] {
                width: 100%;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>食事記録編集</h1>
            <form action="/profile/meal/edit_meal" method="POST">
                @csrf
                @method('PUT')
                <label for="record_menu">メニュー</label>
                <input type="text" id="record_menu" name="record_menu" value="{{ $meal->record_menu }}" required>
                <label for="record_cal">カロリー(kcal)</label>
                <input type="number" id="record_cal" name="record_cal" min="0" value="{{ $meal->record_cal }}" required>
                <label for="record_protein">タンパク質(g)</label>
                <input type="number" id="record_protein" name="record_protein" min="0" value="{{ $meal->record_protein }}" required>
                <label for="record_fat">脂質(g)</label>
                <input type="number" id="record_fat" name="record_fat" min="0" value="{{ $meal->record_fat }}" required>
                <label for="record_carbo">炭水化物(g)</label>
                <input type="number" id="record_carbo" name="record_carbo" min="0" value="{{ $meal->record_carbo }}" required>
                <input type="submit" value="更新する">
                <div class="footer">
                    <a href="/profile/meal">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>
