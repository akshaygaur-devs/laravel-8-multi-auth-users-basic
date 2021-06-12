<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class,'showAdminLoginForm']);
Route::get('/login/builder_usr', [App\Http\Controllers\Auth\LoginController::class,'showBuilderUsrLoginForm']);
Route::get('/login/architect_usr', [App\Http\Controllers\Auth\LoginController::class,'showArchitectUsrLoginForm']);
Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/builder_usr', [App\Http\Controllers\Auth\RegisterController::class,'showBuilderUsrRegisterForm']);
Route::get('/register/architect_usr', [App\Http\Controllers\Auth\RegisterController::class,'showArchitectUsrRegisterForm']);

Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class,'adminLogin']);
Route::post('/login/builder_usr', [App\Http\Controllers\Auth\LoginController::class,'builderUsrLogin']);
Route::post('/login/architect_usr', [App\Http\Controllers\Auth\LoginController::class,'architectUsrLogin']);
Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class,'createAdmin']);
Route::post('/register/builder_usr', [App\Http\Controllers\Auth\RegisterController::class,'createBuilderUsr']);
Route::post('/register/architect_usr', [App\Http\Controllers\Auth\RegisterController::class,'createArchitectUsr']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin')->middleware('auth:admin');
Route::view('/builder_usr', 'builder_usr')->middleware('auth:builder_usr');
Route::view('/architect_usr', 'architect_usr')->middleware('auth:architect_usr');