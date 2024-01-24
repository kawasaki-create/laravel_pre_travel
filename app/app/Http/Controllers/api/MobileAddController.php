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

class MobileAddController extends Controller
{
    // 旅行プラン一覧返す
    public function addTravelPlan(Request $request)
    {
        // リクエストデータをログに記録
        \Log::info('Received request data:', ['data' => $request->all()]);

        // データベースへの保存など、他の処理をここで実行

        return response()->json(['message' => 'Travel plan added successfully']);
    }
}
