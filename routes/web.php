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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function() {
//     return view('health_managements.profile');
// });


// プロフィール表示画面のルート
Route::get('/profile', [Health_Management_Controller::class, 'showProfile'])->name('profile.show');


// Route::get('/', function() {
//     return view('health_managements.profile_setting');
// });

// Route::get('/', function() {
//      return view('health_managements.meal');
// });

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
