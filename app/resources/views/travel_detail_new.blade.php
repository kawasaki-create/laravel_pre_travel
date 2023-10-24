@extends('layouts.app')
@section('content')
@vite(['resources/js/newDetail.js'])
@vite(['resources/css/newSchedule.css'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">詳細スケジュール編集</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                        $url = $_SERVER['REQUEST_URI'];
                        $editUrl = ltrim(strrchr("$url", "/"), '/');
                    @endphp
                    @csrf
                    <span>旅行名：{{ $travelPlan->trip_title }}</span>　
                    <span>{{ $travelDate }}</span><br><br>
                    <a href="#" class="expense">食事・費用を入力する</a><br><br>
                    <form action="{{ route('schedule.detailNR') }}" method="POST">
                        @csrf
                        <div name="expenses" style="display: none;">
                            <div name="morning">
                                <span>朝食：</span>
                                <input type="text" placeholder="ビュッフェ" name="contents1" class="expense-text2">　¥
                                <input type="number" placeholder="620" class="expense-number"  name="price1">
                            </div><br>
                            <div name="lunch">
                                <span>昼食：</span>
                                <input type="text" name="contents2" class="expense-text2">　¥
                                <input type="number" class="expense-number"  name="price2">
                            </div><br>
                            <div name="dinner">
                                <span>夕食：</span>
                                <input type="text" name="contents3" class="expense-text2">　¥
                                <input type="number" class="expense-number"  name="price3">
                            </div><br>
                            <div name="snack">
                                <span>間食：</span>
                                <input type="text" name="contents4" class="expense-text2">　¥
                                <input type="number" class="expense-number"  name="price4">
                            </div><br>
                            <div name="snack">
                                <span>交通費：</span>
                                <input type="text" name="contents5" class="expense-text3">　¥
                                <input type="number" class="expense-number"  name="price5">
                            </div><br>
                            <div name="fare">
                                <span>宿泊費：</span>
                                <input type="text" name="contents6" class="expense-text3">　¥
                                <input type="number" class="expense-number"  name="price6">
                            </div><br>
                            <div name="souvenir">
                                <span>お土産：</span>
                                <input type="text" name="contents7" class="expense-text3">　¥
                                <input type="number" class="expense-number"  name="price7">
                            </div><br>
                            <div name="leisure">
                                <span>レジャー：</span>
                                <input type="text" name="contents8" class="expense-text4">　¥
                                <input type="number" class="expense-number"  name="price8">
                            </div><br>
                            <div name="other-expense">
                                <span>その他雑費：</span>
                                <input type="text" name="contents9" class="expense-text5">　¥
                                <input type="number" class="expense-number"  name="price9">
                            </div>
                            <button type="submit" name="plan-register" class="btn btn-primary">登録</button>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlanId }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $travelDate }}</textarea>
                        </div><br>
                    </form>
                    <a href="#" class="todo">予定を入力する</a><br>
                    <form action="{{ route('schedule.detailNR') }}" method="POST">
                        @csrf
                        <div name="times" style="display: none;">
                            <button type="button" name="add" class="btn btn-outline-success btn-sm">＋</button>
                            <button type="button" name="delete" class="btn btn-outline-danger btn-sm">－</button><br><br>
                                <div id="timeContainer" class="time">
                                    <span name="num">1：</span>
                                    <input type="time" name="time-from-1" style="width: 72px;">〜
                                    <input type="time" name="time-to-1" style="width: 72px;">　
                                    <input type="text" name="going-1" style="width: 34%;">
                                </div>
                            <button name="todo-register" class="btn btn-primary">登録</button>
                            <span id="timeCnt" name="timeCnt" hidden>1</span>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlanId }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $travelDate }}</textarea>
                        </div>
                    </form>
                </div>
            </div><br>
        </div>
    </div>
</div>
@endsection