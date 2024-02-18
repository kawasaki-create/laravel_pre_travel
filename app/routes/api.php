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

// ログインしているユーザーの情報を返す
Route::middleware('auth:api')->get('/travel-plan', [App\Http\Controllers\api\MobileHomeController::class, 'travelPlan']);
Route::middleware('auth:api')->get('/belongings', [App\Http\Controllers\api\MobileHomeController::class, 'belongings']);
Route::middleware('auth:api')->get('/belongings-wos', [App\Http\Controllers\api\MobileHomeController::class, 'belongingsWoStart']);
Route::middleware('auth:api')->get('/tweet', [App\Http\Controllers\api\MobileHomeController::class, 'tweet']);
Route::middleware('auth:api')->get('/check-verified', [App\Http\Controllers\api\MobileHomeController::class, 'checkVerified']);
Route::middleware('auth:api')->get('/tweet-detail', [App\Http\Controllers\api\MobileHomeController::class, 'tweetDetail']);
Route::middleware('auth:api')->get('/travel-detail', [App\Http\Controllers\api\MobileHomeController::class, 'travelDetail']);
Route::middleware('auth:api')->get('/get-uid', [App\Http\Controllers\api\MobileHomeController::class, 'getUid']);
Route::middleware('auth:api')->post('/add-travel-plan', [App\Http\Controllers\api\MobileAddController::class, 'addTravelPlan']);
Route::middleware('auth:api')->post('/add-tweet', [App\Http\Controllers\api\MobileAddController::class, 'addTweet']);
Route::middleware('auth:api')->post('/add-belongings', [App\Http\Controllers\api\MobileAddController::class, 'addBelongings']);
Route::middleware('auth:api')->post('/add-detail', [App\Http\Controllers\api\MobileAddController::class, 'addDetail']);
Route::middleware('auth:api')->post('/add-detail18', [App\Http\Controllers\api\MobileAddController::class, 'addDetail18']);
Route::middleware('auth:api')->post('/delete-detail', [App\Http\Controllers\api\MobileDeleteController::class, 'deleteDetail']);
Route::middleware('auth:api')->post('/delete-plan', [App\Http\Controllers\api\MobileDeleteController::class, 'deleteTravelPlan']);
Route::middleware('auth:api')->post('/delete-belongings', [App\Http\Controllers\api\MobileDeleteController::class, 'deleteBelongings']);
Route::middleware('auth:api')->post('/delete-tweet', [App\Http\Controllers\api\MobileDeleteController::class, 'deleteTweet']);
Route::middleware('auth:api')->post('/edit-travel-plan', [App\Http\Controllers\api\MobileEditController::class, 'editTravelPlan']);
Route::middleware('auth:api')->post('/edit-tweet', [App\Http\Controllers\api\MobileEditController::class, 'editTweet']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/test-user', [App\Http\Controllers\api\MobileHomeController::class, 'index'])->name('index');
