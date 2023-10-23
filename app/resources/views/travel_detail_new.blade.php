@extends('layouts.app')
@section('content')
@vite(['resources/js/newDetail.js'])
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
                    <form action="" method="POST">
                        <div name="expenses" style="display: none;">
                            <div name="morning">
                                <span>朝食：</span>
                                <input type="text" placeholder="ビュッフェ" name="contents1" size="20">　¥
                                <input type="number" placeholder="620" style="width: 60px;" name="price1">
                            </div><br>
                            <div name="lunch">
                                <span>昼食：</span>
                                <input type="text" name="contents2">　¥
                                <input type="number" style="width: 60px;" name="price2">
                            </div><br>
                            <div name="dinner">
                                <span>夕食：</span>
                                <input type="text" name="contents3">　¥
                                <input type="number" style="width: 60px;" name="price3">
                            </div><br>
                            <div name="snack">
                                <span>間食：</span>
                                <input type="text" name="contents4">　¥
                                <input type="number" style="width: 60px;" name="price4">
                            </div><br>
                            <div name="snack">
                                <span>交通費：</span>
                                <input type="text" name="contents5" size="18">　¥
                                <input type="number" style="width: 60px;" name="price5">
                            </div><br>
                            <div name="fare">
                                <span>宿泊費：</span>
                                <input type="text" name="contents6" size="18">　¥
                                <input type="number" style="width: 60px;" name="price6">
                            </div><br>
                            <div name="souvenir">
                                <span>お土産：</span>
                                <input type="text" name="contents7" size="18">　¥
                                <input type="number" style="width: 60px;" name="price7">
                            </div><br>
                            <div name="leisure">
                                <span>レジャー：</span>
                                <input type="text" name="contents8" size="16">　¥
                                <input type="number" style="width: 60px;" name="price8">
                            </div><br>
                            <div name="other-expense">
                                <span>その他雑費：</span>
                                <input type="text" name="contents9" size="14">　¥
                                <input type="number" style="width: 60px;" name="price9">
                            </div>
                            <button type="submit" name="plan-register" class="btn btn-primary">登録</button>
                            <input type="hidden" name="plan-id" value="{{ $editUrl }}">
                        </div><br>
                    </form>
                    <a href="#" class="todo">予定を入力する</a><br>
                    <form action="">
                        <div class="time">
                            <button type="button" name="add" class="btn btn-outline-success btn-sm">＋</button>
                            <button type="button" name="delete" class="btn btn-outline-danger btn-sm">ー</button><br><br>
                            <span name="num">12.</span>
                            <input type="time" name="time-from" style="width: 62px;">〜
                            <input type="time" name="time-to" style="width: 62px;">　
                            <input type="text" name="going" size="15">
                        </div>
                    </form>
                </div>
            </div><br>
        </div>
    </div>
</div>
@endsection