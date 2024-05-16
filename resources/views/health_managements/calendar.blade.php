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
        .clicked {
            background-color: #D3D3D3; /* 灰色 */
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
    </div>

    <div style="margin-bottom: 20px;"></div>


    <!-- ステータス表示エリア -->
    @if(isset($todaycalendarRecord)) <!-- $todaycalendarRecordがセットされている場合のみ表示 -->
        <div id="statusArea">
            <div class="bg-white py-6 sm:py-6 lg:py-6 shadow-lg rounded-lg p-4">
                <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                    <!-- text - start -->
                    <div class="mb-6 md:mb-6">
                        <h2 class="text-left text-2xl font-bold text-gray-800 lg:text-3xl">{{ \Carbon\Carbon::parse($todaycalendarRecord->date)->format('Y/n/j') }}</h2> <!-- 日付表示 -->
                        <h2 class="text-center text-2xl font-bold text-gray-800 lg:text-3xl">
                            <span class="text-5xl">{{ $todaycalendarRecord->record_body_weight }}</span>
                            <span class="text-2xl">kg</span>
                        </h2> <!-- 体重表示 -->
                    </div>
                    <!-- text - end -->
        
                    <div class="mx-auto grid max-w-screen-md gap-4 sm:flex sm:flex-wrap sm:justify-between md:flex md:flex-wrap md:justify-between">
                        
                        <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                            <label for="body_fat" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">体脂肪率(％)</label>
                            <div id="body_fat" name="body-fat" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                {{ $todaycalendarRecord->record_body_fat }}
                            </div>
                        </div>
                    
                        <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                            <label for="sleep_hours" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">睡眠時間(hours)</label>
                            <div id="sleep_hours" name="sleep-hours" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                {{ $todaycalendarRecord->record_sleeping_time }}
                            </div>
                        </div>
                    
                        <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                            <label for="calorie-intake" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">摂取カロリー(kcal)</label>
                            <div id="calorie-intake" name="calorie-intake" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                {{ $todaycalendarRecord->ingestion_cal }}
                            </div>
                        </div>
                    
                        <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                            <label for="calorie-burn" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">運動消費カロリー(kcal)</label>
                            <div id="calorie-burn" name="calorie-burn" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                {{ $todaycalendarRecord->sum_movement_consumption_cal }}
                            </div>
                        </div>
                    
                    </div>
        
                    <!-- Memo -->
                    <div class="mt-2">
                        <label for="memo" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">メモ</label><br>
                        <textarea id="memo" name="memo" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">{{ $todaycalendarRecord->record_calendar_memo }}</textarea>
                        <div class="mt-2 text-right"> <!-- ここにtext-rightクラスを追加 -->
                            <button id="saveMemoBtn" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition">保存</button>
                        </div>  
                    </div>
        
                </div>
            </div>
        </div>
    @endif
    
    
    <!-- jQueryをCDNから読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        const recordedDates = {!! json_encode($recordedDates) !!};
        let clickedDate = ''; // クリックされた日付を保存する大域変数
    
        function isCurrentMonth(year, month, date) {
            const today = new Date();
            return year === today.getFullYear() && month === today.getMonth() && date === today.getDate();
        }
    
        function createCalendar(year, month) {
            const tbody = document.querySelector('#calendar tbody');
            tbody.innerHTML = '';
    
            const lastDay = new Date(year, month + 1, 0).getDate();
            const firstDayOfWeek = new Date(year, month, 1).getDay();
    
            let date = 1;
    
            for (let i = 0; i < 6; i++) {
                const row = document.createElement('tr');
    
                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement('td');
    
                    if (i === 0 && j < firstDayOfWeek) {
                        cell.textContent = '';
                    } else if (date > lastDay) {
                        break;
                    } else {
                        const dateText = document.createElement('div');
                        dateText.textContent = date;
                        dateText.classList.add('date');
                        cell.appendChild(dateText);
    
                        cell.dataset.date = `${year}-${('0' + (month + 1)).slice(-2)}-${('0' + date).slice(-2)}`; // 日付をdata属性に保存
    
                        cell.addEventListener('click', function(event) {
                            clickedDate = event.currentTarget.dataset.date; // クリックされた日付を大域変数に保存
                            fetchDailyRecord(clickedDate);
                        });
    
                        if (j === 0) {
                            cell.classList.add('sunday');
                        } else if (j === 6) {
                            cell.classList.add('saturday');
                        }
    
                        if (isHoliday(year, month, date)) {
                            cell.classList.add('holiday');
                        }
    
                        if (isCurrentMonth(year, month, date)) {
                            cell.classList.add('today');
                            cell.classList.add('bold');
                        }
    
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
    
            document.getElementById('monthYear').textContent = `${year}年${month + 1}月`;
        }
    
        function isHoliday(year, month, date) {
            const holidays = {
                1: [1],
                2: [11],
                3: [20],
                4: [29],
                5: [3, 4, 5],
                7: [23],
                8: [8],
                9: [23],
                11: [3],
                12: [23],
            };
    
            return holidays[month + 1] && holidays[month + 1].includes(date);
        }
    
        const today = new Date();
        let currentYear = today.getFullYear();
        let currentMonth = today.getMonth();
    
        createCalendar(currentYear, currentMonth);
    
        document.getElementById('prev').addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            createCalendar(currentYear, currentMonth);
        });
    
        document.getElementById('next').addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            createCalendar(currentYear, currentMonth);
        });
        
        function addSaveMemoEventListener() {
            const saveMemoBtn = document.getElementById('saveMemoBtn');
            if (saveMemoBtn) {
                saveMemoBtn.addEventListener('click', saveMemo);
            }
        }
        
        document.addEventListener("DOMContentLoaded", function() {
            addSaveMemoEventListener();
        });
        
        function fetchDailyRecord(clickedDate) {
            $.ajax({
                type: 'GET',
                url: '/myprofile/calendar',
                data: {
                    clickedDate: clickedDate
                },
                success: function(response) {
                    if (response) {
                        response.date = new Date(response.date).toLocaleDateString(); // 日付をフォーマットする
                        updateStatusArea(response);
                        addSaveMemoEventListener(); // レコードが取得された後にボタンのイベントを再設定する
                        
                        // クリックした日付のセルを灰色で塗りつぶす
                        const cells = document.querySelectorAll('td');
                        cells.forEach(cell => {
                            cell.classList.remove('clicked'); // すでにクリックされたセルがあれば、一旦クリックしたスタイルをリセットする
                        });
                        const clickedCell = document.querySelector(`td[data-date="${clickedDate}"]`);
                        clickedCell.classList.add('clicked');
                    } else {
                        clearStatusArea();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    
        function updateStatusArea(calendarRecord) {
            if (calendarRecord !== null) {
                document.getElementById('statusArea').innerHTML = `
                    <div class="bg-white py-6 sm:py-6 lg:py-6 shadow-lg rounded-lg p-4">
                        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                            <div class="mb-6 md:mb-6">
                                <h2 class="text-left text-2xl font-bold text-gray-800 lg:text-3xl">${calendarRecord.date}</h2>
                                <h2 class="text-center text-2xl font-bold text-gray-800 lg:text-3xl">
                                    <span class="text-5xl">${calendarRecord.record_body_weight}</span>
                                    <span class="text-2xl">kg</span>
                                </h2> <!-- 体重表示 -->
                            </div>
                            <div class="mx-auto grid max-w-screen-md gap-4 sm:flex sm:flex-wrap sm:justify-between md:flex md:flex-wrap md:justify-between">
                                <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                                    <label for="body_fat" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">体脂肪率(％)</label>
                                    <div id="body_fat" name="body-fat" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                        ${calendarRecord.record_body_fat}
                                    </div>
                                </div>
                                <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                                    <label for="sleep_hours" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">睡眠時間(hours)</label>
                                    <div id="sleep_hours" name="sleep-hours" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                        ${calendarRecord.record_sleeping_time}
                                    </div>
                                </div>
                                <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                                    <label for="calorie-intake" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">摂取カロリー(kcal)</label>
                                    <div id="calorie-intake" name="calorie-intake" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                        ${calendarRecord.ingestion_cal}
                                    </div>
                                </div>
                                <div class="sm:w-1/5 md:w-1/5 mb-4 sm:mb-0 md:mb-0">
                                    <label for="calorie-burn" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">運動消費カロリー(kcal)</label>
                                    <div id="calorie-burn" name="calorie-burn" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                        ${calendarRecord.sum_movement_consumption_cal}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="memo" class="mb-2 font-semibold inline-block text-sm text-gray-800 sm:text-base">メモ</label><br>
                                <textarea id="memo" name="memo" class="w-full rounded border border-gray-800 bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">${calendarRecord.record_calendar_memo}</textarea>
                                <div class="mt-2 text-right"> <!-- ここにtext-rightクラスを追加 -->
                                    <button id="saveMemoBtn" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition">保存</button>
                                </div>  
                            </div>
                        </div>
                    </div>
                `;
            }
        }
        
        function saveMemo() {
            // メモの内容を取得
            const memo = document.getElementById('memo').value;
            // クリックした日付がある場合はそれを、ない場合はデフォルトの今日の日付を取得
            const date = clickedDate || document.querySelector('.today').dataset.date;

            // メモを保存するリクエストを送信
            $.ajax({
                type: 'POST',
                url: '{{ route('calendar.saveMemo') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: date,
                    memo: memo
                },
                success: function(response) {
                    console.log(response.message);
                    // 成功した場合の処理
                    alert('メモが保存されました。'); // 成功メッセージの表示
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // エラーが発生した場合の処理
                    alert('メモの保存中にエラーが発生しました。'); // エラーメッセージの表示
                }
            });
        }
        
        document.getElementById('saveMemoBtn').addEventListener('click', saveMemo);
    
        function clearStatusArea() {
            document.getElementById('statusArea').innerHTML = '';
        }
    </script>
</x-app-layout>