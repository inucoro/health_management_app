<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>食事</title>

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
                max-width: 800px;
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
            .summary {
                margin-bottom: 20px;
            }
            .summary_item {
                margin-top: 10px;
                display: flex;
                justify-content: space-between;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 4px;
            }
            .summary_item label {
                font-weight: bold;
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
            <h1>食事</h1>
            
            <div class="summary">
                <div class="summary_item">
                    <label>合計摂取カロリー:</label>
                    <span id="ingestion_cal">{{ $ingestion_cal }} kcal</span>
                </div>
                <div class="summary_item">
                    <label>合計運動消費カロリー:</label>
                    <span id="sum_movement_consumption_cal">{{ $sum_movement_consumption_cal }} kcal</span>
                </div>
                <div class="summary_item">
                    <label>目標カロリー:</label>
                    <span id="target_cal">{{ $user->target_cal }} kcal</span>
                </div>
                <div class="summary_item">
                    <label>残り摂取カロリー:</label>
                    <span id="remaining_ingestion_cal">{{ $remaining_ingestion_cal }} kcal</span>
                </div>
                <div class="summary_item">
                    <div style="display: flex; flex-direction: column;">
                        <label>目標タンパク質:</label>
                        <div>
                            <span id="sum_ingested_protein">{{ $sum_ingested_protein }}g(摂取)</span>
                            <span id="target_protein">/ {{ $target_protein }}g(目標)</span>
                            <span id="remaining_ingestion_protein">残り摂取：{{ $remaining_ingestion_protein }}g</span>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <label>目標脂質:</label>
                        <div>
                            <span id="sum_ingested_fat">{{ $sum_ingested_fat }}g(摂取)</span>
                            <span id="target_fat">/ {{ $target_fat }}g(目標)</span>
                            <span id="remaining_ingestion_fat">残り摂取：{{ $remaining_ingestion_fat }}g</span>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <label>目標炭水化物:</label>
                        <div>
                            <span id="sum_ingested_carbo">{{ $sum_ingested_carbo }}g(摂取)</span>
                            <span id="target_carbo">/ {{ $target_carbo }}g(目標)</span>
                            <span id="remaining_ingestion_carbo">残り摂取：{{ $remaining_ingestion_carbo }}g</span>
                        </div>
                    </div>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>メニュー</th>
                        <th>カロリー(kcal)</th>
                        <th>タンパク質(g)</th>
                        <th>脂質(g)</th>
                        <th>炭水化物(g)</th>
                        <th>日時</th>
                        <th></th>
                        <th></th>
                        <th>お気に入り</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meals as $meal)
                        <tr>
                            <td>{{ $meal->record_menu }}</td>
                            <td>{{ $meal->record_cal }}</td>
                            <td>{{ $meal->record_protein }}</td>
                            <td>{{ $meal->record_fat }}</td>
                            <td>{{ $meal->record_carbo }}</td>
                            <td>{{ $meal->meal_created_at }}</td>
                            <td><a href='/myprofile/meal/edit_meal/{{ $meal->id }}'>編集</a></td>
                            <td>
                                <form action="/myprofile/meal/{{ $meal->id }}" id="form_{{ $meal->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteMeal({{ $meal->id }})">削除</button>
                                </form>
                            </td>
                            <td><a href='/myprofile/meal/favorite_meal_record/{{ $meal->id }}'>追加</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class='paginate'>
                {{ $meals->links() }}
            </div>
            <a href='/myprofile'>プロフィール</a>
            <a href='/myprofile/meal/meal_record'>食事記録</a>
            <a href='/myprofile/meal/favorite_meal'>お気に入り</a>
            <a href='/myprofile/meal/meal_chart'>グラフ</a>
             @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <script>
            function deleteMeal(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
