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

        $tripCnt = 0;
        $duplicatedIdList = [];
        $duplicatedTitleList = [];
        foreach($travelPlans as $travelPlan) {
            if($travelPlan->trip_start < date('Y-m-d H:i:s') && date('Y-m-d H:i:s') < $travelPlan->trip_end) {
                $tripCnt++;
                $duplicatedIdList[] = $travelPlan->id;
                $duplicatedTitleList[] = $travelPlan->trip_title;
            }
        }

        return view('home',[
            'hello' => $hello,
            'nya' => $nya,
            'travelPlans' => $travelPlans,
            'tweets' => $tweets,
            'tripCnt' => $tripCnt,
            'duplicatedIdList' => $duplicatedIdList,
            'duplicatedTitleList' => $duplicatedTitleList
        ]);
    }

    public function handleClick(Request $request)
    {
        $tweet = new Tweet;
        $tweet->tweet = $request->input('tweet');
        $tweet->user_id = auth()->user()->id;
        $tweet->travel_plan_id = $request->input('duplicatedTravel');
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

    public function renewTweet()
    {
        $url = $_SERVER['REQUEST_URI'];
        $cid = ltrim(strrchr("$url", "/"), '/');
        $id = mb_substr( $cid , 0 , mb_strpos($cid, "?tweetContent=") );

        $encodeNewTweet = ltrim(strrchr("$url", "="), '=');
        $newTweet = urldecode($encodeNewTweet);

        $tweet = Tweet::find($id);
        $tweet->tweet = $newTweet;
        $tweet->user_id = auth()->user()->id;
        $tweet->editFlg = 1;
        $tweet->save();

        // 保存後のリダイレクトなどの処理を行う
        return redirect()->back()->with([
            'success'=> 'つぶやきを更新しました！',
        ]);
    }

}
