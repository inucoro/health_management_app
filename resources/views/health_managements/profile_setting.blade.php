<!DOCTYPE html>
<x-app-layout>   
    <section class="w-full p-6 dark:bg-gray-100 dark:text-gray-900">
    	<form action="/myprofile/myprofile_setting" method="POST" enctype="multipart/form-data" class="container flex flex-col mx-auto space-y-12">
    	    @csrf
            @method('PUT')
    		<fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm bg-white header">
    			<div class="space-y-2 col-span-full lg:col-span-1">
    				<p class="font-medium">プロフィール</p>
    				<p class="text-xs">あなたの現在の体型からアドバイスします。</p>
    			</div>
    			<div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
    					<label for="name" class="text-sm">名前</label>
    					<input id="name" name="name" type="text" placeholder="名前" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-3">
    					<label for="sex" class="text-sm">性別</label>
    					<input id="sex" name="sex" type="text" placeholder="性別" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-2">
    					<label for="height" class="text-sm">身長(cm)</label>
    					<input id="height" name="height" type="number" placeholder="身長(cm)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-2">
    					<label for="body_weight" class="text-sm">体重(kg)</label>
    					<input id="body_weight" name="body_weight" type="number" placeholder="体重(kg)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-2">
    					<label for="age" class="text-sm">年齢</label>
    					<input id="age" name="age" type="number" placeholder="年齢" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    			</div>
    		</fieldset>
    		<fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm bg-white header">
    			<div class="space-y-2 col-span-full lg:col-span-1">
    				<p class="font-medium">目標設定</p>
    				<p class="text-xs">あなたが目指す目標に応じて設定してください。</p>
    			</div>
    			<div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
    				<div class="col-span-full sm:col-span-3">
    					<label for="target_body_weight" class="text-sm">目標体重(kg)</label>
    					<input id="target_body_weight" name="target_body_weight" type="number" placeholder="目標体重(kg)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-3">
    					<label for="target_cal" class="text-sm">目標摂取カロリー(kcal)</label>
    					<input id="target_cal" name="target_cal" type="number" placeholder="目標摂取カロリー(kcal)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-2">
    					<label for="target_protein" class="text-sm">目標摂取タンパク質(g)</label>
    					<input id="target_protein" name="target_protein" type="number" placeholder="目標摂取タンパク質(g)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-2">
    					<label for="target_fat" class="text-sm">目標摂取脂質(g)</label>
    					<input id="target_fat" name="target_fat" type="number" placeholder="目標摂取脂質(g)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-2">
    					<label for="target_carbo" class="text-sm">目標摂取炭水化物(g)</label>
    					<input id="target_carbo" name="target_carbo" type="number" placeholder="目標摂取炭水化物(g)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-3">
    					<label for="target_movement_consumption_cal" class="text-sm">目標運動消費カロリー(kcal)</label>
    					<input id="target_movement_consumption_cal" name="target_movement_consumption_cal" type="number" placeholder="目標運動消費カロリー(kcal)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full sm:col-span-3">
    					<label for="target_sleeping_time" class="text-sm">目標睡眠時間(hours)</label>
    					<input id="target_sleeping_time" name="target_sleeping_time" type="number" placeholder="目標睡眠時間(hours)" class="w-full rounded-md focus:ring focus:ring-opacity-75 dark:text-gray-50 focus:dark:ring-violet-600 dark:border-gray-300">
    				</div>
    				<div class="col-span-full">
    					<label for="image" class="text-sm">プロフィール写真</label>
    					<div class="flex items-center space-x-2">
    						<img src="{{ Auth::user()->image_path }}" alt="画像が読み込めません" class="w-10 h-10 dark:bg-gray-500 rounded-full dark:bg-gray-300">
    						<input type="file" name="image">
    					</div>
    				</div>
    			</div>
    		</fieldset>
    		<div class="profile_info">
                <input type="submit" value="更新">
            </div>
            <div class="footer">
               <a href="/myprofile">戻る</a>
            </div>
    	</form>
    </section>
</x-app-layout>   
