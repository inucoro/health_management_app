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
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Movement Records</h2>
        <form action="/myprofile/movement/movement_record" method="POST">
            @csrf
            <label for="record_type">運動の種目:</label>
            <input type="text" id="record_type" name="record_type" required>
            
            <label for="record_weight">重量 (kg):</label>
            <input type="number" id="record_weight" name="record_weight" required>
            
            <label for="record_times">挙上回数 (Reps):</label>
            <input type="number" id="record_times" name="record_times" required>
            
            <label for="record_sets">セット数:</label>
            <input type="number" id="record_sets" name="record_sets" required>
            
            <label for="record_movement_times">運動時間 (分):</label>
            <input type="number" id="record_movement_times" name="record_movement_times" required>
            
            <label for="movement_consumption_cal">運動消費カロリー (kcal):</label>
            <input type="number" id="movement_consumption_cal" name="movement_consumption_cal" required>
            
            <input type="submit" value="記録する">
        </form>
        <div class="m-3">
            <button onclick="location.href='/myprofile/movement'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form[action="/myprofile/movement/movement_record"]'); // フォームのIDを取得
    
            form.addEventListener('submit', function() {
                // ローカルストレージから情報を削除
                localStorage.removeItem('hideMessage_movement');
            });
        });
    </script>
</x-app-layout> 