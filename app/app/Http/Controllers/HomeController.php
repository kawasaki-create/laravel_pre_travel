<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hello = 'HELLO!';
        $nya = 222;
        return view('home',[
            'hello' => $hello,
            'nya' => $nya
        ]);
    }

    public function handleClick(Request $request)
    {
        $tweet = new Tweet;
        $tweet->tweet = $request->input('tweet');
        $tweet->user_id = auth()->user()->id; 
        $tweet->save();


        // 保存後のリダイレクトなどの処理を行う

        return redirect()->back()->with('success', 'Tweet saved successfully');
    }
}
