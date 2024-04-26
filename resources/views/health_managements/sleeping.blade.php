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
                    <label>今日の睡眠時間：</label>
                    <span id="today_sleeping_time">{{ $today_sleeping_time }}</span>
                    <label>前回の睡眠時間：</label>
                    <span id="previous_record_sleeping_time">{{ $previous_record_sleeping_time }}</span>
                    <label>目標睡眠時間：</label>
                    <span id="target_sleeping_time">{{ $target_sleeping_time }}時間</span>
                </div>
            </div>
            
            @if ($today_sleeping_time < 5)
                <style>
                    #message {
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: #fff;
                        border: 1px solid #ccc;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        z-index: 9999;
                    }
            
                    #message button {
                        margin-top: 10px;
                        padding: 8px 16px;
                        background-color: #007bff;
                        color: #fff;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                    }
                </style>
            
                <script>
                    window.onload = function() {
                        var message = document.createElement('div');
                        message.id = 'message';
                        message.innerHTML = 'あまり睡眠時間がとれていません。体調に気を付けてください。<br><button onclick="hideMessage_sleeping()">OK</button><label><input type="checkbox" id="hideForeverCheckbox">二度と表示しない</label>';
                        document.body.appendChild(message);
                        checkAndHideMessage(); // ページ読み込み時にローカルストレージをチェックして非表示にする
                    };
                
                    function hideMessage_sleeping() {
                        var message = document.getElementById('message');
                        if (message) {
                            var hideForeverCheckbox = document.getElementById('hideForeverCheckbox');
                            if (hideForeverCheckbox.checked) {
                                localStorage.setItem('hideMessage_sleeping', true);
                            }
                            message.style.display = 'none';
                        }
                    }
                
                    function checkAndHideMessage() {
                        if (localStorage.getItem('hideMessage_sleeping')) {
                            var message = document.getElementById('message');
                            if (message) {
                                message.style.display = 'none';
                            }
                        }
                    }
                
                    document.addEventListener('DOMContentLoaded', function() {
                        var form = document.querySelector('form');
                        
                        form.addEventListener('submit', function() {
                            var hideForeverCheckbox = document.getElementById('hideForeverCheckbox');
                            if (hideForeverCheckbox.checked) {
                                localStorage.setItem('hideMessage_sleeping', true);
                            }
                        });
                    });
                </script>
            @endif
            
            <table>
                <thead>
                    <tr>
                        <th>就寝時間</th>
                        <th>起床時間</th>
                        <th>メモ</th>
                        <th>記録日時</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sleepings as $sleeping)
                        <tr>
                            <td>{{ $sleeping->record_bedtime }}</td>
                            <td>{{ $sleeping->record_wake_up_time }}</td>
                            <td>{{ $sleeping->record_sleeping_memo }}</td>
                            <td>{{ $sleeping->sleeping_created_at }}</td>
                            <td><a href='/myprofile/sleeping/edit_sleeping/{{ $sleeping->id }}'>編集</a></td>
                            <td>
                                <form action="/myprofile/sleeping/{{ $sleeping->id }}" id="form_{{ $sleeping->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteSleeping({{ $sleeping->id }})">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class='paginate'>
                {{ $sleepings->links() }}
            </div>
            <a href='/myprofile'>プロフィール</a>
            <a href='/myprofile/sleeping/sleeping_record'>睡眠記録</a>
            <a href='/myprofile/sleeping/sleeping_chart'>グラフ</a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <script>
            function deleteSleeping(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
