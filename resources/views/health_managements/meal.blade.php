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
        #calorieChart {
          width: 60%;
          height: auto;
          max-width: 400px;
          margin: 0 auto; /* グラフを中央に配置 */
          display: block; /* インライン要素からブロック要素に変更 */
        }
        .calorie-label {
          display: block; /* インライン要素からブロック要素に変更 */
          margin-top: 10px; /* 上部のマージンを追加 */
        }
        #proteinChart {
          width: 100%; /* グラフの幅を80%に設定 */
          height: 100px; /* グラフの高さを100pxに設定 */
          max-width: 300px; /* 帯グラフの最大幅を調整 */
          margin: 0 auto; /* グラフを中央に配置 */
        }
        #fatChart {
          width: 100%; /* グラフの幅を80%に設定 */
          height: 100px; /* グラフの高さを100pxに設定 */
          max-width: 300px; /* 帯グラフの最大幅を調整 */
          margin: 0 auto; /* グラフを中央に配置 */
        }
        #carbohydrateChart {
          width: 100%; /* グラフの幅を80%に設定 */
          height: 100px; /* グラフの高さを100pxに設定 */
          max-width: 300px; /* 帯グラフの最大幅を調整 */
          margin: 0 auto; /* グラフを中央に配置 */
        }
    </style>
    <div class="container">
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Meal Management</h2>
        
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="col-start-1 col-span-1 mt-8"> 
                <!-- 残り摂取カロリーの円グラフを描画するCanvas要素 -->
                <canvas id="calorieChart"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
                <script>
                  const ctx = document.getElementById("calorieChart");
                  const myPieChart = new Chart(ctx, {
                    type: 'pie', // 円グラフを使用
                    data: {
                      labels: ["合計摂取カロリー", "残り摂取カロリー"],
                      datasets: [{
                        backgroundColor: [
                          'rgba(255, 215, 0, 0.5)', // 薄いオレンジ色
                          'rgba(255, 215, 0, 0)', // オレンジ色（透明）
                        ],
                        borderColor: [
                          'rgba(255, 215, 0, 0.5)', // 薄いオレンジ色（枠線）
                          'rgba(255, 215, 0, 0.5)', // 薄いオレンジ色（枠線）
                        ],
                        borderWidth: 2, // 枠線の幅を設定
                        data: [{{ $ingestion_cal }}, {{ $remaining_ingestion_cal }}]
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
                          
                  　// 合計摂取カロリーが目標摂取カロリーを超えた場合、残り摂取カロリーを0に設定する
                    if ({{ $ingestion_cal }} > {{ $user->target_cal }}) {
                        myPieChart.data.datasets[0].data[1] = 0;
                        myPieChart.update();
                    }
                </script>
            </div>
            <div class="col-start-2 col-span-1 mt-14"> 
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
                </div>
            </div>
        </div>
        
        
        <div class="summary">        
            <div class="rounded border border-red-400 p-4">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold leading-tight text-center">タンパク質</h1>
                    <div>
                        <span id="sum_ingested_protein">{{ $sum_ingested_protein }}g(摂取)</span>
                        <span id="target_protein">/ {{ $target_protein }}g(目標)</span>
                        <span id="remaining_ingestion_protein">　残り摂取：{{ $remaining_ingestion_protein }}g</span>
                    </div>
                </div>
                <!-- 目標タンパク質、摂取タンパク質、残りタンパク質の帯グラフを描画するCanvas要素 -->
                <canvas id="proteinChart" style="max-width: 100%; height: 60px;"></canvas>
                
                <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0"></script>
                <script>
                    // PHP変数からデータを取得
                    const sumIngestedProtein = {{ $sum_ingested_protein }};
                    const remainingIngestionProtein = {{ $remaining_ingestion_protein }};
                    const targetProtein = {{ $target_protein }};
                
                    // Canvas要素を取得
                    const proteinCtx = document.getElementById("proteinChart");
                
                    // 帯グラフを描画
                    const proteinBarChart = new Chart(proteinCtx, {
                        type: 'bar',
                        data: {
                            labels: ['タンパク質'], // ラベル
                            datasets: [{
                                label: '摂取',
                                data: [sumIngestedProtein], // 摂取データ
                                backgroundColor: 'rgba(255, 99, 132, 0.5)', // 摂取タンパク質の色
                                borderWidth: 2,
                                borderColor: 'rgba(255, 99, 132, 0.5)' // 摂取タンパク質の枠線の色を赤に設定
                            }, {
                                label: '残り',
                                data: [remainingIngestionProtein], // 残りデータ
                                borderColor: 'rgba(255, 99, 132, 0.5)', // 残りタンパク質の色（枠線）
                                borderWidth: 2,
                                backgroundColor: 'rgba(0, 0, 0, 0)' // 残りタンパク質の背景色を透明に設定
                            }]
                        },
                        options: {
                            indexAxis: 'y', // y軸に沿って帯グラフを描画
                            scales: {
                                x: {
                                    stacked: true // 棒グラフを積み上げる
                                },
                                y: {
                                    stacked: true // 棒グラフを積み上げる
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                            }
                        }
                    });
                    
                    // 摂取タンパク質が目標タンパク質を上回った場合に残りタンパク質を非表示にする
                    if (sumIngestedProtein > targetProtein) {
                        proteinBarChart.data.datasets[1].data = [0]; // 残りタンパク質のデータを0に設定
                        proteinBarChart.update(); // チャートを更新して残りタンパク質を非表示にする
                    }
                </script>
            </div> 
            <br>
            <div class="rounded border border-yellow-400 p-4">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold leading-tight text-center">脂質</h1>
                    <div>
                        <span id="sum_ingested_fat">{{ $sum_ingested_fat }}g(摂取)</span>
                        <span id="target_fat">/ {{ $target_fat }}g(目標)</span>
                        <span id="remaining_ingestion_fat">　残り摂取：{{ $remaining_ingestion_fat }}g</span>
                    </div>
                </div>
                    
                <!-- 目標脂質、摂取脂質、残り脂質の帯グラフを描画するCanvas要素 -->
                <canvas id="fatChart" style="max-width: 100%; height: 60px;"></canvas>
                
                <script>
                    // PHP変数からデータを取得
                    const sumIngestedFat = {{ $sum_ingested_fat }};
                    const remainingIngestionFat = {{ $remaining_ingestion_fat }};
                    const targetFat = {{ $target_fat }};
                
                    // Canvas要素を取得
                    const fatCtx = document.getElementById("fatChart");
                
                    // 帯グラフを描画
                    const fatBarChart = new Chart(fatCtx, {
                        type: 'bar', 
                        data: {
                            labels: ['　　脂質　'], // ラベル
                            datasets: [{
                                label: '摂取',
                                data: [sumIngestedFat], // 摂取データ
                                backgroundColor: 'rgba(255, 205, 86, 0.5)', // 摂取脂質の色
                                borderWidth: 2,
                                borderColor: 'rgba(255, 205, 86, 0.5)'
                            }, {
                                label: '残り',
                                data: [remainingIngestionFat], // 残りデータ
                                borderColor: 'rgba(255, 205, 86, 0.5)', // 残り脂質の色（枠線）
                                borderWidth: 2,
                                backgroundColor: 'rgba(0, 0, 0, 0)' // 残り脂質の背景色を透明に設定
                            }]
                        },
                        options: {
                            indexAxis: 'y', // y軸に沿って帯グラフを描画
                            scales: {
                                x: {
                                    stacked: true // 棒グラフを積み上げる
                                },
                                y: {
                                    stacked: true // 棒グラフを積み上げる
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                            }
                        }
                    });
                    
                    if (sumIngestedFat > targetFat) {
                        fatBarChart.data.datasets[1].data = [0]; // 残り脂質のデータを0に設定
                        fatBarChart.update(); // チャートを更新して残り脂質を非表示にする
                    }
                </script>
            </div>   
            <br>
            <div class="rounded border border-blue-400 p-4">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold leading-tight text-center">炭水化物</h1>
                    <div>
                        <span id="sum_ingested_carbo">{{ $sum_ingested_carbo }}g(摂取)</span>
                        <span id="target_carbo">/ {{ $target_carbo }}g(目標)</span>
                        <span id="remaining_ingestion_carbo">　残り摂取：{{ $remaining_ingestion_carbo }}g</span>
                    </div>
                </div>
 
                <!-- 目標炭水化物、摂取炭水化物、残り炭水化物の帯グラフを描画するCanvas要素 -->
                <canvas id="carbohydrateChart" style="max-width: 100%; height: 60px;"></canvas>
                
                <script>
                    // PHP変数からデータを取得
                    const sumIngestedCarbohydrate = {{ $sum_ingested_carbo }};
                    const remainingIngestionCarbohydrate = {{ $remaining_ingestion_carbo }};
                    const targetCarbohydrate = {{ $target_carbo }};
                
                    // Canvas要素を取得
                    const carbohydrateCtx = document.getElementById("carbohydrateChart");
                
                    // 帯グラフを描画
                    const carbohydrateBarChart = new Chart(carbohydrateCtx, {
                        type: 'bar', 
                        data: {
                            labels: ['　炭水化物'], // ラベル
                            datasets: [{
                                label: '摂取',
                                data: [sumIngestedCarbohydrate], // 摂取データ
                                backgroundColor: 'rgba(54, 162, 235, 0.5)', // 摂取炭水化物の色
                                borderWidth: 2,
                                borderColor: 'rgba(54, 162, 235, 0.5)'
                            }, {
                                label: '残り',
                                data: [remainingIngestionCarbohydrate], // 残りデータ
                                borderColor: 'rgba(54, 162, 235, 0.5)', // 残り炭水化物の色（枠線）
                                borderWidth: 2,
                                backgroundColor: 'rgba(0, 0, 0, 0)' // 残り炭水化物の背景色を透明に設定
                            }]
                        },
                        options: {
                            indexAxis: 'y', // y軸に沿って帯グラフを描画
                            scales: {
                                x: {
                                    stacked: true // 棒グラフを積み上げる
                                },
                                y: {
                                    stacked: true // 棒グラフを積み上げる
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                            }
                        }
                    });
                    
                    if (sumIngestedCarbohydrate > targetCarbohydrate) {
                        carbohydrateBarChart.data.datasets[1].data = [0]; // 残り炭水化物のデータを0に設定
                        carbohydrateBarChart.update(); // チャートを更新して残り炭水化物を非表示にする
                    }
                </script>
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
                {{ $meals->links('vendor.pagination.tailwind2') }}
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
                display: flex;
                flex-direction: column;
                align-items: flex-start;
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
                message.innerHTML = '目標摂取カロリーを超えました！食事を控えるように心掛けてください。<br><div class="button-container"><label><input type="checkbox" id="hideForeverCheckbox">二度と表示しない</label><button onclick="hideMessage_meal()" class="shadow-lg px-5 py-1 bg-blue-500 text-white font-semibold rounded hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition">OK</button></div>';
                document.body.appendChild(message);
                checkAndHideMessage(); // ページ読み込み時にローカルストレージをチェックして非表示にする
            };
        
            function hideMessage_meal() {
                var hideForeverCheckbox = document.getElementById('hideForeverCheckbox');
                if (hideForeverCheckbox.checked) {
                    localStorage.setItem('hideMessage_meal', true);
                }
                var message = document.getElementById('message');
                if (message) {
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
                
                form.addEventListener('submit', function(event) {
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
