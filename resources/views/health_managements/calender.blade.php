<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Improved Calendar</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f5f5f5;
    }
    h2 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    td:hover {
        background-color: #e0e0e0;
        cursor: pointer;
    }
    .btn-container {
        text-align: center;
        margin-top: 20px;
    }
    .btn {
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
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
</style>
</head>
<body>

<h2>カレンダー</h2>

<div class="btn-container">
    <button class="btn" id="prev">前の月</button>
    <button class="btn" id="next">次の月</button>
</div>

<table id="calendar">
    <thead>
        <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    // カレンダーの日付データを作成する関数
    function createCalendar(year, month) {
        const tbody = document.querySelector('#calendar tbody');
        tbody.innerHTML = ''; // 一旦tbodyを空にする

        const lastDay = new Date(year, month + 1, 0).getDate(); // 月の最終日を取得
        const firstDayOfWeek = new Date(year, month, 1).getDay(); // 月の最初の曜日を取得

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
                    cell.textContent = date;

                    // 日曜日と土曜日、祝日のスタイルを適用
                    if (j === 0) {
                        cell.classList.add('sunday');
                    } else if (j === 6) {
                        cell.classList.add('saturday');
                    }

                    if (isHoliday(year, month, date)) {
                        cell.classList.add('holiday');
                    }

                    date++;
                }

                row.appendChild(cell);
            }

            tbody.appendChild(row);
        }
    }

    // 祝日の判定関数（ここではサンプルとして3日と23日を祝日としています）
    function isHoliday(year, month, date) {
        return (month === 0 && date === 1) || // 元日
               (month === 2 && date === 3) || // ひな祭り
               (month === 4 && date === 5) || // こどもの日
               (month === 11 && date === 23); // 天皇誕生日
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

</body>
</html>