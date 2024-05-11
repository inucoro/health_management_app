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
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="time"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin: 5px 0 20px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Sleeping Records</h2>
        <form action="/myprofile/sleeping/sleeping_record" method="POST">
            @csrf
            <label for="record_bedtime">就寝時間:</label>
            <input type="time" id="record_bedtime" name="record_bedtime" required>
            
            <label for="record_wake_up_time">起床時間:</label>
            <input type="time" id="record_waka_up_time" name="record_wake_up_time" required>
            
            <label for="record_sleeping_memo">メモ:</label>
            <textarea id="record_sleeping_memo" name="record_sleeping_memo" placeholder="メモを入力してください"></textarea>
            
            <input type="submit" value="記録する">
        </form>
        <div class="m-3">
            <button onclick="location.href='/myprofile/sleeping'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form[action="/myprofile/sleeping/sleeping_record"]'); // フォームのIDを取得
    
            form.addEventListener('submit', function() {
                // ローカルストレージから情報を削除
                localStorage.removeItem('hideMessage_sleeping');
            });
        });
    </script>

</x-app-layout>
