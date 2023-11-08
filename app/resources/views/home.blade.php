@extends('layouts.app')

@section('content')
@vite(['resources/js/app.js'])
@vite(['resources/js/accountDelete.js'])
@vite(['resources/css/homeNav.css'])
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-light bg-light">
        <!-- ハンバーガーメニュー -->
        <button class="navbar-toggler topm" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- ナビゲーションメニュー -->
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="/schedule/all_plan/">全ての旅行</a>
            <li class="nav-item">
            <a class="nav-link" href="/home/all_tweet">全てのつぶやきを表示</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/home/account_delete" type="button" id="accountDelete">アカウント削除</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/home/change_mail">メールアドレス変更</a>
            </li>
        </ul>
        </div>
    </nav>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>ようこそ、{{Auth::user()->name;}}さん！</p>
                    <input type="button" class="btn btn-secondary" onclick="location.href='/schedule'" value="スケジュール作成">
                </div>
            </div>
            <br>
            @php
                $displayCard = false;
            @endphp
            @foreach ($travelPlans as $travelPlan)
                @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end)
                    @php
                        $displayCard = true;
                    @endphp
                @endif
            @endforeach
            @if($displayCard)
                <div class="card">
                    <div class="card-header">持っていくものリスト <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
                    <div class="card-body">
                        <form action="{{ route('schedule.detailNR') }}" method="POST">
                            @csrf
                            <div name="times" style="display: none;">
                                <button type="button" name="add" class="btn btn-outline-success btn-sm">＋</button>
                                <button type="button" name="delete" class="btn btn-outline-danger btn-sm">－</button><br><br>
                                    <div id="timeContainer" class="time">
                                        <span name="num">1：</span>
                                        <input type="checkbox" name="bringCheck[]">
                                        <input type="text" name="bringing-1" style="width: 34%;">
                                    </div>
                                <button name="todo-register" class="btn btn-primary">登録</button>
                                <textarea id="timeCnt" name="timeCnt" hidden>1</textarea>
                            </div>
                        </form>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-header">つぶやき <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
                    <div class="card-body">
                        <form action="{{ route('button.click') }}" method="POST">
                            @csrf
                            <textarea id="myTextarea" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140"></textarea><br>
                            <div id="charCount"></div>
                            <button type="submit" class="btn btn-primary" id="tweetButton">投稿</button>　
                            <select name="duplicatedTravel" id="duplicatedTravel" {{ $tripCnt >= 2 ? '' : 'hidden' }}>
                            @for($i = 0; $i < $tripCnt; $i++)
                                <option value="{{ $duplicatedIdList[$i] }}">{{ $duplicatedTitleList[$i] }}</option>
                            @endfor
                            </select>
                        </form>
                    </div>
                </div>
                <br><br>
                <div class="card">
                    <div class="card-header">旅行概要 <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
                    <div class="card-body">
                        @foreach ($travelPlans as $travelPlan)
                            @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end)
                                @if($loop->iteration > 1)
                                    <span name="clickInline" style="display: {{ $tripCnt >= 2 ? '' : 'none' }};"><br></span>
                                @endif
                                @php
                                    $time = substr($travelPlan->departure_time, 11, 8);
                                    $ftime = substr($time, 0, 5);
                                @endphp
                                <p>旅行名： {{ $travelPlan->trip_title }}</p>
                                <p>期間： {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                                @if($time != '00:00:00')
                                <p>出発時刻： {{ $travelPlan->trip_start . ' ' . $ftime }}</p>
                                @endif
                                @if($travelPlan->meet_place)
                                    <p>集合場所： {{ $travelPlan->meet_place }}</p>
                                @endif
                                @if($travelPlan->budget)
                                    <p>予算： {{ $travelPlan->budget }}円</p>
                                @endif
                                <div>
                                    <input type="hidden" value="{{ $travelPlan->id }}">
                                    <a href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}" class="btn btn-outline-primary">旅行編集</a>　
                                    <input type="hidden" value="{{ $travelPlan->id }}">
                                    <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-outline-success">旅行詳細設定</a>
                                </div>
                                @if($loop->iteration >= 7)
                                <br><br>
                                    <!-- <span name="clickInline" style="display: {{ $tripCnt >= 2 ? '' : 'none' }};"><br></span> -->
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <br><br>
            @php
                $displayCard = false;
            @endphp
            @foreach ($travelPlans as $travelPlan)
                @foreach ($tweets as $tweet)
                    @php
                        $nextDay = date('Y-m-d H:i:s', strtotime($travelPlan->trip_end . ' +1 day'));
                    @endphp
                    @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                        @php
                            $displayCard = true;
                        @endphp
                    @endif
                @endforeach
            @endforeach
            @if($displayCard)
                <div class="card">
                    <form action="{{ route('tweets.delete') }}" method="POST">
                        @csrf
                        <div class="card-header">つぶやき表示 <span style="color:red; font-size:10px;">※旅行中限定</span></div>
                        <div class="card-body">
                        @foreach ($travelPlans as $travelPlan)
                            @foreach ($tweets as $tweet)
                                @php
                                    $displayCard = false;
                                    $nextDay = date('Y-m-d H:i:s', strtotime($travelPlan->trip_end . ' +1 day'));
                                @endphp
                                @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                                    @php
                                        $displayCard = true;
                                    @endphp
                                    <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}">
                                    <span name="{{ $tweet->id }}">{!! nl2br(e($tweet->tweet)) !!}
                                        @if($tweet->editFlg == 1)
                                            <span name="edited" style="color:gray; font-size: 10px;">(編集済み)</span>
                                        @endif
                                    </span><br>
                                    <span style="font-size :10px; color: gray;">{{ $tweet->updated_at }}</span>
                                    <button type="button" class="editButton" id="modalOpen" data-tweet-id="{{ $tweet->id }}">編集</button>
                                    <div id="easyModal" class="modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1>つぶやき編集🐦</h1>
                                                <span class="modalClose">×</span>
                                            </div>
                                            <div class="modal-body">
                                                <textarea id="myTweetEdit" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140"></textarea><br>
                                                <span id="modalCharCount"></span>　
                                                <a href="#" class="btn editSaveBtn">保存</a>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                @endif
                            @endforeach
                        @endforeach
                            <button type="submit" class="btn btn-warning" id="tweetDeleteButton">削除</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
