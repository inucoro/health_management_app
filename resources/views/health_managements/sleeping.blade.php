<!DOCTYPE html>
<x-app-layout>
    <!-- Styles -->
    <style>
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

    <div class="container">
        <h2 class="mb-4 text-2xl font-semibold leading-tight text-center">睡眠</h2>
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
    </div>
        
    <div style="margin-bottom: 20px;"></div>
        
    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-800">
    	<h2 class="mb-4 text-2xl font-semibold leading-tight">Sleeping Table</h2>
    	<div class="overflow-x-auto">
    		<table class="min-w-full text-xs">
    			<colgroup>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col class="w-24">
    			</colgroup>
    			<thead class="dark:bg-gray-300">
    				<tr class="text-left">
    					<th class="p-3">就寝時間</th>
    					<th class="p-3">起床時間</th>
    					<th class="p-3">メモ</th>
    					<th class="p-3">記録日時</th></th>
    					<th class="p-3">編集</th>
    					<th class="p-3">削除</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($sleepings as $sleeping)
                    <tr class="border-b border-opacity-20 dark:border-gray-300 dark:bg-gray-50">
                        <td class="text-center">{{ $sleeping->record_bedtime }}</td>
                        <td class="text-center">{{ $sleeping->record_wake_up_time }}</td>
                        <td class="text-center">{{ $sleeping->record_sleeping_memo }}</td>
                        <td class="text-center">{{ $sleeping->sleeping_created_at }}</td>
                        <td class="text-center">
                            <button type="button" onclick="location.href='/myprofile/sleeping/edit_sleeping/{{ $sleeping->id }}'" class="shadow-lg px-2 py-1  bg-green-500 text-white font-semibold rounded  hover:bg-green-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">編集</button>
                        </td>
                        <td class="text-center">
                            <div>
                                <form action="/myprofile/sleeping/{{ $sleeping->id }}" id="form_{{ $sleeping->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteSleeping({{ $sleeping->id }})" class="shadow-lg px-2 py-1  bg-red-500 text-white font-semibold rounded  hover:bg-red-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
    			</tbody>
    		</table>
    	    <div class='paginate'>
                {{ $sleepings->links() }}
            </div>
    	</div>
	    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
        
    
    @if ($is_less_than_5_hours)
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
                message.innerHTML = '今日はあまり睡眠時間がとれていません。体調に気を付けてください。<br><button onclick="hideMessage_sleeping()">OK</button><label><input type="checkbox" id="hideForeverCheckbox">二度と表示しない</label>';
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

    <script>
        function deleteSleeping(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
