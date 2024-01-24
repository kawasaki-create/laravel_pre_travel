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
}
