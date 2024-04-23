<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>食事お気に入り</title>

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
            <form action="/myprofile/meal/favorite_meal" method="POST">
                @csrf
                <table>
                    <thead>
                        <tr>
                            <th>メニュー</th>
                            <th>カロリー(kcal)</th>
                            <th>タンパク質(g)</th>
                            <th>脂質(g)</th>
                            <th>炭水化物(g)</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favorite_meals as $favorite_meal)
                            <tr>
                                <td>{{ $favorite_meal->favorite_menu }}</td>
                                <td>{{ $favorite_meal->favorite_cal }}</td>
                                <td>{{ $favorite_meal->favorite_protein }}</td>
                                <td>{{ $favorite_meal->favorite_fat }}</td>
                                <td>{{ $favorite_meal->favorite_carbo }}</td>
                                <td>
                                    <form action="/myprofile/meal/favorite_meal/{{ $favorite_meal->id }}" id="form_{{ $favorite_meal->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteFavoritemeal({{ $favorite_meal->id }})">削除</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('meal.favoritesave') }}" method="POST">
                                        @csrf
                                        <!-- お気に入りメニューの情報を送信 -->
                                        <input type="hidden" name="favorite_menu" value="{{ $favorite_meal->favorite_menu }}">
                                        <input type="hidden" name="favorite_cal" value="{{ $favorite_meal->favorite_cal }}">
                                        <input type="hidden" name="favorite_protein" value="{{ $favorite_meal->favorite_protein }}">
                                        <input type="hidden" name="favorite_fat" value="{{ $favorite_meal->favorite_fat }}">
                                        <input type="hidden" name="favorite_carbo" value="{{ $favorite_meal->favorite_carbo }}">
                                        <input type="submit" value="記録する">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='paginate'>
                    {{ $favorite_meals->links() }}
                </div>
                <div class="footer">
                    <a href="/myprofile/meal">戻る</a>
                </div>
            </form>
        </div>
        <script>
            function deleteFavoritemeal(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
