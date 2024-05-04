<!DOCTYPE html>
<x-app-layout>
    <!-- Styles -->
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
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
            <h2 class="mb-4 text-2xl font-semibold leading-tight text-center">お気に入り追加</h2>
            <form action={{ route('movement.favoriteadd', ['id' => $movement->id]) }} method="POST">
                @csrf
                @method('PUT')
                <label for="record_type">運動種目:</label>
                <input type="text" id="record_type" name="record_type" value="{{ $movement->record_type }}" required>
                
                <label for="record_weight">錘の重量(kg):</label>
                <input type="number" id="record_weight" name="record_weight" value="{{ $movement->record_weight }}" required>
                
                <label for="record_times">挙上回数(Reps):</label>
                <input type="number" id="record_times" name="record_times" value="{{ $movement->record_times }}" required>
                
                <label for="record_sets">セット数:</label>
                <input type="number" id="record_sets" name="record_sets" value="{{ $movement->record_sets }}" required>
                
                <label for="record_movement_times">運動時間(min):</label>
                <input type="number" id="record_movement_times" name="record_movement_times" value="{{ $movement->record_movement_times }}" required>
                
                <label for="movement_consumption_cal">運動消費カロリー(kcal):</label>
                <input type="number" id="movement_consumption_cal" name="movement_consumption_cal" value="{{ $movement->movement_consumption_cal }}" required>
                
                <input type="submit" value="追加する">
            </form>
            <div class="m-3">
                <button onclick="location.href='/myprofile/movement'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
            </div>
        </div>
        
</x-app-layout>
