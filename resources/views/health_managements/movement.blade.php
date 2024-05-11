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
        #movementCalorieChart {
          width: 60%;
          height: auto;
          max-width: 400px;
          margin: 0 auto; /* グラフを中央に配置 */
          display: block; /* インライン要素からブロック要素に変更 */
        }
        
        .movement-calorie-label {
          display: block; /* インライン要素からブロック要素に変更 */
          margin-top: 10px; /* 上部のマージンを追加 */
        }
    </style>
    <div class="container">
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Movement Management</h2>
        
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="col-start-1 col-span-1 mt-8"> 
                <!-- 合計運動消費カロリーと目標運動消費カロリーの円グラフを描画するCanvas要素 -->
                <canvas id="movementCalorieChart"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
                        
                <script>
                    const movementCtx = document.getElementById("movementCalorieChart");
                    const movementPieChart = new Chart(movementCtx, {
                        type: 'pie', // 円グラフを使用
                        data: {
                            labels: ["合計運動消費カロリー", "目標まであと"],
                            datasets: [{
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.5)', // 青色
                                    'rgba(0, 0, 0, 0)' // 透明
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 0.5)', // 青色（枠線）
                                    'rgba(54, 162, 235, 0.5)', // 青色
                                ],
                                borderWidth: 2, // 枠線の幅を設定
                                data: [{{ $sum_movement_consumption_cal }}, {{ $consumed_cal_up_to_target }}]
                            }]
                        },
                        plugins: [ChartDataLabels], // pluginとしてchartdatalabelsを追加
                        options: {
                            plugins: {
                                datalabels: { // パーセンテージからラベル表記に変更
                                    formatter: function(value, context) {
                                        if (value === 0) {
                                            return '';
                                        }
                                        return context.chart.data.labels[context.dataIndex] + ": " + value + ' kcal';
                                    },
                                    color: '#000', // ラベルの色
                                    display: true,
                                    font: {
                                        weight: 'bold' // ラベルのフォントウェイトを太字に設定
                                    }
                                },
                                legend: {
                                  display: false // 凡例を非表示にする
                                }
                            }
                        }
                    });
                    
                    // 合計運動消費カロリーが目標までの運動消費カロリーを超えた場合、残りの運動消費カロリーを0に設定する
                    if ({{ $sum_movement_consumption_cal }} > {{ $target_movement_consumption_cal }}) {
                        movementPieChart.data.datasets[0].data[1] = 0;
                        movementPieChart.update();
                    }
                </script>
            </div>
            <div class="col-start-2 col-span-1 mt-20"> 
                <div class="summary">
                    <div class="summary_item">
                        <label>合計運動消費カロリー:</label>
                        <span id="movement_consumption_cal">{{ $sum_movement_consumption_cal }} kcal</span>
                    </div>
                    <div class="summary_item">
                        <label>目標運動消費カロリー:</label>
                        <span id="target_movement_consumption_cal">{{ $target_movement_consumption_cal }} kcal</span>
                    </div>
                    <div class="summary_item">
                        <label>目標まであと</label>
                        <span id="consumed_cal_up_to_target">{{ $consumed_cal_up_to_target }} kcal</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div style="margin-bottom: 20px;"></div>
        
    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-800">
        <div class="flex justify-between items-center">
            <h2 class="mb-4 text-2xl font-semibold leading-tight">Movement Table</h2>
            <div class="m-3">
                <button onclick="location.href='/myprofile/movement/favorite_movement'" class="shadow-lg px-3 py-1 bg-yellow-500 text-lg text-white font-semibold rounded hover:bg-yellow-700 hover:shadow-sm hover:translate-y-0.5 transform transition">お気に入り</button>
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
    				<col>
    				<col class="w-24">
    			</colgroup>
    			<thead class="dark:bg-gray-300">
    				<tr class="text-left">
    					<th class="p-3">運動種目</th>
    					<th class="p-3">錘の重量(kg)</th>
    					<th class="p-3">挙上回数(Reps)</th>
    					<th class="p-3">セット数</th>
    					<th class="p-3">運動時間(min)</th>
    					<th class="p-3">運動消費カロリー(kcal)</th>
    					<th class="p-3">記録日時</th></th>
    					<th class="p-3">編集</th>
    					<th class="p-3">削除</th>
    					<th class="p-3">お気に入り</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($movements as $movement)
                    <tr class="border-b border-opacity-20 dark:border-gray-300 dark:bg-gray-50">
                        <td class="text-center">{{ $movement->record_type }}</td>
                        <td class="text-center">{{ $movement->record_weight }}</td>
                        <td class="text-center">{{ $movement->record_times }}</td>
                        <td class="text-center">{{ $movement->record_sets }}</td>
                        <td class="text-center">{{ $movement->record_movement_times }}</td>
                        <td class="text-center">{{ $movement->movement_consumption_cal }}</td>
                        <td class="text-center">{{ $movement->movement_created_at }}</td>
                        <td class="text-center">
                            <button type="button" onclick="location.href='/myprofile/movement/edit_movement/{{ $movement->id }}'" class="shadow-lg px-2 py-1  bg-green-500 text-white font-semibold rounded  hover:bg-green-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">編集</button>
                        </td>
                        <td class="text-center">
                            <div>
                                <form action="/myprofile/movement/{{ $movement->id }}" id="form_{{ $movement->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteMovement({{ $movement->id }})" class="shadow-lg px-2 py-1  bg-red-500 text-white font-semibold rounded  hover:bg-red-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">削除</button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" onclick="location.href='/myprofile/movement/favorite_movement_record/{{ $movement->id }}'" class="shadow-lg px-2 py-1  bg-blue-500 text-white font-semibold rounded  hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">追加</button>
                        </td>
                    </tr>
                    @endforeach
    			</tbody>
    		</table>
    	    <div class='paginate'>
                {{ $movements->links('vendor.pagination.tailwind2') }}
            </div>
    	</div>
	    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    
    @if ($sum_movement_consumption_cal > $target_movement_consumption_cal)
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
                border: none;
                cursor: pointer;
            }
            
            #message label + button {
                margin-top: 10px;
            }
            
            #message .button-container {
                margin-top: 20px;
                display: flex;
                justify-content: space-between; /* OKボタンとチェックボックスの間にスペースを追加 */
                width: 100%; /* 親要素の幅いっぱいに広げる */
            }
        </style>
    
        <script>
            window.onload = function() {
                var message = document.createElement('div');
                message.id = 'message';
                message.innerHTML = '目標運動消費カロリーを超えました！いい心掛けですね！<br><div class="button-container"><label><input type="checkbox" id="hideForeverCheckbox">二度と表示しない</label><button onclick="hideMessage_movement()" class="shadow-lg px-5 py-1 bg-blue-500 text-white font-semibold rounded hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition">OK</button></div>';
                document.body.appendChild(message);
                checkAndHideMessage(); // ページ読み込み時にローカルストレージをチェックして非表示にする
            };
        
            function hideMessage_movement() {
                var hideForeverCheckbox = document.getElementById('hideForeverCheckbox');
                if (hideForeverCheckbox.checked) {
                    localStorage.setItem('hideMessage_movement', true);
                }
                var message = document.getElementById('message');
                if (message) {
                    message.style.display = 'none';
                }
            }
        
            function checkAndHideMessage() {
                if (localStorage.getItem('hideMessage_movement')) {
                    var message = document.getElementById('message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }
            }
        
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.querySelector('form');
                
                form.addEventListener('submit', function(event) {
                    var hideForeverCheckbox = document.getElementById('hideForeverCheckbox');
                    if (hideForeverCheckbox.checked) {
                        localStorage.setItem('hideMessage_movement', true);
                    }
                });
            });
        </script>
    @endif

    
    <script>
        function deleteMovement(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>