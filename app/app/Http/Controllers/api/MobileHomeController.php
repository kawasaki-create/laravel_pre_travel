<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MobileHomeController extends Controller
{
    //
    public function index()
    {
        $accessToken = Auth::user()->createToken('TokenName')->accessToken;

        return response()->json([
            'message' => 'Welcome to the API',
            'access_token' => $accessToken,
        ]);
    }
}
