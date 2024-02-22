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

class LoginController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->only('email', 'password');

        if(auth()->attempt($credentials)) {

            $user = auth()->user();
            $token = $user->createToken('token')->accessToken;
            return ['token' => $token];

        }

        return response([
            'message' => 'Unauthenticated.'
        ], 401);

    }

    public function forgot(Request $request)
    {
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