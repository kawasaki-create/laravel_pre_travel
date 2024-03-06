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
use App\Mail\AccountDeleteSendMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

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
            Tweet::where('id', $request->id)->delete();
            Log::info('つぶやきID：' . $request->id . 'を削除しました');
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Tweet deleted failed']);
        }
    }

    // 持ち物を追加する
    public function deleteBelongings(Request $request)
    {
        Log::info($request);
        try {
            Belonging::where('id', $request->id)->delete();
            Log::info('持ち物ID：' . $request->id . 'を削除しました');
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'TravelPlan deleted failed']);
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

    // アカウントを削除する
    public function deleteAccount(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $urls = [
                'hi' => URL::temporarySignedRoute(
                    'deleted',
                    now()->addMinutes(5),  // 5分間だけ有効
                    ['id' => $id]
                ),
            ];
            Mail::send(new AccountDeleteSendMail($request, $urls));
            return response()->json(['message' => 'アカウント削除の確認用メールを送信しました。(5分以内にURLをクリックしてください。)']);
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Account deleted failed']);
        }

    }

    // アカウント以外を削除する(デモモード)
    public function deleteAllExceptAccount(Request $request)
    {
        $travelPlans = TravelPlan::where('user_id', $request->id)->get();
        Log::info($travelPlans);
        $belongings = Belonging::whereIn('travel_plan_id', $travelPlans->id)->get();
        $travelDetails = TravelDetail::whereIn('travel_plan_id', $travelPlans->id)->get();
        // Log::info(
        //     $travelPlans,
        //     $belongings,
        //     $travelDetails
        // );
        // ユーザーに関連するデータの削除
        // TravelDetail::where('travel_plan_id', $request)->delete();
        // Tweet::where('user_id', $request)->delete();
        // $travelPlans->delete();
        // $belongings->delete();

        return response()->json(['message' => 'アカウント以外のデータを削除しました']);
    }
}
