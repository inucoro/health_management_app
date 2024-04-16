<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Health_management_Controller;

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
Route::get('/profile', [Health_Management_Controller::class, 'showProfile'])->name('profile.show');

// プロフィール設定画面のルート
Route::get('/profile/profile_setting', [Health_Management_Controller::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/profile_setting', [Health_Management_Controller::class, 'updatedProfile'])->name('profile.updated');


// Route::get('/', function() {
//      return view('health_managements.meal');
// });

// 食事画面のルート

// Route::get('/', function() {
//      return view('health_managements.meal_record');
// });

// Route::get('/', function() {
//      return view('health_managements.movement');
// });

// Route::get('/', function() {
//      return view('health_managements.movement_record');
// });

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
