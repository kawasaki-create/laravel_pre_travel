<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request) {
        $start_time = microtime(true);
        
        // バリデーション
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|max:255',
            'loginOS' => 'nullable|string|max:10',
            'vipFlg' => 'nullable|string|max:1'
        ]);

        if ($validator->fails()) {
            // 認証失敗時と同じ時間を確保してタイミング攻撃を防ぐ
            $this->ensureFixedResponseTime($start_time);
            return response([
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        // レート制限 (1分間に5回まで)
        $key = 'login_attempts:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->ensureFixedResponseTime($start_time);
            return response([
                'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.'
            ], 429);
        }

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Userモデルを取得
            $userModel = \App\Models\User::find($user->id);
    
            // last_login_os,vip_flgの更新
            $userModel->last_login_os = $request->loginOS;
            $userModel->vip_flg = $request->vipFlg;
            $userModel->save();
    
            $token = $user->createToken('token')->accessToken;
            
            // 成功時はレート制限をクリア
            RateLimiter::clear($key);
            
            $this->ensureFixedResponseTime($start_time);
            return ['token' => $token];
        }

        // 失敗時はレート制限カウンターを増加
        RateLimiter::hit($key, 60);
        
        $this->ensureFixedResponseTime($start_time);
        return response([
            'message' => 'Unauthenticated.'
        ], 401);
    }

    /**
     * 一定の応答時間を確保してタイミング攻撃を防ぐ
     */
    private function ensureFixedResponseTime($start_time, $target_time = 0.5) {
        $elapsed = microtime(true) - $start_time;
        if ($elapsed < $target_time) {
            usleep(($target_time - $elapsed) * 1000000);
        }
    }

    public function forgot(Request $request)
    {
        Log::info($request);
        // パスワードリセットメールを送信するための処理
        try{
            $response = $this->sendResetLinkEmail($request);
            Log::info($response);
        } catch(\Exception $e) {
            Log::error($e);
        }
        return $response;
    }

}