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
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
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
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Body Weight Records</h2>
        <form action="/myprofile/body_weight/body_weight_record" method="POST">
            @csrf
            <label for="record_body_weight">体重 (kg):</label>
            <input type="number" step="0.1" id="record_body_weight" name="record_body_weight" required>
            
            <label for="record_body_fat">体脂肪率 (%):</label>
            <input type="number" step="0.1" id="record_body_fat" name="record_body_fat" required>
            
            <label for="record_body_weight_memo">メモ:</label>
            <textarea id="record_body_weight_memo" name="record_body_weight_memo" placeholder="メモを入力してください"></textarea>
            
            <input type="submit" value="記録する">
        </form>
        <div class="m-3">
            <button onclick="location.href='/myprofile/body_weight'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form[action="/myprofile/body_weight/body_weight_record"]'); // フォームのIDを取得
    
            form.addEventListener('submit', function() {
                // ローカルストレージから情報を削除
                localStorage.removeItem('hideMessage_body_weight');
            });
        });
    </script>

</x-app-layout>   