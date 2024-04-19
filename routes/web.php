<?php

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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// プロフィール表示画面のルート
Route::get('/profile', [Profile_Controller::class, 'showProfile'])->name('profile.show');

// プロフィール設定画面のルート
Route::get('/profile/profile_setting', [Profile_Controller::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/profile_setting', [Profile_Controller::class, 'updatedProfile'])->name('profile.updated');



// 食事画面のルート
Route::get('/profile/meal', [Meal_Controller::class, 'showMeal'])->name('meal.show');

// 食事記録画面のルート
Route::get('/profile/meal/meal_record', [Meal_Controller::class, 'createMeal'])->name('create.meal');
Route::post('/profile/meal/meal_record', [Meal_Controller::class, 'storeMeal'])->name('store.meal');

//食事編集画面のルート
Route::get('/profile/meal/edit_meal/{id}', [Meal_Controller::class, 'editMeal'])->name('meal.edit');
Route::put('/profile/meal/edit_meal/{id}', [Meal_Controller::class, 'updateMeal'])->name('meal.update');

//食事記録消去のルート
Route::delete('/profile/meal/{meal}', [Meal_Controller::class, 'deleteMeal'])->name('meal.delete');



// 運動画面のルート
Route::get('/profile/movement', [Movement_Controller::class, 'showMovement'])->name('movement.show');

// 運動記録画面のルート
Route::get('/profile/movement/movement_record', [Movement_Controller::class, 'createMovement'])->name('create.movement');
Route::post('/profile/movement/movement_record', [Movement_Controller::class, 'storeMovement'])->name('store.movement');

//運動編集画面のルート
Route::get('/profile/movement/edit_movement/{id}', [Movement_Controller::class, 'editMovement'])->name('movement.edit');
Route::put('/profile/movement/edit_movement/{id}', [Movement_Controller::class, 'updateMovement'])->name('movement.update');

//運動記録消去のルート
Route::delete('/profile/movement/{movement}', [Movement_Controller::class, 'deleteMovement'])->name('movement.delete');



// 体重画面のルート
Route::get('/profile/body_weight', [Body_weight_Controller::class, 'showBody_weight'])->name('body_weight.show');

// 体重記録画面のルート
Route::get('/profile/body_weight/body_weight_record', [Body_weight_Controller::class, 'createBody_weight'])->name('create.body_weight');
Route::post('/profile/body_weight/body_weight_record', [Body_weight_Controller::class, 'storeBody_weight'])->name('store.body_weight');

//体重編集画面のルート
Route::get('/profile/body_weight/edit_body_weight/{id}', [Body_weight_Controller::class, 'editBody_weight'])->name('body_weight.edit');
Route::put('/profile/body_weight/edit_body_weight/{id}', [Body_weight_Controller::class, 'updateBody_weight'])->name('body_weight.update');

//体重記録消去のルート
Route::delete('/profile/body_weight/{body_weight}', [Body_weight_Controller::class, 'deleteBody_weight'])->name('body_weight.delete');



// 睡眠画面のルート
Route::get('/profile/sleeping', [Sleeping_Controller::class, 'showSleeping'])->name('sleeping.show');

// 睡眠記録画面のルート
Route::get('/profile/sleeping/sleeping_record', [Sleeping_Controller::class, 'createSleeping'])->name('create.sleeping');
Route::post('/profile/sleeping/sleeping_record', [Sleeping_Controller::class, 'storeSleeping'])->name('store.sleeping');

//睡眠編集画面のルート
Route::get('/profile/sleeping/edit_sleeping/{id}', [Sleeping_Controller::class, 'editSleeping'])->name('sleeping.edit');
Route::put('/profile/sleeping/edit_sleeping/{id}', [Sleeping_Controller::class, 'updateSleeping'])->name('sleeping.update');

//睡眠記録消去のルート
Route::delete('/profile/sleeping/{sleeping}', [Sleeping_Controller::class, 'deleteSleeping'])->name('sleeping.delete');



// カレンダー表示画面のルート
Route::get('/profile/calender', function() {
    return view('health_managements.calender');
});
