<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>体重</title>

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
            .record {
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 20px;
            }
            .record p {
                margin: 0;
            }
            .record-info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .record-info p {
                width: 45%;
            }
            .previous-weight {
                text-align: center;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>体重記録</h1>
            <!-- 前回の体重を表記 -->
            <div class="previous-weight">
                <p>前回の体重: 65 kg</p>
            </div>
            <div class="records">
                <div class="record">
                    <div class="record-info">
                        <p>体重: 65 kg</p>
                        <p>体脂肪率: 20%</p>
                    </div>
                    <div class="record-info">
                        <p>メモ: なし</p>
                        <p>記録日時: 2024-04-12 10:30</p>
                    </div>
                </div>
                <div class="record">
                    <div class="record-info">
                        <p>体重: 63 kg</p>
                        <p>体脂肪率: 18%</p>
                    </div>
                    <div class="record-info">
                        <p>メモ: ダイエット継続中</p>
                        <p>記録日時: 2024-04-11 11:00</p>
                    </div>
                </div>
                <!-- 追加の体重記録をここに追加 -->
            </div>
        </div>
    </body>
</html>
