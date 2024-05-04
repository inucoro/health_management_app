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
    	<h2 class="mb-4 text-2xl font-semibold leading-tight">Favorite Meal Table</h2>
    	<div class="overflow-x-auto">
    		<table class="min-w-full text-xs">
    			<colgroup>
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
    					<th class="p-3">メニュー</th>
    					<th class="p-3">カロリー(kcal)</th>
    					<th class="p-3">タンパク質(g)</th>
    					<th class="p-3">脂質(g)</th>
    					<th class="p-3">炭水化物(g)</th>
    					<th class="p-3">削除</th>
    					<th class="p-3">記録</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($favorite_meals as $favorite_meal)
                    <tr class="border-b border-opacity-20 dark:border-gray-300 dark:bg-gray-50">
                        <td class="text-center">{{ $favorite_meal->favorite_menu }}</td>
                        <td class="text-center">{{ $favorite_meal->favorite_cal }}</td>
                        <td class="text-center">{{ $favorite_meal->favorite_protein }}</td>
                        <td class="text-center">{{ $favorite_meal->favorite_fat }}</td>
                        <td class="text-center">{{ $favorite_meal->favorite_carbo }}</td>
                        <td class="text-center">
                            <div>
                                <form action="/myprofile/meal/favorite_meal/{{ $favorite_meal->id }}" id="form_{{ $favorite_meal->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteFavoritemeal({{ $favorite_meal->id }})" class="shadow-lg px-2 py-1  bg-red-500 text-white font-semibold rounded  hover:bg-red-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">削除</button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('meal.favoritesave') }}" method="POST">
                                @csrf
                                <!-- お気に入りメニューの情報を送信 -->
                                <input type="hidden" name="favorite_menu" value="{{ $favorite_meal->favorite_menu }}">
                                <input type="hidden" name="favorite_cal" value="{{ $favorite_meal->favorite_cal }}">
                                <input type="hidden" name="favorite_protein" value="{{ $favorite_meal->favorite_protein }}">
                                <input type="hidden" name="favorite_fat" value="{{ $favorite_meal->favorite_fat }}">
                                <input type="hidden" name="favorite_carbo" value="{{ $favorite_meal->favorite_carbo }}">
                                <input type="submit" value="記録" class="shadow-lg px-2 py-1  bg-blue-500 text-white font-semibold rounded  hover:bg-blue-700 hover:shadow-sm hover:translate-y-0.5 transform transition ">
                            </form>
                        </td>
                    </tr>
                    @endforeach
    			</tbody>
    		</table>
            <div class='paginate'>
                {{ $favorite_meals->links() }}
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="m-3">
                <button onclick="location.href='/myprofile/meal'" class="px-3 py-1  bg-blue-500 text-s text-white font-semibold rounded-full hover:bg-blue-700">戻る</button>
            </div>
        </div>
    </div>
        
    <script>
        function deleteFavoritemeal(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>

</x-app-layout>
