<!DOCTYPE html>
<x-app-layout>
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
        <h2 class="mb-4 text-2xl font-semibold leading-tight text-center">食事</h2>
        
        <div class="summary">
            <div class="summary_item">
                <label>目標カロリー:</label>
                <span id="target_cal">{{ $user->target_cal }} kcal</span>
            </div>
            <div class="summary_item">
                <label>合計運動消費カロリー:</label>
                <span id="sum_movement_consumption_cal">{{ $sum_movement_consumption_cal }} kcal</span>
            </div>
            <div class="summary_item">
                <label>合計摂取カロリー:</label>
                <span id="ingestion_cal">{{ $ingestion_cal }} kcal</span>
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
    </div>
    
    <div style="margin-bottom: 20px;"></div>
        
    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-800">
        <div class="flex justify-between items-center">
            <h2 class="mb-4 text-2xl font-semibold leading-tight">Meal Table</h2>
            <div class="m-3">
                <button onclick="location.href='/myprofile/meal/favorite_meal'" class="shadow-lg px-3 py-1 bg-yellow-500 text-lg text-white font-semibold rounded hover:bg-yellow-700 hover:shadow-sm hover:translate-y-0.5 transform transition">お気に入り</button>
            </div>
        </div>
    	<div class="overflow-x-auto">
    		<table class="min-w-full text-xs">
    			<colgroup>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col class="w-24">
    			</colgroup>
    			<thead class="dark:bg-gray-300">
    				<tr class="text-left">
    					<th class="p-3">メニュー</th>
    					<th class="p-3">カロリー(kcal)</th>
    					<th class="p-3">タンパク質(g)</th>
    					<th class="p-3">脂質(g)</th>
    					<th class="p-3">炭水化物(g)</th>
    					<th class="p-3">記録日時</th>
    					<th class="p-3">編集</th>
    					<th class="p-3">削除</th>
    					<th class="p-3">お気に入り</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($meals as $meal)
                    <tr class="border-b border-opacity-20 dark:border-gray-300 dark:bg-gray-50">
                        <td class="text-center">{{ $meal->record_menu }}</td>
                        <td class="text-center">{{ $meal->record_cal }}</td>
                        <td class="text-center">{{ $meal->record_protein }}</td>
                        <td class="text-center">{{ $meal->record_fat }}</td>
                        <td class="text-center">{{ $meal->record_carbo }}</td>
                        <td class="text-center">{{ $meal->meal_created_at }}</td>
                        <td class="text-center">
                            <button type="button" onclick="location.href='/myprofile/meal/edit_meal/{{ $meal->id }}'" class="shadow-lg px-2 py-1  bg-green-500 text-white font-semibold rounded  hover:bg-green-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">編集</button>
                        </td>
                        <td class="text-center">
                            <div>
                                <form action="/myprofile/meal/{{ $meal->id }}" id="form_{{ $meal->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteMeal({{ $meal->id }})" class="shadow-lg px-2 py-1  bg-red-500 text-white font-semibold rounded  hover:bg-red-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">削除</button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" onclick="location.href='/myprofile/meal/favorite_meal_record/{{ $meal->id }}'" class="shadow-lg px-2 py-1  bg-blue-500 text-white font-semibold rounded  hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">追加</button>
                        </td>
                    </tr>
                    @endforeach
    			</tbody>
    		</table>
    	    <div class='paginate'>
                {{ $meals->links() }}
            </div>
    	</div>
	    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    
                
    @if ($ingestion_cal > $user->target_cal)
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
                message.innerHTML = '目標摂取カロリーを超えました！控えるよう心掛けてください。<br><button onclick="hideMessage_meal()">OK</button><label><input type="checkbox" id="hideForeverCheckbox">二度と表示しない</label>';
                document.body.appendChild(message);
                checkAndHideMessage(); // ページ読み込み時にローカルストレージをチェックして非表示にする
            };
        
            function hideMessage_meal() {
                var message = document.getElementById('message');
                if (message) {
                    var hideForeverCheckbox = document.getElementById('hideForeverCheckbox');
                    if (hideForeverCheckbox.checked) {
                        localStorage.setItem('hideMessage_meal', true);
                    }
                    message.style.display = 'none';
                }
            }
        
            function checkAndHideMessage() {
                if (localStorage.getItem('hideMessage_meal')) {
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
                        localStorage.setItem('hideMessage_meal', true);
                    }
                });
            });
        </script>
    @endif
    
    
	<script>
        function deleteMeal(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
