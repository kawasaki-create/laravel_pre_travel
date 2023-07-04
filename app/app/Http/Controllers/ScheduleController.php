<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPlan;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function addPlan(Request $request)
    {
        $date = $request->input('trip-start');
        $time = $request->input('departure-time');

        $travel_plan = new TravelPlan; 
        $travel_plan->trip_title = $request->input('trip-title');
        $travel_plan->trip_start = $date;
        $travel_plan->trip_end = $request->input('trip-end');
        $travel_plan->meet_place = $request->input('meet-place');
        $travel_plan->departure_time = sprintf('%s %s', $date, $time);
        $travel_plan->budget = $request->input('budget');
        $travel_plan->user_id = auth()->user()->id; 
        $travel_plan->save();


        // 保存後のリダイレクトなどの処理を行う

        return redirect('/home')->with('success', 'travel_plan saved successfully');
    }
}
