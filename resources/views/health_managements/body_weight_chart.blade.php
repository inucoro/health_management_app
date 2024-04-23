<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>体重グラフ</title>
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
            <h1>体重グラフ</h1>
            <canvas id="body_weightChart" width="400" height="200"></canvas>
            <canvas id="body_fatChart" width="400" height="200"></canvas>
        
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
            <script>
                // データを取得するAjaxリクエスト
                fetch('{{ route('body_weightchart.get') }}') // ルート名からURLを生成
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // 取得したデータをコンソールに出力
                
                        // 体重グラフを描画
                        var ctx = document.getElementById('body_weightChart').getContext('2d');
                        var body_weightChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.map(item => item.body_weight_created_at),
                                datasets: [{
                                    label: '体重',
                                    data: data.map(item => item.record_body_weight),
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
                
                        // 目標体重を取得してグラフに点線で表示
                        fetch('{{ route('targetbody_weight.get') }}') // ルート名からURLを生成
                            .then(response => response.json())
                            .then(target_body_weight => {
                                if (body_weightChart.data.datasets.length > 0) {
                                    var line = {
                                        type: 'line',
                                        label: '目標体重',
                                        borderColor: 'red',
                                        borderWidth: 1,
                                        borderDash: [5, 5], // 点線の設定
                                        data: Array(data.length).fill(target_body_weight)
                                    };
                                    body_weightChart.data.datasets.push(line);
                                    body_weightChart.update();
                                }
                            });
                    });
                    
                // 体脂肪グラフを描画
                fetch('{{ route('body_fatchart.get') }}')
                    .then(response => response.json())
                    .then(data => {
                        var ctx = document.getElementById('body_fatChart').getContext('2d');
                        var proteinChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.map(item => item.body_weight_created_at),
                                datasets: [{
                                    label: '体脂肪率',
                                    data: data.map(item => item.record_body_fat),
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
                    });
            </script>
            <div class="footer">
                    <a href="/myprofile/body_weight">戻る</a>
            </div>
        </div>
    </body>
</html>