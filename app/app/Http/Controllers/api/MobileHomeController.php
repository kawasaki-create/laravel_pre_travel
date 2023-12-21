<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Belonging;
use App\Models\TravelPlan;

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

        return $belongings;
    }

}
