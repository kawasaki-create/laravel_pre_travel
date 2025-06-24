<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the maximum number of login attempts allowed.
     *
     * @return int
     */
    protected function maxAttempts()
    {
        return config('auth.login_rate_limit', 5);
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    protected function decayMinutes()
    {
        return 1;
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey($request)
    {
        return strtolower($request->input('email')).'|'.$request->ip();
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function login(Request $request)
    {
        $this->validateLogin($request);

        // レート制限チェック
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            // ログイン成功時の処理
            $user = Auth::user();
            
            // ログイン履歴更新
            $user->last_login_at = now();
            $user->last_login_os = \App\Models\User::OS_WEB;
            $user->save();

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // ログイン失敗時、試行回数を増やす
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
