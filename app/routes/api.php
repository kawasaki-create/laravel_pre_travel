<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\MobileHomeController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisterController::class, 'register']); // ユーザー登録
Route::post('/login', [LoginController::class, 'login']); // ログイン

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 試し書き。ログインしているユーザーの情報を返す。あとで消す
Route::middleware('auth:api')->get('/uuu', [App\Http\Controllers\api\MobileHomeController::class, 'uuu']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/test-user', [App\Http\Controllers\api\MobileHomeController::class, 'index'])->name('index');
