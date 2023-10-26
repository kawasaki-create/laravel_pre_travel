<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TravelPlan;
use App\Models\TravelDetail;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;
use DatePeriod;

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

        return redirect('/home')->with('success', '新しい旅行プランを追加しました！');
    }

    public function editPlan(Request $request)
    {
        $date = $request->input('trip-start');
        $time = $request->input('departure-time');

        $travel_plan = TravelPlan::find($request->input('plan-id'));
        // dd($travel_plan);
        $travel_plan->id = $request->input('plan-id');
        $travel_plan->trip_title = $request->input('trip-title');
        $travel_plan->trip_start = $date;
        $travel_plan->trip_end = $request->input('trip-end');
        $travel_plan->meet_place = $request->input('meet-place');
        $travel_plan->departure_time = sprintf('%s %s', $date, $time);
        $travel_plan->budget = $request->input('budget');
        $travel_plan->user_id = auth()->user()->id;
        $travel_plan->save();


        // 保存後のリダイレクトなどの処理を行う

        return redirect('/schedule/all_plan')->with('success', '旅行プランを編集しました！');
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

    public function edit($id)
    {
        // 予定のIDを取得して編集画面に渡す例
        $travelPlan = TravelPlan::find($id);

        // 編集画面のビューにデータを渡す
        return view('schedule_edit', compact('travelPlan'));

    }

    public function delete($id)
    {
        TravelPlan::where('id', $id)->delete();

        return redirect('/schedule/all_plan')->with('success', '予定を削除しました！');
    }

    public function detail($id)
    {
        $travelPlan = TravelPlan::find($id);
        $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
        $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');
        // dd($travelDetails->where('kubun', 1)->pluck('contents'));

        $contents1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1)->get();
        // $contents1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1)->pluck('contents');
        $contents2 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 2)->get();
        $contents3 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 3)->get();
        $contents4 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 4)->get();
        $contents5 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 5)->get();
        $contents6 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 6)->get();
        $contents7 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 7)->get();
        $contents8 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 8)->get();
        $contents9 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 9)->get();
        $contents10 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 10)->get();

        $price1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1)->sum('price');
        $price2 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 2)->sum('price');
        $price3 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 3)->sum('price');
        $price4 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 4)->sum('price');
        $price5 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 5)->sum('price');
        $price6 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 6)->sum('price');
        $price7 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 7)->sum('price');
        $price8 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 8)->sum('price');
        $price9 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 9)->sum('price');
        $price10 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 10)->sum('price');

        $totalPrice = 0;
        // dd($price4);


        $timesCnt = TravelDetail::where('travel_plan_id', $id)->where('kubun', 9)->count();
        $timeFroms[] = [];
        $timeToes[] = [];
        $timeContents[] = [];
        $times = TravelDetail::where('travel_plan_id', $id)
            ->where('kubun', 9)
            ->orderBy('time_from', 'asc')
            ->get();
        foreach ($times as $time) {
            $timeFroms[] = substr($time->time_from, 11, 5);
            $timeToes[] = substr($time->time_to, 11, 5);
            $timeContents[] = $time->contents;
        }

        $travelDate = TravelDetail::where('travel_plan_id', $id)
        ->where('kubun', 9)
        ->orderBy('date', 'asc')
        ->get();
        // dd($timeFroms);

        $start = new DateTime($formatted_start);
        $end = new DateTime($formatted_end);

        $interval = new DateInterval('P1D'); // 1日ごとに増加
        $period = new DatePeriod($start, $interval, $end);
        $dateCount = 1;


        foreach ($period as $date) {
            $dateCount ++;
        }

        $start = new DateTime($formatted_start);
        $end = new DateTime($formatted_end);

        $interval = new DateInterval('P1D'); // 1日ごとに増加
        $period = new DatePeriod($start, $interval, $end->modify('+1 day'));
        $displayDays = []; // 日付を格納する配列
        foreach ($period as $date) {
            $displayDays[] = $date->format('Y-m-d'); // 日付を配列に追加
        }

        $today = new DateTime();
        foreach ($displayDays as $date) {
            // 現在の日付と配列内の日付が一致する場合は表示フラグをtrueにする
            $displayFlags[$date] = $today->format('Y-m-d') === $date;
        }

        return view('schedule_detail', [
            'travelPlan' => $travelPlan,
            'formatted_start' => $formatted_start,
            'formatted_end' => $formatted_end,
            'dateCount' => $dateCount,
            'displayDays' => $displayDays,
            'displayFlags' => $displayFlags,
            // 'detailList' => $detailList,
            'timesCnt' => $timesCnt,
            'timeFroms' => $timeFroms,
            'timeToes' => $timeToes,
            'timeContents' => $timeContents,
            // ここからは旅費
            'contents1' => $contents1,
            'contents2' => $contents2,
            'contents3' => $contents3,
            'contents4' => $contents4,
            'contents5' => $contents5,
            'contents6' => $contents6,
            'contents7' => $contents7,
            'contents8' => $contents8,
            'contents9' => $contents9,
            'contents10' => $contents10,
            'price1' => $price1,
            'price2' => $price2,
            'price3' => $price3,
            'price4' => $price4,
            'price5' => $price5,
            'price6' => $price6,
            'price7' => $price7,
            'price8' => $price8,
            'price9' => $price9,
            'price10' => $price10,
            'totalPrice' => $totalPrice,
            'travelDate' => $travelDate,
        ]);
    }

    public function detailNew(Request $request)
    {
        $travelPlanId = $request->travel_plan_id;
        $travelDate = $request->travelDate;
        $travelPlan = TravelPlan::find($travelPlanId);
        // $travelDetail = new TravelDetail;
        // $travelDetail->travel_plan_id = $request->input('travel_plan_id');
        // $travelDetail->date = $request->input('travelDate');
        // $travelDetail->contents = $request->input('contents');
        // $travelDetail->kubun = $request->input('kubun');
        // $travelDetail->price = $request->input('price');
        // $travelDetail->time = $request->input('time');
        // $travelDetail->save();

        return view('travel_detail_new',[
            'travelPlanId' => $travelPlanId,
            'travelDate' => $travelDate,
            'travelPlan' => $travelPlan
        ]);
    }

    public function detailEdit(Request $request)
    {
        $travelPlanId = $request->travel_plan_id;
        $travelDate = $request->travelDate;
        $travelPlan = TravelPlan::find($travelPlanId);
        $id = $request->input('travel_plan_id');

        $times = TravelDetail::where('travel_plan_id', $id)
            ->where('kubun', 9)
            ->orderBy('time_from', 'asc')
            ->get();
        foreach ($times as $time) {
            $timeFroms[] = substr($time->time_from, 11, 5);
            $timeToes[] = substr($time->time_to, 11, 5);
            $timeContents[] = $time->contents;
        }

        $contents1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1)->get();
        $contents2 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 2)->get();
        $contents3 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 3)->get();
        $contents4 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 4)->get();
        $contents5 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 5)->get();
        $contents6 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 6)->get();
        $contents7 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 7)->get();
        $contents8 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 8)->get();
        $contents9 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 9)->get();
        $contents10 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 10)->get();

        return view('travel_detail_edit',[
            'travelPlanId' => $travelPlanId,
            'travelDate' => $travelDate,
            'travelPlan' => $travelPlan,
            'contents1' => $contents1,
            'contents2' => $contents2,
            'contents3' => $contents3,
            'contents4' => $contents4,
            'contents5' => $contents5,
            'contents6' => $contents6,
            'contents7' => $contents7,
            'contents8' => $contents8,
            'contents9' => $contents9,
            'contents10' => $contents10,
            'timeFroms' => $timeFroms,
            'timeToes' => $timeToes,
            'timeContents' => $timeContents,
        ]);
    }

    public function detailNR(Request $request)
    {
        $timeCnt = $request->input('timeCnt');

        if($request->input('contents1') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 1)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents1'))
            ->where('price', $request->input('price1'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 1;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents1');
                $travelDetail->price = $request->input('price1');
                $travelDetail->save();
            }
        }

        if($request->input('contents2') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 2)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents2'))
            ->where('price', $request->input('price2'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 2;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents2');
                $travelDetail->price = $request->input('price2');
                $travelDetail->save();
            }
        }

        if($request->input('contents3') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 3)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents3'))
            ->where('price', $request->input('price3'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 3;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents3');
                $travelDetail->price = $request->input('price3');
                $travelDetail->save();
            }
        }

        if($request->input('contents4') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 4)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents4'))
            ->where('price', $request->input('price4'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 4;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents4');
                $travelDetail->price = $request->input('price4');
                $travelDetail->save();
            }
        }

        if($request->input('contents5') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 5)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents5'))
            ->where('price', $request->input('price5'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 5;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents5');
                $travelDetail->price = $request->input('price5');
                $travelDetail->save();
            }
        }

        if($request->input('contents6') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 6)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents6'))
            ->where('price', $request->input('price6'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 6;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents6');
                $travelDetail->price = $request->input('price6');
                $travelDetail->save();
            }
        }

        if($request->input('contents7') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 7)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents7'))
            ->where('price', $request->input('price7'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 7;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents7');
                $travelDetail->price = $request->input('price7');
                $travelDetail->save();
            }
        }

        if($request->input('contents8') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 8)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents8'))
            ->where('price', $request->input('price8'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 8;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents8');
                $travelDetail->price = $request->input('price8');
                $travelDetail->save();
            }
        }

        if($request->input('contents9') !== null) {
            // 既に存在するデータを検索
            $existingData = TravelDetail::where('kubun', 10)
            ->where('travel_plan_id', $request->input('travel_plan_id'))
            ->where('date', $request->input('travelDate'))
            ->where('contents', $request->input('contents10'))
            ->where('price', $request->input('price10'))
            ->first();

            if(!$existingData) {
                $travelDetail = new TravelDetail;
                $travelDetail->kubun = 10;
                $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                $travelDetail->date = $request->input('travelDate');
                $travelDetail->contents = $request->input('contents10');
                $travelDetail->price = $request->input('price10');
                $travelDetail->save();
            }
        }

        if($request->input('going-1') !== null) {
            for($i = 0; $i < $timeCnt; $i ++){
                $travelDetail = new TravelDetail;
                // 既に存在するデータを検索
                $existingData = TravelDetail::where('kubun', 9)
                ->where('travel_plan_id', $request->input('travel_plan_id'))
                ->where('date', $request->input('travelDate'))
                ->where('contents', $request->input('going-' . strval($i + 1)))
                ->where('time_from', $request->input('travelDate') .' '. $request->input('time-from-' . strval($i + 1)) . ':' . '00')
                ->where('time_to', $request->input('travelDate') .' '. $request->input('time-to-' . strval($i + 1)) . ':' . '00')
                ->first();

                if(!$existingData) {
                    $travelDetail->kubun = 9;
                    $travelDetail->travel_plan_id = $request->input('travel_plan_id');
                    $travelDetail->date = $request->input('travelDate');
                    $travelDetail->contents = $request->input('going-' . strval($i + 1));
                    $travelDetail->time_from = $travelDetail->date .' '. $request->input('time-from-' . strval($i + 1)) . ':' . '00';
                    $travelDetail->time_to = $travelDetail->date .' '. $request->input('time-to-' . strval($i + 1)) . ':' . '00';
                    $travelDetail->save();
                }
            }
        }
        return redirect('/schedule/all_plan')->with('success', '旅行の詳細を追加しました！');
    }
}
