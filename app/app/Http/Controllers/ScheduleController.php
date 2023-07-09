<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TravelPlan;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;

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
        $travel_plan->id = $request->input('travel_plan_id');
        $travel_plan->trip_title = $request->input('trip-title');
        $travel_plan->trip_start = $date;
        $travel_plan->trip_end = $request->input('trip-end');
        $travel_plan->meet_place = $request->input('meet-place');
        $travel_plan->departure_time = sprintf('%s %s', $date, $time);
        $travel_plan->budget = $request->input('budget');
        $travel_plan->user_id = auth()->user()->id; 
        $travel_plan->save();


        // 保存後のリダイレクトなどの処理を行う

        return redirect('/home')->with('success', '新しい旅行プランを追加しました');
    }

    public function allPlan()
    {
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

        return view('all_plan',[
            'travelPlans' => $travelPlans,
        ]);
    }

}
