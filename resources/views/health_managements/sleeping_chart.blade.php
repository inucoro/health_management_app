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
    </style>

    <div class="container">
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Sleeping Graph</h2>
        <canvas id="sleepingChart" width="400" height="200"></canvas>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
        <script>
            // データを取得するAjaxリクエスト
            fetch('{{ route('sleepingchart.get') }}') // ルート名からURLを生成
                .then(response => response.json())
                .then(data => {
                    console.log(data); // 取得したデータをコンソールに出力
            
                    // 睡眠グラフを描画
                    var ctx = document.getElementById('sleepingChart').getContext('2d');
                    var sleepingChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.map(item => item.sleeping_created_at),
                            datasets: [{
                                label: '睡眠時間',
                                data: data.map(item => item.record_sleeping_time),
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
            
                // 目標睡眠を取得してグラフに点線で表示
                fetch('{{ route('targetsleeping.get') }}') // ルート名からURLを生成
                    .then(response => response.json())
                    .then(target_sleeping_time => {
                        if (sleepingChart.data.datasets.length > 0) {
                            var line = {
                                type: 'line',
                                label: '目標睡眠時間',
                                borderColor: 'red',
                                borderWidth: 1,
                                borderDash: [5, 5], // 点線の設定
                                data: Array(data.length).fill(target_sleeping_time)
                            };
                            sleepingChart.data.datasets.push(line);
                            sleepingChart.update();
                        }
                    });
            });
    </script>

</x-app-layout>