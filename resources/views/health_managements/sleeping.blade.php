<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>睡眠</title>

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
                border: 1px solid #ccc; /* ページ全体を囲む枠線 */
                border-radius: 8px; /* 枠線の角を丸くする */
                padding: 20px;
                background-color: #fff; /* ページの背景色 */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .title {
                text-align: center; /* 中央ぞろえ */
                font-size: 24px; /* 大きなフォントサイズ */
                font-weight: bold; /* 太字 */
                margin-bottom: 20px; /* 下部のマージン */
            }
            .comment {
                text-align: center; /* 中央ぞろえ */
                margin-bottom: 20px;
            }
            .record {
                border: 1px solid #ccc; /* 各レコードを囲む枠線 */
                border-radius: 8px; /* 枠線の角を丸くする */
                padding: 15px;
                margin-bottom: 20px;
            }
            .record p {
                margin: 0;
                margin-bottom: 10px; /* 行の間隔を追加 */
            }
            .record p:first-child {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">睡眠</div>
            <div class="comment">
                <p>前回の睡眠時間：7時間</p>
            </div>
            <div class="record">
                <p>睡眠時間: 7時間30分</p>
                <p>メモ: 昨夜は良い睡眠が取れました。</p>
                <p>記録日時: 2024-04-10 08:00</p>
            </div>
            <div class="record">
                <p>睡眠時間: 8時間</p>
                <p>メモ: 今日は早めに寝たので、朝もスッキリです。</p>
                <p>記録日時: 2024-04-11 08:30</p>
            </div>
            <!-- 他の睡眠記録も同様に表示 -->
        </div>
    </body>
</html>
