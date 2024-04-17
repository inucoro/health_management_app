<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>運動</title>

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
            .summary-item {
                margin-top: 10px;
                display: flex;
                justify-content: space-between;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 4px;
            }
            .summary-item label {
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
            <h1>運動</h1>
            
            <div class="summary">
                <div class="summary-item">
                    <label>合計運動消費カロリー:</label>
                    <span id="movement_consumption_cal">{{ $sum_movement_consumption_cal }} kcal</span>
                </div>
                <div class="summary-item">
                    <label>目標運動消費カロリー:</label>
                    <span id="target_movement_consumption_cal">{{ $target_movement_consumption_cal }} kcal</span>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>運動の種目</th>
                        <th>扱った錘の重さ</th>
                        <th>挙上回数</th>
                        <th>セット数</th>
                        <th>運動時間</th>
                        <th>運動消費カロリー</th>
                        <th>記録日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movements as $movement)
                        <tr>
                            <td>{{ $movement->record_type }}</td>
                            <td>{{ $movement->record_weight }}</td>
                            <td>{{ $movement->record_times }}</td>
                            <td>{{ $movement->record_sets }}</td>
                            <td>{{ $movement->record_movement_times }}</td>
                            <td>{{ $movement->movement_consumption_cal }}</td>
                            <td>{{ $movement->movement_created_at }}</td>
                        </tr>
                    @endforeach
            </table>
            <a href='/profile'>プロフィール</a>
            <a href='/profile/movement/movement_record'>運動記録</a>
        </div>
    </body>
</html>
