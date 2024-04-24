<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>体重記録編集</title>

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
            textarea {
                width: 100%;
                height: 100px;
                padding: 10px;
                margin: 5px 0 20px 0;
                border-radius: 5px;
                border: 1px solid #ccc;
                box-sizing: border-box;
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
            <h1>体重記録編集</h1>
            <form action="{{ route('body_weight.update', ['id' => $body_weight->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="record_body_weight">体重 (kg):</label>
                <input type="number" step="0.1" id="record_body_weight" name="record_body_weight" value="{{ $body_weight->record_body_weight }}" required>
                
                <label for="record_body_fat">体脂肪率 (%):</label>
                <input type="number" step="0.1" id="record_body_fat" name="record_body_fat" value="{{ $body_weight->record_body_fat }}" required>
                
                <label for="record_body_weight_memo">メモ:</label>
                <textarea id="record_body_weight_memo" name="record_body_weight_memo" placeholder="メモを入力してください">{{ old('record_body_weight_memo', $body_weight->record_body_weight_memo) }}</textarea>
                
                <input type="submit" value="更新する">
                @if (session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                @endif
                <div class="footer">
                    <a href="/myprofile/body_weight">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>
