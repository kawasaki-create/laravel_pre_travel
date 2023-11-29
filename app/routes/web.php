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
})->name('index');

//Auth::routes();
// メール認証を使うため引数を増やす
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
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
Route::post('/schedule/detail/new/register', [App\Http\Controllers\ScheduleController::class, 'detailNR'])->name('schedule.detailNR');
Route::post('/schedule/detail/edit/register', [App\Http\Controllers\ScheduleController::class, 'detailER'])->name('schedule.detailER');
Route::post('/schedule/detail/delete', [App\Http\Controllers\ScheduleController::class, 'detailDelete'])->name('schedule.detailDelete');
Route::get('/email', [App\Http\Controllers\HomeController::class, 'email']);
Route::get('/home/account_delete', [App\Http\Controllers\MailSendController::class, 'AccountDeleteSend']);
Route::get('/register_send', [App\Http\Controllers\MailSendController::class, 'registerSend']);
Route::get('/deleted/{id}', [App\Http\Controllers\HomeController::class, 'AccountDeleted'])->name('deleted');
Route::get('/home/change_mail', [App\Http\Controllers\HomeController::class, 'changeAddress']);
Route::post('/home/change_mail/ok', [App\Http\Controllers\HomeController::class, 'changeAddressOK'])->name('mail.change');
Route::get('/schedule/belongings/{id}', [App\Http\Controllers\ScheduleController::class, 'belongings'])->name('schedule.belongings');
Route::post('/schedule/belongings_register', [App\Http\Controllers\ScheduleController::class, 'belongings_register'])->name('schedule.belongings_register');
Route::post('/schedule/belongings_delete', [App\Http\Controllers\ScheduleController::class, 'belongingsDelete'])->name('schedule.belongings_delete');
Route::get('/home/contact', [App\Http\Controllers\HomeController::class, 'contact']);
Route::post('/home/contact_send', [App\Http\Controllers\HomeController::class, 'contactSend'])->name('contact.send');
Route::post('/home/contact_confirm', [App\Http\Controllers\HomeController::class, 'contactConfirm'])->name('contact.comfirm');