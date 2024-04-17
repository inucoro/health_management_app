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

// 運動画面のルート
Route::get('/profile/movement', [Movement_Controller::class, 'showMovement'])->name('movement.show');

// 運動記録画面のルート
Route::get('/profile/movement/movement_record', [Movement_Controller::class, 'createMovement'])->name('create.movement');
Route::post('/profile/movement/movement_record', [Movement_Controller::class, 'storeMovement'])->name('store.movement');


// Route::get('/', function() {
//      return view('health_managements.body_weight');
// });

// // Route::get('/', function() {
// //      return view('health_managements.body_weight_record');
// // });

// Route::get('/', function() {
//      return view('health_managements.sleeping');
// });

// Route::get('/', function() {
//      return view('health_managements.sleeping_record');
// });
