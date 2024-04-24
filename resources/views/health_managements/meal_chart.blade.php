<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>食事グラフ</title>
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
        </style>
    </head>
    <body>
        <div class="container">
            <h1>食事グラフ</h1>
            <canvas id="mealCalorieChart" width="400" height="200"></canvas>
            <canvas id="proteinChart" width="400" height="200"></canvas>
            <canvas id="fatChart" width="400" height="200"></canvas>
            <canvas id="carboChart" width="400" height="200"></canvas>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
            <script>
                // データを取得するAjaxリクエスト
                fetch('{{ route('mealcalorieschart.get') }}') // ルート名からURLを生成
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // 取得したデータをコンソールに出力
                
                        // カロリーグラフを描画
                        var ctx = document.getElementById('mealCalorieChart').getContext('2d');
                        var mealCalorieChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.map(item => item.created_at),
                                datasets: [{
                                    label: '食事カロリー',
                                    data: data.map(item => item.ingestion_cal),
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        mode: 'index',
                                        intersect: false,
                                    },
                                },
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            parser: 'YYYY-MM-DD', // ここで日付のフォーマットを指定
                                        },
                                        grid: {
                                            display: false
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)',
                                        },
                                    },
                                },
                            }
                        });
                
                        // 目標カロリーを取得してグラフに点線で表示
                        fetch('{{ route('targetcal.get') }}') // ルート名からURLを生成
                            .then(response => response.json())
                            .then(target_cal => {
                                var line = {
                                    type: 'line',
                                    label: '目標カロリー',
                                    borderColor: 'red',
                                    borderWidth: 1,
                                    borderDash: [5, 5], // 点線の設定
                                    data: Array(data.length).fill(target_cal) // カロリーデータと同じ数の目標カロリーの配列を作成
                                };
                                mealCalorieChart.data.datasets.push(line);
                                mealCalorieChart.update();
                            });
                    });
                    
                // タンパク質グラフを描画
                fetch('{{ route('mealproteinchart.get') }}')
                    .then(response => response.json())
                    .then(data => {
                        var ctx = document.getElementById('proteinChart').getContext('2d');
                        var proteinChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.map(item => item.created_at),
                                datasets: [{
                                    label: 'タンパク質',
                                    data: data.map(item => item.sum_ingested_protein),
                                    borderColor: 'rgb(255, 99, 132)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            parser: 'YYYY-MM-DD', // ここで日付のフォーマットを指定
                                        },
                                        grid: {
                                            display: false
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)',
                                        },
                                    },
                                },
                            }
                        });
                        
                        // 目標タンパク質を取得してグラフに点線で表示
                        fetch('{{ route('targetprotein.get') }}')
                            .then(response => response.json())
                            .then(target_protein => {
                                var line = {
                                    type: 'line',
                                    label: '目標タンパク質',
                                    borderColor: 'red',
                                    borderWidth: 1,
                                    borderDash: [5, 5], // 点線の設定
                                    data: Array(data.length).fill(target_protein) // タンパク質データと同じ数の目標タンパク質の配列を作成
                                };
                                proteinChart.data.datasets.push(line);
                                proteinChart.update();
                            });
                    });
    
                // 脂質グラフを描画
                fetch('{{ route('mealfatchart.get') }}')
                    .then(response => response.json())
                    .then(data => {
                        var ctx = document.getElementById('fatChart').getContext('2d');
                        var fatChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.map(item => item.created_at),
                                datasets: [{
                                    label: '脂質',
                                    data: data.map(item => item.sum_ingested_fat),
                                    borderColor: 'rgb(54, 162, 235)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            parser: 'YYYY-MM-DD', // ここで日付のフォーマットを指定
                                        },
                                        grid: {
                                            display: false
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)',
                                        },
                                    },
                                },
                            }
                        });
                        
                        // 目標脂質を取得してグラフに点線で表示
                        fetch('{{ route('targetfat.get') }}')
                            .then(response => response.json())
                            .then(target_fat => {
                                var line = {
                                    type: 'line',
                                    label: '目標脂質',
                                    borderColor: 'red',
                                    borderWidth: 1,
                                    borderDash: [5, 5], // 点線の設定
                                    data: Array(data.length).fill(target_fat) // 脂質データと同じ数の目標脂質の配列を作成
                                };
                                fatChart.data.datasets.push(line);
                                fatChart.update();
                            });
                    });
    
                // 炭水化物グラフを描画
                fetch('{{ route('mealcarbochart.get') }}')
                    .then(response => response.json())
                    .then(data => {
                        var ctx = document.getElementById('carboChart').getContext('2d');
                        var carbohydrateChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.map(item => item.created_at),
                                datasets: [{
                                    label: '炭水化物',
                                    data: data.map(item => item.sum_ingested_carbo),
                                    borderColor: 'rgb(255, 205, 86)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            parser: 'YYYY-MM-DD', // ここで日付のフォーマットを指定
                                        },
                                        grid: {
                                            display: false
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)',
                                        },
                                    },
                                },
                            }
                        });
                        
                        // 目標炭水化物を取得してグラフに点線で表示
                        fetch('{{ route('targetcarbo.get') }}')
                            .then(response => response.json())
                            .then(target_carbo => {
                                var line = {
                                    type: 'line',
                                    label: '目標炭水化物',
                                    borderColor: 'red',
                                    borderWidth: 1,
                                    borderDash: [5, 5], // 点線の設定
                                    data: Array(data.length).fill(target_carbo) // 炭水化物データと同じ数の目標炭水化物の配列を作成
                                };
                                carbohydrateChart.data.datasets.push(line);
                                carbohydrateChart.update();
                            });
                    });
            </script>
            <div class="footer">
                    <a href="/myprofile/meal">戻る</a>
            </div>
        </div>
    </body>
</html>