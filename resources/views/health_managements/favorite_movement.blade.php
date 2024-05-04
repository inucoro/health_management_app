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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
        
    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-800">
    	<h2 class="mb-4 text-2xl font-semibold leading-tight">Favorite Movement Table</h2>
    	<div class="overflow-x-auto">
    		<table class="min-w-full text-xs">
    			<colgroup>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col>
    				<col class="w-24">
    			</colgroup>
    			<thead class="dark:bg-gray-300">
    				<tr class="text-left">
    					<th class="p-3">運動種目</th>
    					<th class="p-3">錘の重量(kg)</th>
    					<th class="p-3">挙上回数(Reps)</th>
    					<th class="p-3">セット数</th>
    					<th class="p-3">運動時間(min)</th>
    					<th class="p-3">運動消費カロリー(kcal)</th>
    					<th class="p-3">削除</th>
    					<th class="p-3">記録</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($favorite_movements as $favorite_movement)
                    <tr class="border-b border-opacity-20 dark:border-gray-300 dark:bg-gray-50">
                        <td class="text-center">{{ $favorite_movement->favorite_type }}</td>
                        <td class="text-center">{{ $favorite_movement->favorite_weight }}</td>
                        <td class="text-center">{{ $favorite_movement->favorite_times }}</td>
                        <td class="text-center">{{ $favorite_movement->favorite_sets }}</td>
                        <td class="text-center">{{ $favorite_movement->favorite_movement_times }}</td>
                        <td class="text-center">{{ $favorite_movement->favorite_movement_consumption_cal }}</td>
                        <td class="text-center">
                            <div>
                                <form action="/myprofile/movement/favorite_movement/{{ $favorite_movement->id }}" class="form_{{ $favorite_movement->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteFavoritemovement({{ $favorite_movement->id }})" class="shadow-lg px-2 py-1  bg-red-500 text-white font-semibold rounded  hover:bg-red-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">削除</button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('movement.favoritesave') }}" method="POST">
                                @csrf
                                <!-- お気に入りメニューの情報を送信 -->
                                <input type="hidden" name="favorite_type" value="{{ $favorite_movement->favorite_type }}">
                                <input type="hidden" name="favorite_weight" value="{{ $favorite_movement->favorite_weight }}">
                                <input type="hidden" name="favorite_times" value="{{ $favorite_movement->favorite_times }}">
                                <input type="hidden" name="favorite_sets" value="{{ $favorite_movement->favorite_sets }}">
                                <input type="hidden" name="favorite_movement_times" value="{{ $favorite_movement->favorite_movement_times }}">
                                <input type="hidden" name="favorite_movement_consumption_cal" value="{{ $favorite_movement->favorite_movement_consumption_cal }}">
                                <input type="submit" value="記録" class="shadow-lg px-2 py-1  bg-blue-500 text-white font-semibold rounded  hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">
                            </form>
                        </td>
                    </tr>
                    @endforeach
    			</tbody>
    		</table>

            <div class='paginate'>
                {{ $favorite_movements->links() }}
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="m-3">
                <button onclick="location.href='/myprofile/movement'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
            </div>
        </div>
    </div>
    
    <script>
        function deleteFavoritemovement(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                const testEl = document.getElementById(id);
                document.querySelector(`.form_${id}`).submit();
            }
        }
    </script>

</x-app-layout>
