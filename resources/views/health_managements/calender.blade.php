<!DOCTYPE html>
<x-app-layout>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 18px;
            width: calc(100% / 7); /* セルの幅を7分割して均等に */
            position: relative;
        }
        th {
            height: 30px; /* 曜日の枠の高さ */
            background-color: #dcdcdc; /* 曜日のテーブルの背景色 */
        }
        td {
            height: 100px; /* 日付の枠の高さ */
            position: relative; /* スタンプの位置を調整するために必要 */
        }
        td:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }
        .sunday {
            color: red;
        }
        .saturday {
            color: blue;
        }
        .holiday {
            color: red;
            font-weight: bold;
        }
        .date {
            position: absolute;
            top: 5px; /* 日付の枠の上側からの位置 */
            left: 5px; /* 日付の枠の左側からの位置 */
            font-size: 20px;
        }
        /* 今日の日付のセルを薄い青色で塗りつぶす */
        .today {
            background-color: #cce5ff; /* 薄い青色 */
        }
        /* 今日の日付を太字にする */
        .bold {
            font-weight: bold;
        }
         /* スタンプのスタイル */
        .stamp {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px; /* スタンプの幅 */
            height: 30px; /* スタンプの高さ */
            background: url('/image/movement.svg') no-repeat center center; /*アイコンの画像をURLから取得 */
            background-size: cover; /* 画像をセル内でカバー */
            z-index: 1;
        }
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
        <div class="m-3 flex justify-between">
            <button id="prev" class="shadow-lg px-3 py-1 bg-blue-500 text-lg text-white font-semibold rounded hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition mr-2">Last Month</button>
                    <h2 id="monthYear" class="mb-4 text-4xl font-semibold leading-tight text-center">カレンダー</h2>
            <button id="next" class="shadow-lg px-3 py-1 bg-red-500 text-lg text-white font-semibold rounded hover:bg-red-700 hover:shadow-sm hover:translate-y-0.5 transform transition">Next Month</button>
        </div>
        
        <table id="calendar">
            <thead>
                <tr>
                    <th class="sunday">Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th class="saturday">Sat</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
        <script>
            // 運動が記録された日付の配列
            const recordedDates = {!! json_encode($recordedDates) !!}; // recordedDatesをJSON形式にエンコードしてJavaScriptに渡す

            // 日付が現在の年と月と一致するかどうかをチェックする関数
            function isCurrentMonth(year, month, date) {
                const today = new Date();
                return year === today.getFullYear() && month === today.getMonth() && date === today.getDate();
            }
    
            // カレンダーの日付データを作成する関数
            function createCalendar(year, month) {
                const tbody = document.querySelector('#calendar tbody');
                tbody.innerHTML = ''; // 一旦tbodyを空にする
            
                const lastDay = new Date(year, month + 1, 0).getDate(); // 月の最終日を取得
                const firstDayOfWeek = new Date(year, month, 1).getDay(); // 月の最初の曜日を取得
                const todayDate = new Date().getDate(); // 今日の日付を取得
            
                let date = 1;
            
                for (let i = 0; i < 6; i++) {
                    const row = document.createElement('tr');
            
                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');
            
                        if (i === 0 && j < firstDayOfWeek) {
                            // 最初の行で、月の最初の曜日より前のセルは空白にする
                            cell.textContent = '';
                        } else if (date > lastDay) {
                            // 最後の日を超えたらループを抜ける
                            break;
                        } else {
                            const dateText = document.createElement('div');
                            dateText.textContent = date;
                            dateText.classList.add('date');
                            cell.appendChild(dateText);
            
                            // 日曜日と土曜日、祝日のスタイルを適用
                            if (j === 0) {
                                cell.classList.add('sunday');
                            } else if (j === 6) {
                                cell.classList.add('saturday');
                            }
            
                            if (isHoliday(year, month, date)) {
                                cell.classList.add('holiday');
                            }
            
                            // 今日の日付のセルにクラスを追加して薄い青色で塗りつぶし、太字にする
                            if (isCurrentMonth(year, month, date)) {
                                cell.classList.add('today');
                                cell.classList.add('bold');
                            }
            
                            // 運動が記録された日のセルにスタンプを表示する
                            if (recordedDates.some(dateStr => dateStr === `${year}-${('0' + (month + 1)).slice(-2)}-${('0' + date).slice(-2)}`)) {
                                const stamp = document.createElement('div');
                                stamp.classList.add('stamp');
                                cell.appendChild(stamp);
                            }
            
                            date++;
                        }
            
                        row.appendChild(cell);
                    }
            
                    tbody.appendChild(row);
                }
            
                // カレンダーの月と年を更新
                document.getElementById('monthYear').textContent = `${year}年${month + 1}月`;
            }
    
            // 祝日の判定関数（国民の祝日法に基づいて祝日を判定）
            function isHoliday(year, month, date) {
                const holidays = {
                    // 1月
                    1: [1], // 元日
                    // 2月
                    2: [11], // 建国記念日
                    // 3月
                    3: [20], // 春分の日（2021年から）
                    // 4月
                    4: [29], // 昭和の日
                    // 5月
                    5: [3, 4, 5], // 憲法記念日、みどりの日、こどもの日
                    // 7月
                    7: [23], // 海の日（2020年から）
                    // 8月
                    8: [8], // 山の日（2016年から）
                    // 9月
                    9: [23], // 秋分の日（2021年から）
                    // 11月
                    11: [3], // 文化の日
                    // 12月
                    12: [23], // 天皇誕生日
                };
    
                return holidays[month + 1] && holidays[month + 1].includes(date);
            }
    
            // 現在の年と月を取得
            const today = new Date();
            let currentYear = today.getFullYear();
            let currentMonth = today.getMonth();
    
            createCalendar(currentYear, currentMonth);
    
            // 前の月へ移動するボタン
            document.getElementById('prev').addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                createCalendar(currentYear, currentMonth);
            });
    
            // 次の月へ移動するボタン
            document.getElementById('next').addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                createCalendar(currentYear, currentMonth);
            });
    </script>
</div>

<div style="margin-bottom: 20px;"></div>

<div class="bg-white py-6 sm:py-6 lg:py-6 shadow-md rounded-md p-4">
  <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
    <!-- text - start -->
    <div class="mb-2 md:mb-2">
      <h2 class="text-left text-2xl font-bold text-gray-800 lg:text-3xl">〇月〇日</h2>
      <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">〇㎏</h2>
    </div>
    <!-- text - end -->

    <!-- form - start -->
    <div class="mx-auto grid max-w-screen-md gap-4 sm:flex sm:flex-wrap sm:justify-between md:flex md:flex-wrap md:justify-between">

      <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
        <label for="body_fat" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">体脂肪率</label>
        <input id="body_fat" name="body-fat" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
      </div>

      <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
        <label for="sleep_hours" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">睡眠時間</label>
        <input id="sleep_hours" name="sleep-hours" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
      </div>
      
      <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
        <label for="calorie-intake" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">合計摂取カロリー</label>
        <input id="calorie-intake" name="calorie-intake" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
      </div>

      <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
        <label for="calorie-burn" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">合計運動消費カロリー</label>
        <input id="calorie-burn" name="calorie-burn" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
      </div>

    </div>
    <!-- form - end -->
    
    <!-- Memo -->
    <div class="mt-2">
      <label for="memo" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">メモ</label><br>
      <textarea id="memo" name="memo" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"></textarea>
    </div>
    
  </div>
</div>



    
</x-app-layout>