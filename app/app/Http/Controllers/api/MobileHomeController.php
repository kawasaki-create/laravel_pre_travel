<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MobileHomeController extends Controller
{
    public function index(Request $request)
    {
        // トークンを取得
        $accessToken = $request->bearerToken();

        // トークンがない場合やユーザーが見つからない場合はエラーレスポンスを返す
        if (!$accessToken || !$user = Auth::guard('api')->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ここで必要な処理を実行する（例えば、他のデータを返したり、処理を実行したり）

        return response()->json([
            'message' => 'Welcome to the API',
            'user_id' => $user->id,
            'email' => $user->email,
        ]);
    }
}
