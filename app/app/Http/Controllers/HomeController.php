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
            'travelPlans' => $travelPlans
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
