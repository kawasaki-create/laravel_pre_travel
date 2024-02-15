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
use DateTime;
use Illuminate\Support\Facades\Log;

class MobileEditController extends Controller
{
    // 旅行プラン編集
    public function editTravelPlan(Request $request)
    {
        // リクエストデータの整形
        $startDate = substr((string)$request->tripStart,0,10). ' ' . substr((string)$request->tripStart,11,8);
        $endDate = substr((string)$request->tripEnd,0,10). ' ' . substr((string)$request->tripEnd,11,8);
        $departureTime = substr((string)$request->tripStart,0,10). ' ' . substr((string)$request->departureTime,0,5). ':00';

        // データベースへの保存など、他の処理をここで実行
        try {
            $travelPlan = TravelPlan::find($request->id);
            $travelPlan->trip_title = $request->tripTitle;
            $travelPlan->trip_start = DateTime::createFromFormat('Y-m-d H:i:s', $startDate);
            $travelPlan->trip_end = DateTime::createFromFormat('Y-m-d H:i:s', $endDate);
            $travelPlan->meet_place = $request->meetPlace;
            $travelPlan->departure_time = DateTime::createFromFormat('Y-m-d H:i:s', $departureTime);
            $travelPlan->budget = $request->budget;
            $travelPlan->user_id = $request->user_id;
            $travelPlan->save();
            Log::info('旅行プラン名：' . $request->trip_title . 'を編集しました');
        } catch(\Exception $e) {
            Log::info($e);
            return response()->json(['message' => 'Travel plan added failed']);
        }
        return response()->json(['message' => 'Travel plan added successfully']);        
    }

    // つぶやきを追加する
    public function editTweet(Request $request)
    {
        Log::info($request);
        try {
            $tweet = Tweet::find($request->id);
            $tweet->travel_plan_id = $request->travelPlanId;
            $tweet->tweet = $request->tweet;
            $tweet->user_id = $request->user_id;
            $tweet->editFlg = $request->editFlg;
            $tweet->save();
            Log::info('つぶやきID：' . $request->id . 'を編集しました');
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
}
