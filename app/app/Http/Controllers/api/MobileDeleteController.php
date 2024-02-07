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

class MobileDeleteController extends Controller
{
    // 旅行プラン削除
    public function deleteTravelPlan(Request $request)
    {
        Log::info($request);
        try {
            TravelPlan::where('id', $request->id)->delete();
            Log::info('旅行プランID：' . $request->id . 'を削除しました');
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'TravelPlan deleted failed']);
        }
    }

    // つぶやきを追加する
    public function deleteTweet(Request $request)
    {
        Log::info($request);
        try {
            $tweet = new Tweet;
            $tweet->travel_plan_id = $request->travelPlanId;
            $tweet->tweet = $request->tweet;
            $tweet->user_id = $request->user_id;
            $tweet->save();
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Tweet added failed']);
        }
    }

    // つぶやきを追加する
    public function deleteBelongings(Request $request)
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

    // 旅行詳細を削除する
    public function deleteDetail(Request $request)
    {
        Log::info($request);
        try {
            TravelDetail::where('id', $request->id)->delete();
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Belongings added failed']);
        }
    }
}
