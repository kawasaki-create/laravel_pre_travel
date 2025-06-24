<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 広告視聴完了を記録
     */
    public function recordAdView(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            $user->recordAdView();

            return response()->json([
                'success' => true,
                'message' => '広告視聴を記録しました。24時間プレミアム機能をお楽しみください！',
                'premium_until' => $user->last_ad_view->addHours(24)->format('Y-m-d H:i:s'),
                'today_ad_count' => $user->getTodayAdCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'エラーが発生しました。'
            ], 500);
        }
    }

    /**
     * プレミアム状態を確認
     */
    public function checkPremiumStatus()
    {
        $user = User::find(Auth::id());
        
        return response()->json([
            'is_premium' => $user->isPremiumUser(),
            'has_web_premium' => $user->hasWebPremium(),
            'is_vip' => $user->vip_flg == 1,
            'can_create_plan' => $user->canCreatePlan(),
            'today_ad_count' => $user->getTodayAdCount(),
            'premium_until' => $user->hasWebPremium() ? 
                $user->last_ad_view->addHours(24)->format('Y-m-d H:i:s') : null
        ]);
    }

    /**
     * プレミアム案内ページ
     */
    public function showPremiumModal()
    {
        $user = User::find(Auth::id());
        
        return view('components.premium-modal', [
            'user' => $user
        ]);
    }
}