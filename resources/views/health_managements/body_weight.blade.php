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
            <h1>体重</h1>
            <div class="summary">
                <div class="summary_item">
                    <label>前回の体重:</label>
                    <span id="previous_body_weight">{{ $previous_record_body_weight }} kg</span>
                </div>
                <div class="summary_item">
                    <label>目標体重:</label>
                    <span id="target_body_weight">{{ $target_body_weight }} kg</span>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>体重 (kg)</th>
                        <th>体脂肪率 (％)</th>
                        <th>メモ</th>
                        <th>記録日時</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($body_weights as $body_weight)
                        <tr>
                            <td>{{ $body_weight->record_body_weight }}</td>
                            <td>{{ $body_weight->record_body_fat }}</td>
                            <td>{{ $body_weight->record_body_weight_memo }}</td>
                            <td>{{ $body_weight->body_weight_created_at }}</td>
                            <td><a href='/myprofile/body_weight/edit_body_weight/{{ $body_weight->id }}'>編集</a></td>
                            <td>
                                <form action="/myprofile/body_weight/{{ $body_weight->id }}" id="form_{{ $body_weight->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteBody_weight({{ $body_weight->id }})">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class='paginate'>
                {{ $body_weights->links() }}
            </div>
            <a href='/myprofile'>プロフィール</a>
            <a href='/myprofile/body_weight/body_weight_record'>体重記録</a>
        </div>
        <script>
            function deleteBody_weight(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
