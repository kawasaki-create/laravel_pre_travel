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

    // 試し書き。後で消す
    public function uuu(Request $request) {
        $user_id = $request->user()->id;

        $travelPlan = TravelPlan::where('user_id', $user_id)->get();

        return $travelPlan;
    }

}
