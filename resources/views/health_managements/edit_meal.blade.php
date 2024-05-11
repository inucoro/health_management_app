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
        <h2 class="mb-4 text-3xl font-semibold leading-tight text-center">Edit Meal Records</h2>
        <form action="{{ route('meal.update', ['id' => $meal->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="record_menu">メニュー</label>
            <input type="text" id="record_menu" name="record_menu" value="{{ $meal->record_menu }}" required>
            <label for="record_cal">カロリー(kcal)</label>
            <input type="number" id="record_cal" name="record_cal" min="0" value="{{ $meal->record_cal }}" required>
            <label for="record_protein">タンパク質(g)</label>
            <input type="number" id="record_protein" name="record_protein" min="0" value="{{ $meal->record_protein }}" required>
            <label for="record_fat">脂質(g)</label>
            <input type="number" id="record_fat" name="record_fat" min="0" value="{{ $meal->record_fat }}" required>
            <label for="record_carbo">炭水化物(g)</label>
            <input type="number" id="record_carbo" name="record_carbo" min="0" value="{{ $meal->record_carbo }}" required>
            <input type="submit" value="更新する">
        </form>
        <div class="m-3">
            <button onclick="location.href='/myprofile/meal'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
        </div>
    </div>
 </x-app-layout>
