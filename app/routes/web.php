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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/schedule', [App\Http\Controllers\ScheduleController::class, 'index']);
Route::post('/home/post', [App\Http\Controllers\HomeController::class, 'handleClick'])->name('button.click');
Route::post('/schedule/register', [App\Http\Controllers\ScheduleController::class, 'addPlan'])->name('travel.click');
Route::post('/schedule/change', [App\Http\Controllers\ScheduleController::class, 'editPlan'])->name('travel.edit');
Route::post('/tweets/delete', [App\Http\Controllers\HomeController::class, 'tweetDelete'])->name('tweets.delete');
Route::get('/schedule/all_plan', [App\Http\Controllers\ScheduleController::class, 'allPlan']);
Route::get('/schedule/edit/{id}', [App\Http\Controllers\ScheduleController::class, 'edit'])->name('schedule.edit');
Route::get('/schedule/delete/{id}', [App\Http\Controllers\ScheduleController::class, 'delete'])->name('schedule.delete');
Route::get('/home/all_tweet', [App\Http\Controllers\HomeController::class, 'allTweet']);
Route::post('/home/all_tweet/delete', [App\Http\Controllers\HomeController::class, 'allTweetDelete'])->name('allTweets.delete');
Route::get('/home/editedtweet/register/{id}', [App\Http\Controllers\HomeController::class, 'renewTweet']);
Route::get('/schedule/detail/{id}', [App\Http\Controllers\ScheduleController::class, 'detail'])->name('schedule.detail');
Route::post('/schedule/detail/new/{travel_plan_id}/{date}', [App\Http\Controllers\ScheduleController::class, 'detailNew'])->name('schedule.detailNew');
Route::post('/schedule/detail/edit/{travel_plan_id}/{date}', [App\Http\Controllers\ScheduleController::class, 'detailEdit'])->name('schedule.detailEdit');