@extends('layouts.app')

@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
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

                    <p>ようこそ、{{Auth::user()->email;}}さん！</p>
                    <input type="button" class="btn btn-secondary" onclick="location.href='/schedule'" value="スケジュール作成">
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">旅行概要 <span style="color:red; font-size:4px;">※旅行中のみ表示</span></div>
                <div class="card-body">
                    @foreach ($travelPlans as $travelPlan)
                        <p>旅行名: {{ $travelPlan->trip_title }}</p>
                        <p>期間: {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                        <p>出発時刻: {{ $travelPlan->departure_time }}</p>
                        <p>集合場所: {{ $travelPlan->meet_place }}</p>
                        <p>予算: {{ $travelPlan->budget }}円</p>
                        <br>
                    @endforeach
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">つぶやき表示 <span style="color:red; font-size:4px;">※旅行中のみ表示</span></div>
                <div class="card-body">
                    @foreach ($travelPlans as $travelPlan)
                        <p>旅行名: {{ $travelPlan->trip_title }}</p>
                        <p>期間: {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                        <p>出発時刻: {{ $travelPlan->departure_time }}</p>
                        <p>集合場所: {{ $travelPlan->meet_place }}</p>
                        <p>予算: {{ $travelPlan->budget }}円</p>
                        <br>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">つぶやき <span style="color:red; font-size:4px;">※旅行中のみ表示</span></div>
                <div class="card-body">
                    <form action="{{ route('button.click') }}" method="POST">
                        @csrf
                        <textarea id="myTextarea" name="tweet" placeholder="つぶやき" maxlength="140"></textarea><br>
                        <div id="charCount"></div>
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
