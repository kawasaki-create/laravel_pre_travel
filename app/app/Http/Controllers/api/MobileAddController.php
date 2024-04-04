<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Belonging;
use App\Models\TravelDetail;
use App\Models\TravelPlan;
use App\Models\Tweet;
use App\Models\Contact;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\{ContactToAdminSendMail, ContactToUserSendMail};

class MobileAddController extends Controller
{
    // 旅行プラン一覧返す
    public function addTravelPlan(Request $request)
    {
        // リクエストデータの整形
        $startDate = substr((string)$request->tripStart,0,10). ' ' . substr((string)$request->tripStart,11,8);
        $endDate = substr((string)$request->tripEnd,0,10). ' ' . substr((string)$request->tripEnd,11,8);
        $departureTime = substr((string)$request->tripStart,0,10). ' ' . substr((string)$request->departureTime,0,5). ':00';

        // リクエストデータをログに記録
        // Log::info($request);
        // $s = DateTime::createFromFormat('Y-m-d H:i:s', $startDate);
        // Log::info($s);
        // Log::info($endDate);
        // Log::info($departureTime);

        // データベースへの保存など、他の処理をここで実行
        try {
            $travelPlan = new TravelPlan;
            $travelPlan->trip_title = $request->tripTitle;
            $travelPlan->trip_start = DateTime::createFromFormat('Y-m-d H:i:s', $startDate);
            $travelPlan->trip_end = DateTime::createFromFormat('Y-m-d H:i:s', $endDate);
            $travelPlan->meet_place = $request->meetPlace;
            $travelPlan->departure_time = DateTime::createFromFormat('Y-m-d H:i:s', $departureTime);
            $travelPlan->budget = $request->budget;
            $travelPlan->user_id = $request->user_id;
            $travelPlan->save();
        } catch(\Exception $e) {
            Log::info($e);
            return response()->json(['message' => 'Travel plan added failed']);
        }
        return response()->json(['message' => 'Travel plan added successfully']);
    }

    // つぶやきを追加する
    public function addTweet(Request $request)
    {
        Log::info($request);
        try {
            $tweet = new Tweet;
            $tweet->travel_plan_id = $request->travelPlanId;
            $tweet->tweet = $request->tweet;
            $tweet->user_id = $request->user_id;
            $tweet->editFlg = $request->editFlg;
            $tweet->save();
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Tweet added failed']);
        }
    }

    // 持ち物を追加する
    public function addBelongings(Request $request)
    {
        Log::info($request);
        try {
            $belongings = new Belonging();
            $belongings->travel_plan_id = $request->travelPlanId;
            $belongings->contents = $request->contents;
            $belongings->save();
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Belongings added failed']);
        }
    }

    // 旅行詳細を追加する(いくとこ)
    public function addDetail(Request $request)
    {
        $tf = (string)$request->date . ' ' . $request->time_from . ':00';
        $tt = (string)$request->date . ' ' . $request->time_to . ':00';
        Log::info($request);
        try {
            $details = new TravelDetail();
            $details->travel_plan_id = $request->travelPlanId;
            $details->contents = $request->contents;
            $details->price = null;
            $details->date = $request->date;
            $details->kubun = $request->kubun;
            $details->time_from = $tf;
            $details->time_to = $tt;
            $details->save();
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'TravelDetail added failed']);
        }
    }

    // 旅行詳細を追加する(いくとこ以外)
    public function addDetail18(Request $request)
    {
        Log::info($request);
        try {
            $details = new TravelDetail();
            $details->travel_plan_id = $request->travelPlanId;
            $details->contents = $request->contents;
            $details->price = $request->price;
            $details->date = $request->date;
            $details->kubun = $request->kubun;
            $details->time_from = null;
            $details->time_to = null;
            $details->save();
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'TravelDetail added failed']);
        }
    }

    // お問い合わせメッセージを追加する
    public function addContact(Request $request)
    {
        Log::info($request);
        $user_id = $request->user()->id;
        try {
            $contact = new Contact();
            $contact->user_id = $user_id;
            $contact->message = $request->content;
            $contact->name = $request->name;

            // Userテーブルからemailを取得して代入する
            $user = User::findOrFail($user_id);
            $contact->email = $user->email;

            $contact->save();

            // メール送信
            Mail::send(new ContactToAdminSendMail($request->name, $user->email, $request->content));
            Mail::send(new ContactToUserSendMail($request->name, $user->email, $request->content));
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Contact added failed']);
        }
    }

    //　有料会員登録したとき、開発者に誰が登録したかメールを送信する
    public function sendMailToMe(Request $request)
    {
        Log::info($request);
        $user_id = $request->user()->id;
        try {
            $user = User::findOrFail($user_id);
            Mail::send(new VipRegisterNoticeToAdminSendMail($user->name, $user->email));
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Send mail failed']);
        }
    }
}
