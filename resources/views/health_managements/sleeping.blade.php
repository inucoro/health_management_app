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
            <h1>睡眠</h1>
             <div class="summary">
                <div class="summary_item">
                    <label>前回の睡眠時間：</label>
                    <span id="previous_sleeping">7時間</span>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>睡眠時間</th>
                        <th>メモ</th>
                        <th>記録日時</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sleepings as $sleeping)
                        <tr>
                            <td>{{ $sleeping->record_sleeping_time }}</td>
                            <td>{{ $sleeping->record_sleeping_memo }}</td>
                            <td>{{ $sleeping->sleeping_created_at }}</td>
                            <td><a href='/profile/sleeping/edit_sleeping/{{ $sleeping->id }}'>編集</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href='/profile'>プロフィール</a>
            <a href='/profile/sleeping/sleeping_record'>睡眠記録</a>
        </div>
    </body>
</html>
