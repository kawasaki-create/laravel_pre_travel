<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TravelPlan;
use App\Models\TravelDetail;
use App\Models\Tweet;
use App\Models\Belonging;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;
use DatePeriod;

class ScheduleController extends Controller
{
    public function index()
    {
        $travelPlanCount = TravelPlan::where('user_id', Auth::id())->count();
        $isVipUser = User::where('id', Auth::id())->value('vip_flg');
        if($travelPlanCount >= 3 && $isVipUser == 0) {
            return redirect('/home')->with('danger', '無料会員は4つ以上の予定を登録できません。有料会員になると無制限で登録できます。');
        }
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
        if($request->input('budget') == null) {
            $travel_plan->budget = 0;
        } else {
            $travel_plan->budget = $request->input('budget');
        }
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
        $userId = Auth::id();
        $travelPlans = TravelPlan::find($id);
        if($userId != $travelPlans->user_id) {
            return redirect('/home')->with('danger', '不正な操作が行われました😠');
        }
        // 予定のIDを取得して編集画面に渡す例
        $travelPlan = TravelPlan::find($id);
        $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
        $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');
        //dd($travelPlan);

        $departure = substr($travelPlan->departure_time, 11, 5);

        // 編集画面のビューにデータを渡す
        return view('schedule_edit', [
            'travelPlan' => $travelPlan,
            'formatted_start' => $formatted_start,
            'formatted_end' => $formatted_end,
            'departure' => $departure,
        ]);

    }

    public function delete($id)
    {
        TravelDetail::where('travel_plan_id', $id)->delete();
        Tweet::where('travel_plan_id', $id)->delete();
        Belonging::where('travel_plan_id', $id)->delete();
        TravelPlan::where('id', $id)->delete();

        return redirect('/schedule/all_plan')->with('success', '予定を削除しました！');
    }

    public function detail($id)
    {
        $travelPlan = TravelPlan::find($id);
        $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
        $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');
        // dd($travelDetails->where('kubun', 1)->pluck('contents'));

        $userId = Auth::id();
        if($userId != $travelPlan->user_id) {
            return redirect('/home')->with('danger', '不正な操作が行われました😠');
        }

        $tweets = Tweet::where('travel_plan_id', $id)->orderBy('updated_at', 'asc')->get();
        $editContent = '';

        // $contents1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1)->get();
        $contents1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1);
        $contents2 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 2);
        $contents3 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 3);
        $contents4 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 4);
        $contents5 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 5);
        $contents6 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 6);
        $contents7 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 7);
        $contents8 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 8);
        $contents9 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 9)->orderBy('time_from', 'asc')->get();
        $contents10 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 10);

        // $price1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1)->sum('price');
        $price1 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 1);
        $price2 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 2);
        $price3 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 3);
        $price4 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 4);
        $price5 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 5);
        $price6 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 6);
        $price7 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 7);
        $price8 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 8);
        $price9 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 9)->sum('price');
        $price10 = TravelDetail::where('travel_plan_id', $id)->where('kubun', 10);


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


        $contents1Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 1)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents1Data[$i] = $data;
        }


        $contents2Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 2)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents2Data[$i] = $data;
        }

        $contents3Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 3)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents3Data[$i] = $data;
        }

        $contents4Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 4)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents4Data[$i] = $data;
        }

        $contents5Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 5)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents5Data[$i] = $data;
        }

        $contents6Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 6)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents6Data[$i] = $data;
        }

        $contents7Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 7)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents7Data[$i] = $data;
        }

        $contents8Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 8)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents8Data[$i] = $data;
        }

        $contents10Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 10)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents10Data[$i] = $data;
        }

        $price1Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 1)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price1Data[$i] = $data;
            // $price1Data ->push($data);
        }
        // dd($price1Data);

        $price2Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 2)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price2Data[$i] = $data;
        }

        $price3Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 3)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price3Data[$i] = $data;
        }

        $price4Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 4)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price4Data[$i] = $data;
        }

        $price5Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 5)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price5Data[$i] = $data;
        }

        $price6Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 6)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price6Data[$i] = $data;
        }

        $price7Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 7)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price7Data[$i] = $data;
        }

        $price8Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 8)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price8Data[$i] = $data;
        }

        $price10Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 10)
                ->where('date', $displayDays[$i])
                ->pluck('price');
            $price10Data[$i] = $data;
        }

        $totalPrice = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('date', $displayDays[$i])
                ->pluck('price')
                ->sum();
            $totalPrice[$i] = $data; // 合計金額に加算
        }


        // dd($totalPrice);

        $dateTimeAll = [];
        $dateTimeFrom = [];
        for($i = 0; $i < $dateCount; $i++) {
            $dateTimeFrom[$i] = TravelDetail::where('travel_plan_id', $id)
                ->where('date', $displayDays[$i])
                ->where('kubun', 9)
                ->orderBy('date', 'asc')
                ->get();

            // if($dateTimeFrom[$i]) {
            //     $dateTimeAll[$i] = [
            //         $dateTimeFrom[$i]->pluck('time_from'),
            //         $dateTimeFrom[$i]->pluck('time_to'),
            //         $dateTimeFrom[$i]->pluck('contents')
            //     ];
            // }

            if ($dateTimeFrom[$i]->isNotEmpty()) {
                $dateTimeAll[$i] = $dateTimeFrom[$i]->map(function ($item) {
                    return [
                        'time_from' => $item->time_from,
                        'time_to' => $item->time_to,
                        'contents' => $item->contents
                    ];
                })->toArray();
            }

        }

        $dateTimeTo = [];
        for($i = 0; $i < $dateCount; $i++) {
            for($j = 0; $j < $timesCnt; $j++) {
                $dateTimeTo[$i] = TravelDetail::where('travel_plan_id', $id)
                    ->where('date', $displayDays[$i])
                    ->where('kubun', 9)
                    ->orderBy('date', 'asc')
                    ->pluck('time_to');
            }
        }

        // dd($dateTimeAll[0][1]);
        // dd($contents9);


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
            'contents1Data' => $contents1Data,
            'contents2Data' => $contents2Data,
            'contents3Data' => $contents3Data,
            'contents4Data' => $contents4Data,
            'contents5Data' => $contents5Data,
            'contents6Data' => $contents6Data,
            'contents7Data' => $contents7Data,
            'contents8Data' => $contents8Data,
            'contents10Data' => $contents10Data,
            'price1Data' => $price1Data,
            'price2Data' => $price2Data,
            'price3Data' => $price3Data,
            'price4Data' => $price4Data,
            'price5Data' => $price5Data,
            'price6Data' => $price6Data,
            'price7Data' => $price7Data,
            'price8Data' => $price8Data,
            'price10Data' => $price10Data,
            'dateTimeAll' => $dateTimeAll,
            'dateTimeFrom' => $dateTimeFrom,
            'editContent' => $editContent,
            'tweets' => $tweets,
        ]);
    }

    public function detailNew(Request $request)
    {
        $travelPlanId = $request->travel_plan_id;
        $travelDate = $request->travelDate;
        $travelPlan = TravelPlan::with('user')->find($travelPlanId);

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

        $timeFroms = [];
        $timeToes = [];
        $timeContents = [];
        foreach ($times as $time) {
            $timeFroms[] = substr($time->time_from, 11, 5);
            $timeToes[] = substr($time->time_to, 11, 5);
            $timeContents[] = $time->contents;
        }

        $travelPlan = TravelPlan::find($id);
        $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
        $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');
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

        $dateCount = 1;
        $displayDays = []; // 日付を格納する配列
        foreach ($period as $date) {
            $displayDays[] = $date->format('Y-m-d'); // 日付を配列に追加
        }

        $contents1Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 1)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents1Data[$i] = $data;
        }


        $contents2Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 2)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents2Data[$i] = $data;
        }

        $contents3Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 3)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents3Data[$i] = $data;
        }

        $contents4Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 4)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents4Data[$i] = $data;
        }

        $contents5Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 5)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents5Data[$i] = $data;
        }

        $contents6Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 6)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents6Data[$i] = $data;
        }

        $contents7Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 7)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents7Data[$i] = $data;
        }

        $contents8Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 8)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents8Data[$i] = $data;
        }

        $contents10Data = [];
        for ($i = 0; $i < $dateCount; $i++) {
            $data = TravelDetail::where('travel_plan_id', $id)
                ->where('kubun', 10)
                ->where('date', $displayDays[$i])
                ->pluck('contents');
            $contents10Data[$i] = $data;
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

        $deleteFlg = false;

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
            'dateCount' => $dateCount,
            'displayDays' => $displayDays,
            'timeContents' => $timeContents,
            'contents1Data' => $contents1Data,
            'contents2Data' => $contents2Data,
            'contents3Data' => $contents3Data,
            'contents4Data' => $contents4Data,
            'contents5Data' => $contents5Data,
            'contents6Data' => $contents6Data,
            'contents7Data' => $contents7Data,
            'contents8Data' => $contents8Data,
            'contents10Data' => $contents10Data,
            'deleteFlg' => $deleteFlg,
        ]);
    }

    public function detailNR(Request $request)
    {
        $timeCnt = $request->input('timeCnt');

        $travelPlanIds = (array) $request->input('travel_plan_id');

        // 関連するTravelPlanレコードを取得
        $travelPlan = TravelPlan::whereIn('id', $travelPlanIds)->get();

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

        if($request->input('contents10') !== null) {
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
        return redirect('/schedule/detail/' . $travelPlanIds[0])->with([
            'success'=> '予定を追加しました🤗',
            'travelPlan' => $travelPlan,
        ]);
    }

    public function detailDelete(Request $request)
    {
        $selectedDetails = $request->input('deletes');
        if (!empty($selectedDetails)) {
            // 選択されたTravelDetailレコードのtravel_plan_idを取得
            $travelPlanIds = TravelDetail::whereIn('id', $selectedDetails)->pluck('travel_plan_id')->toArray();

            // 関連するTravelPlanレコードを取得
            $travelPlan = TravelPlan::whereIn('id', $travelPlanIds)->get();

            // TravelDetailの削除
            TravelDetail::whereIn('id', $selectedDetails)->delete();
        }
        // 削除後のリダイレクトなどの処理を行う
        return redirect('/schedule/detail/' . $travelPlanIds[0])->with([
            'success'=> '予定を削除しました😇',
            'travelPlan' => $travelPlan,
        ]);
    }

    public function belongings($id)
    {
        $uid = auth()->user()->id;
        $tp = TravelPlan::find($id);
        if($tp->user_id == $uid) {
            $travelPlans = TravelPlan::where('user_id', Auth::id())->get();
            $belongings = Belonging::where('travel_plan_id', $id)->get();
            // dd($travelPlans);
            $travelPlan = TravelPlan::find($id);

            $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
            $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');

            $start = new DateTime($formatted_start);
            $end = new DateTime($formatted_end);

            $interval = new DateInterval('P1D'); // 1日ごとに増加
            $period = new DatePeriod($start, $interval, $end);
            $dateCount = 1;


            foreach ($period as $date) {
                $dateCount ++;
            }

            return view('belongings_edit', [
                'travelPlans' => $travelPlans,
                'id' => $id,
                'belongings' => $belongings,
                'formatted_start' => $formatted_start,
                'formatted_end' => $formatted_end,
                'dateCount' => $dateCount,
                'travelPlan' => $travelPlan,

            ]);
        } else {
            return redirect('/home')->with('danger', '不正な操作が行われました😠');
        }
    }

    public function belongings_register(Request $request)
    {
        $belonging = new Belonging;
        $tpid = $request->input('travel_plan_id');
        $belonginsCnt = $request->input('belonginsCnt');
        // dd($belonginsCnt);

        if($request->input('belongings-1') !== null) {
            for($i = 0; $i < $belonginsCnt; $i ++){
                $belonging = new Belonging;
                // 既に存在するデータを検索
                $existingData = Belonging::where('travel_plan_id', $tpid)
                ->where('travel_plan_id', $request->input('travel_plan_id'))
                ->where('contents', $request->input('belongings-' . strval($i + 1)))
                ->first();

                if(!$request->input('belongings-' . strval($i + 1))) continue;

                if(!$existingData) {
                    $belonging->travel_plan_id = $request->input('travel_plan_id');
                    $belonging->contents = $request->input('belongings-' . strval($i + 1));
                    $belonging->save();
                }
            }
        }

        $belongings = Belonging::where('travel_plan_id', $tpid)->get();

        return redirect('/schedule/belongings/' . $tpid)->with([
            'success'=> '旅行に持っていくものを追加しました🤗',
        ]);
    }

    public function belongingsDelete(Request $request)
    {
        $selectedBelongings = $request->input('belongings');
        $travelPlanId = $request->input('travel_plan_id');
        if (!empty($selectedBelongings)) {
            Belonging::whereIn('id', $selectedBelongings)->delete();
        }

        // 削除後のリダイレクトなどの処理を行う
        return redirect('/schedule/belongings/' . $travelPlanId)->with('danger', '旅行に持っていくものを削除しました😇');
    }

}
