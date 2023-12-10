<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\HttpFoundation\Response;

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
}