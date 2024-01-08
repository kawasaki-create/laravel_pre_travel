<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Belonging;
use App\Models\TravelPlan;
use App\Models\Tweet;

class MobileHomeController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        $mail = User::where('id', $userId)->value('email');
        return response()->json([
            'message' => 'Welcome to the API',
            'user_id' => $userId,
            'email' => $mail,
        ]);
    }

    // 旅行プラン一覧返す
    public function travelPlan(Request $request)
    {
        $user_id = $request->user()->id;

        $travelPlan = TravelPlan::where('user_id', $user_id)->get();

        return $travelPlan;
    }

    // 持っていくもの一覧返す
    public function belongings(Request $request)
    {
        $user_id = $request->user()->id;

        $travelPlanId = TravelPlan::where('user_id', $user_id)->pluck('id');
        $belongings = Belonging::whereIn('travel_plan_id', $travelPlanId)->get();

        foreach($belongings as $row) {
            $belongingsId[] = $row->id;
            $travelPlanIds[] = $row->travel_plan_id;
            $contents[] = $row->contents;
            $tripStart[] = $row->travelPlan->trip_start;
            $tripEnd[] = $row->travelPlan->trip_end;
        }

        return response()->json([
            'belongingsId' => $belongingsId,
            'travelPlanId' => $travelPlanIds,
            'contents' => $contents,
            'tripStart' => $tripStart,
            'tripEnd' => $tripEnd,
        ]);
    }

     // つぶやき一覧返す
     public function tweet(Request $request)
     {
         $user_id = $request->user()->id;
 
         $travelPlanId = TravelPlan::where('user_id', $user_id)->pluck('id');
         $tweets = Tweet::whereIn('travel_plan_id', $travelPlanId)->get();
 
         foreach($tweets as $row) {
             $tweetId[] = $row->id;
             $travelPlanIds[] = $row->travel_plan_id;
             $tweet[] = $row->tweet;
             $tripStart[] = $row->travelPlan->trip_start;
             $tripEnd[] = $row->travelPlan->trip_end;
             $createdAt[] = $row->created_at;
             $editFlg[] = $row->editFlg;
         }
 
         return response()->json([
             'tweetId' => $tweetId,
             'travelPlanId' => $travelPlanIds,
             'tweet' => $tweet,
             'tripStart' => $tripStart,
             'tripEnd' => $tripEnd,
             'created_at' => $createdAt,
             'editFlg' => $editFlg
         ]);
     }
}
