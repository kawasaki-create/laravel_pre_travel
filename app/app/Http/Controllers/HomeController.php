<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\TravelPlan;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;

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

        $userId = Auth::id();
        $travelPlans = TravelPlan::where('user_id', $userId)
        ->get()
        ->map(function ($travelPlan) {
            $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
            $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');
            $travelPlan->trip_start = $formatted_start;
            $travelPlan->trip_end = $formatted_end;
            return $travelPlan;
    });
        $userId = Auth::id();
        $tweets = Tweet::where('user_id', $userId)
        ->get();

        return view('home',[
            'hello' => $hello,
            'nya' => $nya,
            'travelPlans' => $travelPlans,
            'tweets' => $tweets
        ]);
    }

    public function handleClick(Request $request)
    {
        $tweet = new Tweet;
        $tweet->tweet = $request->input('tweet');
        $tweet->user_id = auth()->user()->id;
        $tweet->save();

        // 保存後のリダイレクトなどの処理を行う
        return redirect()->back()->with('success', 'つぶやきを保存しました！');
    }

    public function tweetDelete(Request $request)
    {
        $selectedTweets = $request->input('tweets');
        if (!empty($selectedTweets)) {
            Tweet::whereIn('id', $selectedTweets)->delete();
        }

        // 削除後のリダイレクトなどの処理を行う
        return redirect('/home')->with('success', 'つぶやきを削除しました！');
    }

    public function allTweetDelete(Request $request)
    {
        $selectedTweets = $request->input('tweets');
        if (!empty($selectedTweets)) {
            Tweet::whereIn('id', $selectedTweets)->delete();
        }

        // 削除後のリダイレクトなどの処理を行う
        return redirect('/home/all_tweet')->with('success', 'つぶやきを削除しました！');
    }

    public function allTweet()
    {
        $userId = Auth::id();
        $tweets = Tweet::where('user_id', $userId)
        ->get()
        ->map(function ($tweet) {
            $formatted_updated = Carbon::parse($tweet->updated_at)->format('Y-m-d');
            $tweet->updated_at = $formatted_updated;
            return $tweet;
        });

        return view('all_tweet',[
            'tweets' => $tweets,
        ]);
    }

    public function renewTweet(Request $request)
    {
        dd($request);exit;

        $url = $_SERVER['REQUEST_URI'];
        $id = ltrim(strrchr("$url", "/"), '/');

        $tweet = Tweet::find($id);
        $tweet->tweet = $request->input('tweet');
        $tweet->user_id = auth()->user()->id;
        $tweet->save();

        // 保存後のリダイレクトなどの処理を行う
        return redirect()->back()->with('success', 'つぶやきを保存しました！');
    }

}
