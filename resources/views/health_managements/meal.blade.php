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
            <h1>食事記録</h1>
            
            <div class="summary">
                <div class="summary-item">
                    <label>摂取カロリー:</label>
                    <span id="ingestion_cal">2200 kcal</span>
                </div>
                <div class="summary-item">
                    <label>運動消費カロリー:</label>
                    <span id="movement_consumption_cal">{{ $meal->movement_consumption_cal }} kcal</span>
                </div>
                <div class="summary-item">
                    <label>目標カロリー:</label>
                    <span id="target_cal">{{ $meal->target_cal }} kcal</span>
                </div>
                <div class="summary-item">
                    <label>残り摂取カロリー:</label>
                    <span id="remaining_ingestion_cal">500 kcal</span>
                </div>
                <div class="summary-item">
                    <div style="display: flex; flex-direction: column;">
                        <label>目標タンパク質:</label>
                        <div>
                            <span id="sum_ingested_protein">140g(摂取)</span>
                            <span id="target_protein">/ 200g(目標)</span>
                            <span id="remaining_ingestion_protein">残り摂取：60g</span>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <label>目標脂質:</label>
                        <div>
                            <span id="sum_ingested_fat">70g(摂取)</span>
                            <span id="target_fat">/ 100g(目標)</span>
                            <span id="remeinng_ingestion_fat">残り摂取：30g</span>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <label>目標炭水化物:</label>
                        <div>
                            <span id="sum_ingested_carbo">100g(摂取)</span>
                            <span id="target_carbo">/ 150g(目標)</span>
                            <span id="remaining_ingestion_carbo">残り摂取：50g</span>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>オムライス</td>
                        <td>500</td>
                        <td>20</td>
                        <td>25</td>
                        <td>50</td>
                        <td>2024-04-12 12:30</td>
                    </tr>
                    <tr>
                        <td>サラダ</td>
                        <td>100</td>
                        <td>5</td>
                        <td>2</td>
                        <td>10</td>
                        <td>2024-04-12 18:00</td>
                    </tr>
                    <!-- 他の食事記録も同様に追加 -->
                </tbody>
            </table>
        </div>
    </body>
</html>
