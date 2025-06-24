<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;

class GuestAuthController extends Controller
{
    /**
     * ゲストユーザーの認証（新規作成または既存取得）
     */
    public function authenticate(Request $request)
    {
        $start_time = microtime(true);
        
        // バリデーション
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string|max:100',
            'app_version' => 'nullable|string|max:20',
            'platform' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            $this->ensureFixedResponseTime($start_time);
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        // レート制限 (1分間に10回まで)
        $key = 'guest_auth:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            $this->ensureFixedResponseTime($start_time);
            return response()->json([
                'message' => 'Too many authentication attempts. Please try again in ' . $seconds . ' seconds.'
            ], 429);
        }

        try {
            $deviceId = $request->device_id;
            $appVersion = $request->app_version;
            $platform = $request->platform ?? 'mobile';

            // 既存のゲストユーザーを確認
            $existingGuest = GuestUser::findByDeviceId($deviceId);
            
            if ($existingGuest && $existingGuest->isValid()) {
                // 既存の有効なゲストユーザーがある場合は有効期限を延長
                $existingGuest->extendExpiration();
                
                $this->ensureFixedResponseTime($start_time);
                return response()->json([
                    'token' => $existingGuest->token,
                    'guest_id' => $existingGuest->id,
                    'expires_at' => $existingGuest->expires_at->toISOString(),
                    'message' => 'Existing guest session extended.',
                ], 200);
            }

            // 新しいゲストユーザーを作成
            $guestUser = GuestUser::createForDevice($deviceId, $appVersion, $platform);

            // 成功時はレート制限をクリア
            RateLimiter::clear($key);

            $this->ensureFixedResponseTime($start_time);
            return response()->json([
                'token' => $guestUser->token,
                'guest_id' => $guestUser->id,
                'expires_at' => $guestUser->expires_at->toISOString(),
                'message' => 'Guest user created successfully.',
            ], 201);

        } catch (\Exception $e) {
            // 失敗時はレート制限カウンターを増加
            RateLimiter::hit($key, 60);
            
            $this->ensureFixedResponseTime($start_time);
            return response()->json([
                'message' => 'Guest authentication failed.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * ゲストトークンの有効性を確認
     */
    public function verify(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'message' => 'Token not provided.'
            ], 401);
        }

        $guestUser = GuestUser::findByValidToken($token);
        
        if (!$guestUser) {
            return response()->json([
                'message' => 'Invalid or expired token.'
            ], 401);
        }

        return response()->json([
            'valid' => true,
            'guest_id' => $guestUser->id,
            'expires_at' => $guestUser->expires_at->toISOString(),
            'remaining_days' => $guestUser->expires_at->diffInDays(Carbon::now()),
        ]);
    }

    /**
     * ゲストユーザーから正式ユーザーへの移行
     */
    public function migrateToUser(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'message' => 'Guest token not provided.'
            ], 401);
        }

        $guestUser = GuestUser::findByValidToken($token);
        
        if (!$guestUser) {
            return response()->json([
                'message' => 'Invalid or expired guest token.'
            ], 401);
        }

        // バリデーション
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // 新しい正式ユーザーを作成
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'register_os' => 'mobile',
                'last_login_os' => 'mobile',
                'last_login_at' => Carbon::now(),
                'vip_flg' => '0',
            ]);

            // ゲストユーザーのデータを正式ユーザーに移行
            $this->transferGuestData($guestUser, $user);

            // ゲストユーザーを削除
            $guestUser->delete();

            // 正式ユーザーのトークンを生成
            $userToken = $user->createToken('auth')->accessToken;

            return response()->json([
                'token' => $userToken,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'message' => 'Successfully migrated to regular user.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Migration failed.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * ゲストユーザーのデータを正式ユーザーに移行
     */
    private function transferGuestData(GuestUser $guestUser, \App\Models\User $user)
    {
        // 旅行プランの移行
        \App\Models\TravelPlan::where('guest_user_id', $guestUser->id)
            ->update(['user_id' => $user->id, 'guest_user_id' => null]);

        // 他のゲスト関連データも同様に移行
        // 必要に応じて他のテーブルの移行処理を追加
    }

    /**
     * 期限切れゲストユーザーのクリーンアップ
     */
    public function cleanup()
    {
        try {
            $expiredCount = GuestUser::cleanupExpired();
            $inactiveCount = GuestUser::cleanupInactive(60); // 60日間非アクティブ

            return response()->json([
                'message' => 'Cleanup completed.',
                'expired_deleted' => $expiredCount,
                'inactive_deleted' => $inactiveCount,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Cleanup failed.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * ゲストユーザー統計情報
     */
    public function stats()
    {
        try {
            $stats = GuestUser::getStats();
            
            return response()->json([
                'stats' => $stats,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get stats.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * 一定の応答時間を確保してタイミング攻撃を防ぐ
     */
    private function ensureFixedResponseTime($start_time, $target_time = 0.3)
    {
        $elapsed = microtime(true) - $start_time;
        if ($elapsed < $target_time) {
            usleep(($target_time - $elapsed) * 1000000);
        }
    }
}