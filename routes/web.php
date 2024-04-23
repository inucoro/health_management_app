<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile_Controller;
use App\Http\Controllers\Meal_Controller;
use App\Http\Controllers\Movement_Controller;
use App\Http\Controllers\Body_weight_Controller;
use App\Http\Controllers\Sleeping_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    
    // プロフィール表示画面のルート
    Route::get('/myprofile', [Profile_Controller::class, 'showProfile'])->name('myprofile.show');
    
    // プロフィール設定画面のルート
    Route::get('/myprofile/myprofile_setting', [Profile_Controller::class, 'updateProfile'])->name('myprofile.update');
    Route::put('/myprofile/myprofile_setting', [Profile_Controller::class, 'updatedProfile'])->name('myprofile.updated');
    
    
    
    // 食事画面のルート
    Route::get('/myprofile/meal', [Meal_Controller::class, 'showMeal'])->name('meal.show');
    
    // 食事記録画面のルート
    Route::get('/myprofile/meal/meal_record', [Meal_Controller::class, 'createMeal'])->name('create.meal');
    Route::post('/myprofile/meal/meal_record', [Meal_Controller::class, 'storeMeal'])->name('store.meal');
    
    //食事編集画面のルート
    Route::get('/myprofile/meal/edit_meal/{id}', [Meal_Controller::class, 'editMeal'])->name('meal.edit');
    Route::put('/myprofile/meal/edit_meal/{id}', [Meal_Controller::class, 'updateMeal'])->name('meal.update');
    
    //食事記録消去のルート
    Route::delete('/myprofile/meal/{meal}', [Meal_Controller::class, 'deleteMeal'])->name('meal.delete');
    
    //食事お気に入り画面のルート
    Route::get('/myprofile/meal/favorite_meal', [Meal_Controller::class, 'showfavoriteMeal'])->name('meal.favoriteshow');
    Route::get('/myprofile/meal/favorite_meal_record/{id}', [Meal_Controller::class, 'showrecordfavoriteMeal'])->name('meal.favoriterecordshow');
    Route::put('/myprofile/meal/favorite_meal_record/{id}', [Meal_Controller::class, 'addfavoriteMeal'])->name('meal.favoriteadd');
    Route::post('/myprofile/meal/favorite_meal', [Meal_Controller::class, 'savefavoriteMeal'])->name('meal.favoritesave');
     //食事お気に入り消去のルート
    Route::delete('/myprofile/meal/favorite_meal/{favorite_meal}', [Meal_Controller::class, 'deleteFavoritemeal'])->name('favoritemeal.delete');
    
    // 食事グラフ画面のルート
    Route::get('/myprofile/meal/meal_chart', [Meal_Controller::class, 'showMealchart'])->name('mealchart.show');
    Route::get('/get_meal_calorie_chart_data', [Meal_Controller::class, 'getMealCalorieChartData'])->name('mealcalorieschart.get');
    Route::get('/get_protein_chart_data', [Meal_Controller::class, 'getProteinChartData'])->name('mealproteinchart.get');
    Route::get('/get_fat_chart_data', [Meal_Controller::class, 'getFatChartData'])->name('mealfatchart.get');
    Route::get('/get_carbo_chart_data', [Meal_Controller::class, 'getCarboChartData'])->name('mealcarbochart.get');
    //目標値
    Route::get('/get_target_cal', [Meal_Controller::class, 'getTargetCalories'])->name('targetcal.get');
    Route::get('/get_target_protein', [Meal_Controller::class, 'getTargetProtein'])->name('targetprotein.get');
    Route::get('/get_target_fat', [Meal_Controller::class, 'getTargetFat'])->name('targetfat.get');
    Route::get('/get_target_carbo', [Meal_Controller::class, 'getTargetCarbo'])->name('targetcarbo.get');
    
    
    
    
    // 運動画面のルート
    Route::get('/myprofile/movement', [Movement_Controller::class, 'showMovement'])->name('movement.show');
    
    // 運動記録画面のルート
    Route::get('/myprofile/movement/movement_record', [Movement_Controller::class, 'createMovement'])->name('create.movement');
    Route::post('/myprofile/movement/movement_record', [Movement_Controller::class, 'storeMovement'])->name('store.movement');
    
    //運動編集画面のルート
    Route::get('/myprofile/movement/edit_movement/{id}', [Movement_Controller::class, 'editMovement'])->name('movement.edit');
    Route::put('/myprofile/movement/edit_movement/{id}', [Movement_Controller::class, 'updateMovement'])->name('movement.update');
    
    //運動記録消去のルート
    Route::delete('/myprofile/movement/{movement}', [Movement_Controller::class, 'deleteMovement'])->name('movement.delete');
    
    //運動お気に入り画面のルート
    Route::get('/myprofile/movement/favorite_movement', [Movement_Controller::class, 'showfavoriteMovement'])->name('movement.favoriteshow');
    Route::get('/myprofile/movement/favorite_movement_record/{id}', [Movement_Controller::class, 'showrecordfavoriteMovement'])->name('movement.favoriterecordshow');
    Route::put('/myprofile/movement/favorite_movement_record/{id}', [Movement_Controller::class, 'addfavoriteMovement'])->name('movement.favoriteadd');
    Route::post('/myprofile/movement/favorite_movement', [Movement_Controller::class, 'savefavoriteMovement'])->name('movement.favoritesave');
    
    //食事お気に入り消去のルート
    Route::delete('/myprofile/movement/favorite_movement/{favorite_movement}', [Movement_Controller::class, 'deleteFavoritemovement'])->name('favoritemovement.delete');
    
    
    
    // 体重画面のルート
    Route::get('/myprofile/body_weight', [Body_weight_Controller::class, 'showBody_weight'])->name('body_weight.show');
    
    // 体重記録画面のルート
    Route::get('/myprofile/body_weight/body_weight_record', [Body_weight_Controller::class, 'createBody_weight'])->name('create.body_weight');
    Route::post('/myprofile/body_weight/body_weight_record', [Body_weight_Controller::class, 'storeBody_weight'])->name('store.body_weight');
    
    //体重編集画面のルート
    Route::get('/myprofile/body_weight/edit_body_weight/{id}', [Body_weight_Controller::class, 'editBody_weight'])->name('body_weight.edit');
    Route::put('/myprofile/body_weight/edit_body_weight/{id}', [Body_weight_Controller::class, 'updateBody_weight'])->name('body_weight.update');
    
    //体重記録消去のルート
    Route::delete('/myprofile/body_weight/{body_weight}', [Body_weight_Controller::class, 'deleteBody_weight'])->name('body_weight.delete');
    
    // 体重グラフ画面のルート
    Route::get('/myprofile/body_weight/body_weight_chart', [Body_weight_Controller::class, 'showBody_weightchart'])->name('body_weightchart.show');
    Route::get('/get_body_weight_chart_data', [Body_weight_Controller::class, 'getBody_WeightChartData'])->name('body_weightchart.get');
    Route::get('/get_body_fat_chart_data', [Body_weight_Controller::class, 'getBody_FatChartData'])->name('body_fatchart.get');
    //目標値
    Route::get('/get_target_body_weight', [Body_weight_Controller::class, 'getTargetBody_weight'])->name('targetbody_weight.get');


    
    
    
    
    // 睡眠画面のルート
    Route::get('/myprofile/sleeping', [Sleeping_Controller::class, 'showSleeping'])->name('sleeping.show');
    
    // 睡眠記録画面のルート
    Route::get('/myprofile/sleeping/sleeping_record', [Sleeping_Controller::class, 'createSleeping'])->name('create.sleeping');
    Route::post('/myprofile/sleeping/sleeping_record', [Sleeping_Controller::class, 'storeSleeping'])->name('store.sleeping');
    
    //睡眠編集画面のルート
    Route::get('/myprofile/sleeping/edit_sleeping/{id}', [Sleeping_Controller::class, 'editSleeping'])->name('sleeping.edit');
    Route::put('/myprofile/sleeping/edit_sleeping/{id}', [Sleeping_Controller::class, 'updateSleeping'])->name('sleeping.update');
    
    //睡眠記録消去のルート
    Route::delete('/myprofile/sleeping/{sleeping}', [Sleeping_Controller::class, 'deleteSleeping'])->name('sleeping.delete');
    
    // 睡眠グラフ画面のルート
    Route::get('/myprofile/sleeping/sleeping_chart', [Sleeping_Controller::class, 'showSleepingchart'])->name('sleepingchart.show');
    Route::get('/get_sleeping_chart_data', [Sleeping_Controller::class, 'getSleepingChartData'])->name('sleepingchart.get');
    //目標値
    Route::get('/get_target_sleeping', [Sleeping_Controller::class, 'getTargetSleeping'])->name('targetsleeping.get');
    
    
    
    // カレンダー表示画面のルート
    Route::get('/myprofile/calender', function() {
        return view('health_managements.calender');
    });
});

