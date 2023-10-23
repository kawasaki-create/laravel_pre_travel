@extends('layouts.app')

@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
<link rel="stylesheet" src="{{ asset('resources/css/app.css') }}">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-light bg-light">
        <!-- ハンバーガーメニュー -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link" href="account">アカウント設定</a>
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
            <br><br>
            @php
                $displayCard = false;
            @endphp
            @foreach ($travelPlans as $travelPlan)
                @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $travelPlan->trip_end)
                    @php
                        $displayCard = true;
                    @endphp
                @endif
            @endforeach
            @if($displayCard)
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
                            @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $travelPlan->trip_end)
                                @if($loop->iteration > 7)
                                    <span name="clickInline" style="display: {{ $tripCnt >= 2 ? '' : 'none' }};"><br></span>
                                @endif
                                <p>旅行名: {{ $travelPlan->trip_title }}</p>
                                <p>期間: {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                                <p>出発時刻: {{ $travelPlan->departure_time }}</p>
                                <p>集合場所: {{ $travelPlan->meet_place }}</p>
                                @if($travelPlan->budget)
                                    <p>予算: {{ $travelPlan->budget }}円</p>
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
                    @if($travelPlan->trip_start < date('Y-m-d H:i:s') && date('Y-m-d H:i:s') < $travelPlan->trip_end)
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
                                @if($travelPlan->trip_start < date('Y-m-d H:i:s') && date('Y-m-d H:i:s') < $travelPlan->trip_end && $tweet->created_at < $travelPlan->trip_end && $travelPlan->trip_start < $tweet->created_at && $travelPlan->id == $tweet->travel_plan_id)
                                    @php
                                        $displayCard = true;
                                    @endphp
                                    <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}">
                                    <span name="{{ $tweet->id }}">{{ $tweet->tweet }}
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
                                                <a href="/home/editedtweet/register/" class="btn editSaveBtn">保存</a>
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
