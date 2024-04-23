<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>運動お気に入り</title>

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
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>お気に入り</h1>
            <form action="/myprofile/movement/favorite_movement" method="POST">
                @csrf
                <table>
                    <thead>
                        <tr>
                            <th>運動の種目</th>
                            <th>扱った錘の重さ (kg)</th>
                            <th>挙上回数 (Reps)</th>
                            <th>セット数</th>
                            <th>運動時間 (分)</th>
                            <th>運動消費カロリー (kcal)</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favorite_movements as $favorite_movement)
                            <tr>
                                <td>{{ $favorite_movement->favorite_type }}</td>
                                <td>{{ $favorite_movement->favorite_weight }}</td>
                                <td>{{ $favorite_movement->favorite_times }}</td>
                                <td>{{ $favorite_movement->favorite_sets }}</td>
                                <td>{{ $favorite_movement->favorite_movement_times }}</td>
                                <td>{{ $favorite_movement->favorite_movement_consumption_cal }}</td>
                                <td>
                                    <form action="/myprofile/movement/favorite_movement/{{ $favorite_movement->id }}" id="form_{{ $favorite_movement->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteFavoritemovement({{ $favorite_movement->id }})">削除</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('movement.favoritesave') }}" method="POST">
                                        @csrf
                                        <!-- お気に入りメニューの情報を送信 -->
                                        <input type="hidden" name="favorite_type" value="{{ $favorite_movement->favorite_type }}">
                                        <input type="hidden" name="favorite_weight" value="{{ $favorite_movement->favorite_weight }}">
                                        <input type="hidden" name="favorite_times" value="{{ $favorite_movement->favorite_times }}">
                                        <input type="hidden" name="favorite_sets" value="{{ $favorite_movement->favorite_sets }}">
                                        <input type="hidden" name="favorite_movement_times" value="{{ $favorite_movement->favorite_movement_times }}">
                                        <input type="hidden" name="favorite_movement_consumption_cal" value="{{ $favorite_movement->favorite_movement_consumption_cal }}">
                                        <input type="submit" value="記録する">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='paginate'>
                    {{ $favorite_movements->links() }}
                </div>
                <div class="footer">
                    <a href="/myprofile/movement">戻る</a>
                </div>
            </form>
        </div>
        <script>
            function deleteFavoritemovement(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
